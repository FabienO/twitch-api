<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiClips
 *
 * @package Sevenpluss\TwitchApi\Contracts
 * @link    https://dev.twitch.tv/docs/api/reference#get-clips
 */
interface ApiClips
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiClips
     */
    public function setApiMediator(TwitchApiContract $api): ApiClips;

    /**
     * Creates a clip programmatically. This returns both an ID and an edit URL for the new clip.
     *
     * Authentication
     * Required scope: clips:edit
     *
     * @link  https://dev.twitch.tv/docs/api/reference#create-clip
     *
     * @param string $broadcaster_id ID of the stream from which the clip will be made.
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function createClip(string $broadcaster_id): ResultContract;

    /**
     * Gets information about a specified clip.
     *
     * Required Query String Parameter:
     *
     * string   broadcaster_id  ID of the broadcaster for whom clips are returned. The number of clips returned is determined by the first query-string parameter (default: 20). Results are ordered by view count.
     *
     * string   game_id     ID of the game for which clips are returned. The number of clips returned is determined by the first query-string parameter (default: 20). Results are ordered by view count.
     *
     * string   id  ID of the clip being queried. Limit: 100.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-clip
     *
     * @param array $options
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getClip(array $options, PaginatorContract $paginator = null): ResultContract;
}
