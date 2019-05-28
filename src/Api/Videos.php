<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiVideos;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Videos
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Videos implements ApiVideos
{
    use HandleApiMethods;

    protected const URL_VIDEOS = 'videos';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiVideos
    {
        $this->mediator = $api;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getVideos(array $options, PaginatorContract $paginator = null): ResultContract
    {
        if (!isset($options['id'], $options['user_id'], $options['game_id']) && !array_key_exists('id', $options) && !array_key_exists('user_id', $options) && !array_key_exists('game_id', $options)) {
            throw new BadMethodCallException('The required options missed: id, user_id or game_id');
        }

        return $this->request()->get(self::URL_VIDEOS, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getVideoById(string $video_id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['id'] = $video_id;

        return $this->getVideos($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getVideosByUserId(string $user_id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['user_id'] = $user_id;

        return $this->getVideos($options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getVideosByGameId(string $game_id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['game_id'] = $game_id;

        return $this->getVideos($options, $paginator);
    }
}
