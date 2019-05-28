<?php

namespace Sevenpluss\TwitchApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Psr\Http\Message\StreamInterface;
use Sevenpluss\TwitchApi\Contracts\ApiRequest;
use Sevenpluss\TwitchApi\Contracts\ClientSettingsContract;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;
use Sevenpluss\TwitchApi\Services\Result;

/**
 * Class Request
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Request implements ApiRequest
{
    /**
     * @var TwitchApiContract
     */
    protected $mediator;

    /**
     * Guzzle is used to make http requests
     *
     * @var Client|null
     */
    protected $client;

    /**
     * Guzzle client settings
     *
     * @var ClientSettingsContract
     */
    protected $settings;

    /**
     * Twitch token
     *
     * @var string|null
     */
    protected $token;

    /**
     * Paginator object
     *
     * @var PaginatorContract|null
     */
    protected $paginator;

    protected const URL_OAUTH_TOKEN = 'https://id.twitch.tv/oauth2/token';

    protected const URL_OAUTH_REVOKE = 'https://id.twitch.tv/oauth2/revoke';

    protected const URL_OAUTH_AUTHORIZE = 'https://id.twitch.tv/oauth2/authorize';

    /**
     * TwitchServiceContract constructor.
     *
     * @param string|null $token Twitch OAuth Token
     *
     * @return void
     */
    public function __construct(string $token = null)
    {
        if (!is_null($token)) {
            $this->setToken($token);
        }
    }

    /**
     * @param TwitchApiContract $twitch
     *
     * @return ApiRequest
     */
    public function setApiMediator(TwitchApiContract $twitch): ApiRequest
    {
        $this->mediator = $twitch;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setToken(string $token = null): void
    {
        $this->token = $token;
    }

    /**
     * @inheritDoc
     */
    public function withToken(string $token): ApiRequest
    {
        $this->setToken($token);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getToken(): string
    {
        if (!$this->token) {
            throw new TokenMissingException;
        }

        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function refreshToken(string $refresh_token, array $scopes = []): ?ResultContract
    {
        $response = $this->post(self::URL_OAUTH_TOKEN, [
            'client_id' => $this->settings()->getClientId(),
            'client_secret' => $this->settings()->getClientSecret(),
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'scopes' => $scopes
        ]);

        if (!$response->success()) {
            return null;
        }

        $this->setToken($response->data()['access_token']);

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function revokeToken(): ResultContract
    {
        $this->setToken(null);

        return $this->post(self::URL_OAUTH_REVOKE, [
            'client_id' => $this->settings()->getClientId(),
            'token' => $this->getToken()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getAuthToken(string $code): ResultContract
    {
        return $this->post(self::URL_OAUTH_TOKEN, [
            'client_id' => $this->settings()->getClientId(),
            'client_secret' => $this->settings()->getClientSecret(),
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->settings()->getRedirectUri()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getState(): string
    {
        return bin2hex(random_bytes(16));
    }

    /**
     * @inheritDoc
     */
    public function getAuthUri(string $state, array $scopes = [], bool $force_login = false): string
    {
        $options = [
            'client_id' => $this->settings()->getClientId(),
            'redirect_uri' => $this->settings()->getRedirectUri(),
            'response_type' => 'code',
            'force_verify' => $force_login ? 'true' : 'false',
            'state' => $state
        ];

        if (!empty($scopes)) {
            $options['scope'] = implode('+', $scopes);
        }

        return $this->buildRequestUri(self::URL_OAUTH_AUTHORIZE, $options);
    }

    /**
     * @inheritDoc
     */
    public function get(string $path = '', array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->query('GET', $path, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function post(string $path = '', array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->query('POST', $path, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function put(string $path = '', array $options = []): ResultContract
    {
        return $this->query('PUT', $path, $options);
    }

    /**
     * @inheritDoc
     */
    public function json(string $method, string $path = '', array $body = null): ResultContract
    {
        if (!empty($body)) {
            $body = json_encode(['data' => $body]);
        }
        return $this->query($method, $path, [], null, $body);
    }

    /**
     * @inheritDoc
     */
    public function query(string $method = 'GET', string $path = '', array $options = [], PaginatorContract $paginator = null, $json_body = null): ResultContract
    {
        if ($paginator instanceof PaginatorContract && !is_null($paginator->action()) && !is_null($paginator->cursor())) {
            $options[$paginator->action()] = $paginator->cursor();
        }

        $uri = $this->buildRequestUri($path, $options);

        $headers = $this->generateHeaders($json_body ? true : false);

        $result = $this->executeQuery($method, $uri, $headers, $paginator, $json_body);

        return $result;
    }

    /**
     * Execute query
     *
     * @param string $method HTTP method
     * @param string $uri Query path
     * @param array $headers Query headers
     * @param PaginatorContract|null $paginator
     * @param string|null|resource|StreamInterface $json_body Request json body
     *
     * @return ResultContract
     * @throws GuzzleException
     */
    protected function executeQuery(string $method, string $uri, array $headers, PaginatorContract $paginator = null, $json_body = null): ResultContract
    {
        try {
            $request = new GuzzleRequest($method, $uri, $headers, $json_body);

            $response = $this->client()->send($request);

            $result = new Result($response, null, $paginator);

        } catch (RequestException | ClientException $e) {
            $result = new Result($e->getResponse(), $e, $paginator);
        }

        $result->setRequest($request);

        return $result;
    }

    /**
     * Guzzle is used to make http requests
     *
     * @return Client
     */
    protected function client(): Client
    {
        if(is_null($this->client)){

            $this->client = new Client([
                'base_uri' => $this->settings()->getBaseUri()
            ]);
        }

        return $this->client;
    }

    /**
     * Generate headers
     *
     * @param bool $json Body is JSON
     *
     * @return array
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    protected function generateHeaders(bool $json = false): array
    {
        $headers = [
            'Client-ID' => $this->settings()->getClientId()
        ];

        if (!is_null($this->token)) {
            $headers['Authorization'] = 'Bearer ' . $this->getToken();
        }

        if ($json) {
            $headers['Content-Type'] = 'application/json';
        }

        return $headers;
    }

    /**
     * Build an url with parameters
     *
     * @param string $url the base path
     * @param array $options the parameters
     *
     * @return string        the url
     */
    protected function buildRequestUri(string $url, array $options): string
    {
        foreach ($options as $key => $value) {
            $url .= (parse_url($url, PHP_URL_QUERY) ? '&' : '?') . $key . '=' . $value;
        }

        return $url;
    }

    /**
     * Get the settings for Guzzle client
     *
     * @return ClientSettingsContract
     */
    protected function settings(): ClientSettingsContract
    {
        return $this->mediator->settings();
    }
}
