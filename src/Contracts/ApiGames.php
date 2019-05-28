<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiGames
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ApiGames
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiGames
     */
    public function setApiMediator(TwitchApiContract $api): ApiGames;

    /**
     * Gets game information by given parameters
     *
     * Options:
     * string   id    Game ID. At most 100 id values can be specified.
     * string   name  Game name. The name must be an exact match. For instance, "Pokemon" will not return a list of Pokemon games; instead, query the specific Pokemon game(s) in which you are interested. At most 100 name values can be specified.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-games
     *
     * @param array $options Array of parameters
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGames(array $options): ResultContract;

    /**
     * Gets game information by game ID
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-games
     *
     * @param string $id Game ID
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGamesById(string $id): ResultContract;

    /**
     * Gets game information by game name
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-games
     *
     * @param string $name Game name. The name must be an exact match. For instance, "Pokemon" will not return a list of Pokemon games; instead, query the specific Pokemon game(s) in which you are interested
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGamesByName(string $name): ResultContract;

    /**
     * Gets games information by game IDs
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-games
     *
     * @param string[] $ids Game IDs. At most 100 id values can be specified
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGamesByIds(array $ids): ResultContract;

    /**
     * Gets games information by game names
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-games
     *
     * @param string[] $names Game name. The name must be an exact match. For instance, "Pokemon" will not return a list of Pokemon games; instead, query the specific Pokemon game(s) in which you are interested. At most 100 name values can be specified
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGamesByNames(array $names): ResultContract;

    /**
     * Gets games sorted by number of current viewers on Twitch, most popular first
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-top-games
     *
     * @param array $options Array of parameters
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getTopGames(array $options = [], PaginatorContract $paginator = null): ResultContract;
}
