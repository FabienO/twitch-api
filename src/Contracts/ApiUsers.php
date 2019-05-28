<?php

namespace Sevenpluss\TwitchApi\Contracts;

use BadMethodCallException;
use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiUsers
 *
 * @package Sevenpluss\TwitchApi\Contracts
 * @link    https://dev.twitch.tv/docs/api/reference/#get-users
 */
interface ApiUsers
{
    /**
     * @param TwitchApiContract $twitch
     *
     * @return ApiUsers
     */
    public function setApiMediator(TwitchApiContract $twitch): ApiUsers;

    /**
     * Gets information about one or more specified Twitch users
     *
     * Options:
     * string   id     User ID. Multiple user IDs can be specified. Limit: 100.
     * string   login  User login name. Multiple login names can be specified. Limit: 100.
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users
     *
     * @param array $options Array of parameters
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getUsers(array $options = []): ResultContract;

    /**
     * Gets information about one specified Twitch user by ID
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users
     *
     * @param string $id User ID
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getUserById(string $id): ResultContract;

    /**
     * Gets information about one specified Twitch user by name
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users
     *
     * @param string $name Twitch Username
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getUserByName(string $name): ResultContract;

    /**
     * Gets information about one or more specified Twitch users by IDs
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users
     *
     * @param string[] $ids User IDs
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getUsersByIds(array $ids): ResultContract;

    /**
     * Gets information about one or more specified Twitch users by names
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users
     *
     * @param string[] $names Twitch Usernames
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getUsersByNames(array $names): ResultContract;

    /**
     * Updates the description of a user specified by a Bearer token
     *
     * @link  https://dev.twitch.tv/docs/api/reference#update-user
     *
     * @param string $description New description
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function updateUser(string $description): ResultContract;

    /**
     * FOLLOWS
     */

    /**
     * Gets information on follow relationships between two Twitch users
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users-follows
     *
     * @param string|null $from User ID. The request returns information about users who are being followed by the from_id user
     * @param string|null $to User ID. The request returns information about users who are following the to_id user
     * @param array $options
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     * @throws BadMethodCallException
     */
    public function getFollows(string $from = null, string $to = null, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information on follows from one user
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users-follows
     *
     * @param string $from User ID. The request returns information about users who are being followed by the from_id user
     * @param array $options
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getFollowsFrom(string $from, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * Gets information on follows to one user
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-users-follows
     *
     * @param string $to User ID. The request returns information about users who are following the to_id user
     * @param array $options
     * @param PaginatorContract $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getFollowsTo(string $to, array $options = [], PaginatorContract $paginator = null): ResultContract;

    /**
     * EXTENSIONS
     */

    /**
     * Get currently authed user's extensions with Bearer Token
     * Note: Bearer OAuth Token and the state "user:edit:broadcast" are both required
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-user-extensions
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getAuthUserExtensions(): ResultContract;

    /**
     * Get currently authed user's active extensions with Bearer Token
     * Note: Bearer OAuth Token and the state "user:edit:broadcast" are both required
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-user-active-extensions
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getAuthUserActiveExtensions(): ResultContract;

    /**
     * Disable all UserUserExtensions of the currently authed user's active extensions with Bearer Token
     * Note: Bearer OAuth Token and the state "user:edit:broadcast" are both required
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#update-user-extensions
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function disableAllExtensions(): ResultContract;

    /**
     * Disables all UserUserExtensions of the currently authed user's active extensions, that have the given id with Bearer Token
     * Note: Bearer OAuth Token and the state "user:edit:broadcast" are both required
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#update-user-extensions
     *
     * @param string|null $extension Id of the Extension that should be deactivated
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function disableUserExtensionById(string $extension = null): ResultContract;

    /**
     * Disables all UserUserExtensions of the currently authed user's active extensions, that have the given Name with Bearer Token
     * Note: Bearer OAuth Token and the state "user:edit:broadcast" are both required
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#update-user-extensions
     *
     * @param string|null $extension Name of the Extension that should be deactivated
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function disableUserExtensionByName(string $extension = null): ResultContract;

    /**
     * Updates the activation state, extension ID, and/or version number of installed extensions for a specified user, identified by a Bearer token.
     * If you try to activate a given extension under multiple extension types, the last write wins (and there is no guarantee of write order).
     * Note: Bearer OAuth Token and the state "user:edit:broadcast" are both required
     *
     * @link  https://dev.twitch.tv/docs/api/reference/#update-user-extensions
     *
     * @param string|null $method Method that will be used to disable extensions
     * @param string|null $extension Parameter that will be used to disable UserUserExtensions
     * @param bool $disabled Weather the set value should be false
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function updateUserExtensions(string $method = null, string $extension = null, bool $disabled = false): ResultContract;
}
