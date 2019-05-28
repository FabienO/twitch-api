<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiStreams;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Streams
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Streams implements ApiStreams
{
    use HandleApiMethods;

    protected const ENDPOINT_STREAMS = 'streams';

    protected const ENDPOINT_STREAMS_METADATA = 'streams/metadata';

    protected const ENDPOINT_STREAM_MARKERS = 'streams/markers';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiStreams
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStreams(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_STREAMS, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamsByUserId(string $id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['user_id'] = $id;

        return $this->getStreams($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamsByUserIds(array $ids, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['user_id'] = implode('&user_id=', $ids);

        return $this->getStreams($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamsByUserName(string $name, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['user_login'] = $name;

        return $this->getStreams($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamsByUserNames(array $names, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['user_login'] = implode('&user_login=', $names);

        return $this->getStreams($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamsByGameId(string $id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['game_id'] = $id;

        return $this->getStreams($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamsByGameIds(array $ids, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['game_id'] = implode('&game_id=', $ids);

        return $this->getStreams($options, $paginator);
    }

    /**
     * METADATA
     */

    /**
     * @inheritDoc
     */
    public function getStreamsMetadata(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_STREAMS_METADATA, $options, $paginator);
    }

    /**
     * MARKERS
     */

    /**
     * @inheritDoc
     */
    public function createStreamMarker(string $user_id, array $options = []): ResultContract
    {
        $options['user_id'] = $user_id;

        return $this->request()->post(self::ENDPOINT_STREAM_MARKERS, $options);
    }

    /**
     * @inheritDoc
     */
    public function getStreamMarker(array $options, PaginatorContract $paginator = null): ResultContract
    {
        if (!isset($options['user_id'], $options['video_id']) && !array_key_exists('user_id', $options) && !array_key_exists('video_id', $options)) {
            throw new BadMethodCallException('Parameter required missing: user_id or video_id');
        }

        return $this->request()->get(self::ENDPOINT_STREAM_MARKERS, $options, $paginator);
    }
}
