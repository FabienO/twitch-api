<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiVideos
 *
 * @package Sevenpluss\TwitchApi\Contracts
 * @link  https://dev.twitch.tv/docs/api/reference#get-videos
 */
interface ApiVideos
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiVideos
     */
    public function setApiMediator(TwitchApiContract $api): ApiVideos;

    /**
     * Gets video information by video ID (one or more), user ID (one only), or game ID (one only)
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
    public function getVideos(array $options, PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets video information by video ID
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-videos
     *
     * @param string $video_id ID of the video being queried
     * @param array $options Additional parameters
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getVideoById(string $video_id, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets video information by user ID
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
    public function getVideosByUserId(string $user_id, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets video information by game ID
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-videos
     *
     * @param string $game_id ID of the game the video is of. Limit 1
     * @param array $options Additional parameters
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getVideosByGameId(string $game_id, array $options = [], PaginatorContract $paginator = null): ResultContract;
}
