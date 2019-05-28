<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiStreams
 *
 * @package Sevenpluss\TwitchApi\Contracts
 * @link https://dev.twitch.tv/docs/api/reference/#get-streams
 */
interface ApiStreams
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiStreams
     */
    public function setApiMediator(TwitchApiContract $api): ApiStreams;

    /**
     * Gets information about active streams
     *
     * Options:
     * string   community_id    Returns streams in a specified community ID. You can specify up to 100 IDs.
     * string   game_id         Returns streams broadcasting a specified game ID. You can specify up to 100 IDs.
     * string   language        Stream language. You can specify up to 100 languages.
     * string   type            Stream type: "all", "live", "vodcast". Default: "all".
     * string   user_id         Returns streams broadcast by one or more specified user IDs. You can specify up to 100 IDs.
     * string   user_login      Returns streams broadcast by one or more specified user login names. You can specify up to 100 names.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param array $options Array of parameters
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreams(array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information about active streams by user ID
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param string $id Returns streams broadcast by one specified user ID
     * @param array $options Additional parameters
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsByUserId(string $id, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information about active streams by user IDs
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param string[] $ids Returns streams broadcast by one or more specified user IDs. You can specify up to 100 IDs
     * @param array $options Additional parameters
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsByUserIds(array $ids, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information about active streams by user name
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param string $name Returns streams broadcast by one specified user login name
     * @param array $options Additional parameters
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsByUserName(string $name, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information about active streams by user IDs
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param string[] $names Returns streams broadcast by one or more specified user login names. You can specify up to 100 names
     * @param array $options Additional parameters
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsByUserNames(array $names, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information about active streams by game ID
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param string $id Returns streams broadcast by one specified game ID
     * @param array $options Additional parameters
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsByGameId(string $id, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information about active streams by game IDs
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams
     *
     * @param string[] $ids Returns streams broadcast by one or more specified game IDs. You can specify up to 100 IDs
     * @param array $options Additional parameters
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsByGameIds(array $ids, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * METADATA
     */

    /**
     * Gets metadata information about active streams playing Overwatch or Hearthstone
     *
     * Options:
     * string   community_id    Returns streams in a specified community ID. You can specify up to 100 IDs.
     * string   game_id         Returns streams broadcasting the specified game ID. You can specify up to 100 IDs.
     * string   language        Stream language. You can specify up to 100 languages.
     * string   type            Stream type: "all", "live", "vodcast". Default: "all".
     * string   user_id         Returns streams broadcast by one or more of the specified user IDs. You can specify up to 100 IDs.
     * string   user_login      Returns streams broadcast by one or more of the specified user login names. You can specify up to 100 names.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-streams-metadata
     *
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamsMetadata(array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * MARKERS
     */

    /**
     * Creates a marker in the stream of a user specified by a user ID.
     *
     * Authentication
     * Required scope: user:edit:broadcast
     *
     * Options:
     * string   description   Description of or comments on the marker.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#create-stream-marker
     *
     * @param string $user_id ID of the broadcaster in whose live stream the marker is created
     * @param array $options
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function createStreamMarker(string $user_id, array $options = []): ResultContract;


    /**
     * Gets a list of markers for either a specified user’s most recent stream or a specified VOD/video (stream), ordered by recency by user_id or video_id.
     *
     * Authentication
     * Required scope: user:read:broadcast
     *
     * Options:
     * string   user_id     ID of the broadcaster from whose stream markers are returned.
     * string   video_id    ID of the VOD/video whose stream markers are returned.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-stream-markers
     *
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamMarker(array $options, PaginatorContract $paginator = null): ResultContract;
}
