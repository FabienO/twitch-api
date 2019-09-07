<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiClips;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Clips
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Clips implements ApiClips
{
    use HandleApiMethods;

    protected const ENDPOINT_CLIPS = 'clips';

	/**
	 * @inheritDoc
	 */
	public function getClips(array $options, PaginatorContract $paginator = null): ResultContract
	{
		if (!isset($options['id'], $options['user_id'], $options['game_id']) && !array_key_exists('id', $options) && !array_key_exists('user_id', $options) && !array_key_exists('game_id', $options)) {
			throw new BadMethodCallException('The required options missed: id, user_id or game_id');
		}

		return $this->request()->get(self::URL_VIDEOS, $options, $paginator);
	}

	/**
	 * @inheritDoc
	 */
	public function getClipsByUserId(string $user_id, array $options = [], PaginatorContract $paginator = null): ResultContract
	{
		$options['user_id'] = $user_id;

		return $this->getClips($options, $paginator);
	}

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiClips
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createClip(string $broadcaster_id): ResultContract
    {
        return $this->request()->post(self::ENDPOINT_CLIPS, [
            'broadcaster_id' => $broadcaster_id
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getClip(array $options, PaginatorContract $paginator = null): ResultContract
    {
        if (!isset($options['broadcaster_id'], $options['game_id'], $options['id']) && !array_key_exists('broadcaster_id', $options) && !array_key_exists('game_id', $options) && !array_key_exists('id', $options)) {
            throw new BadMethodCallException('Parameter required missing: broadcaster_id or game_id or id');
        }

        return $this->request()->get(self::ENDPOINT_CLIPS, $options, $paginator);
    }
}
