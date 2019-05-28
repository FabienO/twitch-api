<?php

namespace Sevenpluss\TwitchApi\Contracts;

/**
 * Interface TwitchContract
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface TwitchApiContract
{
    /**
     * @return ClientSettingsContract
     */
    public function settings(): ClientSettingsContract;

    /**
     * @param string|null $token
     *
     * @return ApiRequest
     */
    public function request(string $token = null): ApiRequest;

    /**
     * @return ApiAnalytics
     */
    public function analytics(): ApiAnalytics;

    /**
     * @return ApiBits
     */
    public function bits(): ApiBits;

    /**
     * @return ApiClips
     */
    public function clips(): ApiClips;

    /**
     * @return ApiEntitlements
     */
    public function entitlements(): ApiEntitlements;

    /**
     * @return ApiGames
     */
    public function games(): ApiGames;

    /**
     * @return ApiStreams
     */
    public function streams(): ApiStreams;

    /**
     * @return ApiBroadcaster
     */
    public function broadcaster(): ApiBroadcaster;

    /**
     * @return ApiTags
     */
    public function tags(): ApiTags;

    /**
     * @return ApiUsers
     */
    public function users(): ApiUsers;

    /**
     * @return ApiVideos
     */
    public function videos(): ApiVideos;

    /**
     * @return ApiWebhooks
     */
    public function webhooks(): ApiWebhooks;
}
