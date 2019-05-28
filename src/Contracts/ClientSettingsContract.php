<?php

namespace Sevenpluss\TwitchApi\Contracts;

use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\ClientSecretMissingException;
use Sevenpluss\TwitchApi\Exceptions\UriMissingException;

/**
 * Interface ClientSettingsContract
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ClientSettingsContract
{
    /**
     * Get the base url of twitch api
     *
     * @return string
     */
    public function getBaseUri(): string;

    /**
     * @param string $client_id Twitch client id
     *
     * @return void
     */
    public function setClientId(string $client_id): void;

    /**
     * @return string Twitch client id
     * @throws ClientIdMissingException
     */
    public function getClientId(): string;

    /**
     * @param string $client_secret
     *
     * @return void
     */
    public function setClientSecret(string $client_secret): void;

    /**
     * @return string
     * @throws ClientSecretMissingException
     */
    public function getClientSecret(): string;

    /**
     * @param string $uri
     *
     * @return void
     */
    public function setRedirectUri(string $uri): void;

    /**
     * @return string
     * @throws UriMissingException
     */
    public function getRedirectUri(): string;
}
