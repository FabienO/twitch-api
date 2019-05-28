<?php

namespace Sevenpluss\TwitchApi\Services;

use Sevenpluss\TwitchApi\Contracts\ClientSettingsContract;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\ClientSecretMissingException;
use Sevenpluss\TwitchApi\Exceptions\UriMissingException;

/**
 * Class ClientSettings
 *
 * @package Sevenpluss\TwitchApi\Services
 */
class ClientSettings implements ClientSettingsContract
{
    /**
     * Twitch api base url
     *
     * @var string
     */
    protected const BASE_URI = 'https://api.twitch.tv/helix/';

    /**
     * Twitch client id
     *
     * @var string|null
     */
    protected $client_id;

    /**
     * Twitch client secret
     *
     * @var string|null
     */
    protected $client_secret;

    /**
     * @var string|null
     */
    protected $redirect_uri;

    /**
     * ApiSettings constructor.
     *
     * @param string $client_id
     * @param string $client_secret
     * @param string $redirect_uri
     *
     * @return void
     */
    public function __construct(string $client_id, string $client_secret, string $redirect_uri)
    {
        $this->setClientId($client_id);
        $this->setClientSecret($client_secret);
        $this->setRedirectUri($redirect_uri);
    }

    /**
     * @inheritDoc
     */
    public function getBaseUri(): string
    {
        return self::BASE_URI;
    }

    /**
     * @inheritDoc
     */
    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @inheritDoc
     */
    public function getClientId(): string
    {
        if (is_null($this->client_id)) {
            throw new ClientIdMissingException;
        }

        return $this->client_id;
    }

    /**
     * @inheritDoc
     */
    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @inheritDoc
     */
    public function getClientSecret(): string
    {
        if (is_null($this->client_secret)) {
            throw new ClientSecretMissingException;
        }

        return $this->client_secret;
    }

    /**
     * @inheritDoc
     */
    public function setRedirectUri(string $uri): void
    {
        $this->redirect_uri = $uri;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUri(): string
    {
        if (is_null($this->redirect_uri)) {
            throw new UriMissingException;
        }

        return $this->redirect_uri;
    }
}
