<?php

namespace Sevenpluss\TwitchApi\Api;

use Sevenpluss\TwitchApi\Contracts\ApiBits;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Bits
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Bits implements ApiBits
{
    use HandleApiMethods;

    protected const ENDPOINT_BITS_LEADERBOARD = 'bits/leaderboard';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiBits
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getBitsLeaderboard(array $options = []): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_BITS_LEADERBOARD, $options);
    }

    /**
     * @inheritDoc
     */
    public function getBitsLeaderboardByUserId(string $user_id, array $options = []): ResultContract
    {
        $options['user_id'] = $user_id;

        return $this->getBitsLeaderboard($options);
    }
}
