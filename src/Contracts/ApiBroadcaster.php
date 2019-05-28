<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiBroadcaster
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ApiBroadcaster
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiBroadcaster
     */
    public function setApiMediator(TwitchApiContract $api): ApiBroadcaster;

    /**
     * Get all of a broadcaster’s subscriptions.
     *
     * Authorization
     * Required OAuth Scope: channel:read:subscriptions
     *
     * @param string $broadcaster_id User ID of the broadcaster. Must match the User ID in the Bearer token.
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getBroadcasterSubscriptions(string $broadcaster_id): ResultContract;

    /**
     * Gets broadcaster’s subscriptions by user ID (one or more).
     *
     * Authorization
     * Required OAuth Scope: channel:read:subscriptions
     *
     * @param string $broadcaster_id User ID of the broadcaster. Must match the User ID in the Bearer token.
     * @param string[] $user_id Unique identifier of account to get subscription status of. Accepts up to 100 values.
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getBroadcasterSubscribers(string $broadcaster_id, array $user_id): ResultContract;
}
