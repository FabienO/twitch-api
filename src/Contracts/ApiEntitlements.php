<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiEntitlements
 *
 * @package Sevenpluss\TwitchApi\Contracts
 * @link    https://dev.twitch.tv/docs/api/reference#create-entitlement-grants-upload-url
 */
interface ApiEntitlements
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiEntitlements
     */
    public function setApiMediator(TwitchApiContract $api): ApiEntitlements;

    /**
     * Create Entitlement Grants Upload URL
     *
     * @link  https://dev.twitch.tv/docs/api/reference#create-entitlement-grants-upload-url
     *
     * @param string $manifest Unique identifier of the manifest file to be uploaded. Must be 1-64 characters.
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function createEntitlementUrl(string $manifest): ResultContract;

    /**
     * Gets the status of one or more provided codes.
     * NOTE: Repeat code query parameter additional times to get the status of multiple codes.
     * Example: ?code=code1&code=code2
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#get-code-status
     *
     * @param int $user_id Represents a numeric Twitch user ID.
     * @param string[] $codes The code to get the status of. Limit 1-20
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getCodeStatus(int $user_id, array $codes): ResultContract;

    /**
     * Redeems one or more provided codes to the authenticated Twitch user.
     *
     * NOTE: Repeat code query parameter additional times to get the status of multiple codes.
     * Example: ?code=code1&code=code2
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#redeem-code
     *
     * @param int $user_id Represents a numeric Twitch user ID.
     * @param string[] $codes The code to redeem to the authenticated user’s account.  Limit 1-20
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function redeemCode(int $user_id, array $codes): ResultContract;
}
