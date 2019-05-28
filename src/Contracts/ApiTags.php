<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiTags
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ApiTags
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiTags
     */
    public function setApiMediator(TwitchApiContract $api): ApiTags;

    /**
     * Gets the list of all stream tags defined by Twitch, optionally filtered by tag ID(s)
     *
     * Optional Query String Parameter:
     * string   tag_id  ID of a tag. Multiple IDs can be specified, separated by ampersands. If provided, only the
     *                  specified tag(s) is(are) returned. Maximum of 100.
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#get-all-stream-tags
     *
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getAllStreamTags(array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets the list of tags for a specified stream (channel)
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#get-stream-tags
     *
     * @param string $broadcaster_id    ID of the stream thats tags are going to be fetched
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getStreamTagsByBroadcasterId(string $broadcaster_id): ResultContract;

    /**
     * Applies specified tags to a specified stream, overwriting any existing tags applied to that stream
     *
     * @link  https://dev.twitch.tv/docs/api/reference#replace-stream-tags
     *
     * @param string $broadcaster_id    ID of the stream for which tags are to be replaced.
     * @param string[] $tag_ids         IDs of tags to be applied to the stream. Maximum of 100 supported.
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function replaceStreamTags(string $broadcaster_id, array $tag_ids = []): ResultContract;
}
