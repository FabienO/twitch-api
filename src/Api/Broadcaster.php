<?php

namespace Sevenpluss\TwitchApi\Api;

use Sevenpluss\TwitchApi\Contracts\ApiBroadcaster;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Broadcaster
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Broadcaster implements ApiBroadcaster
{
    use HandleApiMethods;

    protected const ENDPOINT_SUBSCRIPTIONS = 'subscriptions';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiBroadcaster
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getBroadcasterSubscriptions(string $broadcaster_id): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_SUBSCRIPTIONS, [
            'broadcaster_id' => $broadcaster_id
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBroadcasterSubscribers(string $broadcaster_id, array $user_id): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_SUBSCRIPTIONS, [
            'broadcaster_id' => $broadcaster_id,
            'user_id' => implode('&user_id=', $user_id)
        ]);
    }
}
