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
	 * Gets clip information by video ID (one or more), user ID (one only), or game ID (one only)
	 *
	 * Options:
	 * string   id          ID of the video being queried. Limit: 100. If this is specified, you cannot use any of the optional query string parameters below.
	 * string   user_id     ID of the user who owns the video. Limit 1.
	 * string   game_id     ID of the game the video is of. Limit 1.
	 * string   language    Language of the video being queried. Limit: 1.
	 * string   period      Period during which the video was created. Valid values: "all", "day", "month", and "week". Default: "all".
	 * string   sort        Sort order of the videos. Valid values: "time", "trending", and "views". Default: "time".
	 * string   type        Type of video. Valid values: "all", "upload", "archive", and "highlight". Default: "all".
	 *
	 * @link  https://dev.twitch.tv/docs/api/reference#get-videos
	 *
	 * @param array $options List of parameters
	 * @param PaginatorContract $paginator
	 *
	 * @return ResultContract
	 * @throws GuzzleException
	 * @throws ClientIdMissingException
	 * @throws TokenMissingException
	 */
	public function getClips(array $options, PaginatorContract $paginator = null): ResultContract;

	/**
	 * Gets clip information by user ID
	 *
	 * @link  https://dev.twitch.tv/docs/api/reference#get-videos
	 *
	 * @param string $user_id ID of the user who owns the video. Limit 1
	 * @param array $options Additional parameters
	 * @param PaginatorContract $paginator
	 *
	 * @return ResultContract
	 * @throws GuzzleException
	 * @throws ClientIdMissingException
	 * @throws TokenMissingException
	 */
	public function getClipsByUserId(string $user_id, array $options = [], PaginatorContract $paginator = null): ResultContract;

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
