<?php

namespace Sevenpluss\TwitchApi\Api;

use Sevenpluss\TwitchApi\Contracts\ApiAnalytics;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Analytics
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Analytics implements ApiAnalytics
{
    use HandleApiMethods;

    protected const ENDPOINT_ANALYTIC_EXTENSIONS = 'analytics/extensions';

    protected const ENDPOINT_ANALYTIC_GAMES = 'analytics/games';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiAnalytics
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * Extension Analytics
     */

    /**
     * @inheritDoc
     */
    public function getExtensionAnalytics(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        if (isset($options['type']) && !in_array($options['type'], ['overview_v1', 'overview_v2'])) {
            unset($options['type']);
        }

        return $this->request()->get(self::ENDPOINT_ANALYTIC_EXTENSIONS, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAnalyticsByExtensionId(string $extension_id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['extension_id'] = $extension_id;

        return $this->request()->get(self::ENDPOINT_ANALYTIC_EXTENSIONS, $options, $paginator);
    }

    /**
     * Game Analytics
     */

    /**
     * @inheritDoc
     */
    public function getGameAnalytics(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_ANALYTIC_GAMES, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getGameAnalyticsByGameId(string $game_id, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        $options['game_id'] = $game_id;

        return $this->request()->get(self::ENDPOINT_ANALYTIC_EXTENSIONS, $options, $paginator);
    }
}
