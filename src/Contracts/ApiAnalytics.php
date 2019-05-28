<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiAnalytics
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ApiAnalytics
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiAnalytics
     */
    public function setApiMediator(TwitchApiContract $api): ApiAnalytics;

    /**
     * Extension Analytics
     */

    /**
     * Gets a URL that extension developers can use to download analytics reports (CSV files) for their extensions.
     *
     * Authentication
     * Required scope: analytics:read:extensions
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-extension-analytics
     *
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getExtensionAnalytics(array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets a URL that extension developers can use to download analytics reports (CSV files) for their extensions.
     *
     * Authentication
     * Required scope: analytics:read:extensions
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-extension-analytics
     *
     * @param string $extension_id  Client ID value assigned to the extension when it is created
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getExtensionAnalyticsByExtensionId(string $extension_id, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Game Analytics
     */

    /**
     * Gets a URL that game developers can use to download analytics reports (CSV files) for their games.
     *
     * Authentication
     * Required scope: analytics:read:games
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-game-analytics
     *
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGameAnalytics(array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets a URL that game developers can use to download analytics reports (CSV files) for their games.
     *
     * Authentication
     * Required scope: analytics:read:games
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-game-analytics
     *
     * @param string $game_id
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getGameAnalyticsByGameId(string $game_id, array $options = [], PaginatorContract $paginator = null): ResultContract;
}
