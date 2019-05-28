<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiBits
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ApiBits
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiBits
     */
    public function setApiMediator(TwitchApiContract $api): ApiBits;

    /**
     * Get Bits leaderboard.
     *
     * Authentication
     * Required scope: bits:read
     *
     * Options:
     * integer      count           Number of results to be returned. Maximum: 100. Default: 10.
     * string       period          Time period over which data is aggregated (PST time zone). This parameter interacts with started_at.
     * string       started_at      Timestamp for the period over which the returned data is aggregated. Must be in RFC 3339 format.
     * string       user_id         ID of the user whose results are returned; i.e., the person who paid for the bits.
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#get-bits-leaderboard
     *
     * @param array $options
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getBitsLeaderboard(array $options = []): ResultContract;

    /**
     * Get Bits leaderboard by user ID.
     *
     * Authentication
     * Required scope: bits:read
     *
     * Options:
     * integer      count           Number of results to be returned. Maximum: 100. Default: 10.
     * string       period          Time period over which data is aggregated (PST time zone). This parameter interacts with started_at.
     * string       started_at      Timestamp for the period over which the returned data is aggregated. Must be in RFC 3339 format.
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#get-bits-leaderboard
     *
     * @param string $user_id
     * @param array $options
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getBitsLeaderboardByUserId(string $user_id, array $options = []): ResultContract;
}
