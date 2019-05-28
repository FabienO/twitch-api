<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiGames;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Games
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Games implements ApiGames
{
    use HandleApiMethods;

    protected const ENDPOINT_GAMES = 'games';

    protected const ENDPOINT_GAMES_TOP = 'games/top';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiGames
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getGames(array $options): ResultContract
    {
        if (!isset($options['name'], $options['id']) && !array_key_exists('name', $options) && !array_key_exists('id', $options)) {
            throw new BadMethodCallException('Parameter required missing: name or id');
        }
        return $this->request()->get(self::ENDPOINT_GAMES, $options);
    }

    /**
     * @inheritDoc
     */
    public function getGamesById(string $id): ResultContract
    {
        return $this->getGames([
            'id' => $id
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getGamesByName(string $name): ResultContract
    {
        return $this->getGames([
            'name' => $name
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getGamesByIds(array $ids): ResultContract
    {
        return $this->getGames([
            'id' => implode('&id=', $ids)
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getGamesByNames(array $names): ResultContract
    {
        return $this->getGames([
            'name' => implode('&name=', $names)
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getTopGames(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_GAMES_TOP, $options, $paginator);
    }
}
