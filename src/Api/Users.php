<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiUsers;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Users
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Users implements ApiUsers
{
    use HandleApiMethods;

    protected const ENDPOINT_USERS = 'users';

    protected const ENDPOINT_USERS_FOLLOWS = 'users/follows';

    protected const ENDPOINT_USERS_EXTENSIONS_LIST = 'users/extensions/list';

    protected const ENDPOINT_USERS_EXTENSIONS = 'users/extensions';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiUsers
    {
        $this->mediator = $api;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsers(array $options = []): ResultContract
    {
        if (!isset($options['id'], $options['login']) && !array_key_exists('login', $options) && !array_key_exists('id', $options)) {
            if (!isset($options['id'])) {
                throw new BadMethodCallException('Missed required property: id');
            } elseif (!isset($options['login'])) {
                throw new BadMethodCallException('Missed required property: login');
            } else {
                throw new BadMethodCallException('Missed required property: login and id');
            }
        }

        return $this->request()->get(self::ENDPOINT_USERS, $options);
    }

    /**
     * @inheritDoc
     */
    public function getUserById(string $id): ResultContract
    {
        $options['id'] = $id;

        return $this->getUsers($options);
    }

    /**
     * @inheritDoc
     */
    public function getUserByName(string $name): ResultContract
    {
        $options['login'] = $name;

        return $this->getUsers($options);
    }

    /**
     * @inheritDoc
     */
    public function getUsersByIds(array $ids): ResultContract
    {
        $count = count($ids);

        if (!$count || $count > 100) {
            throw  new BadMethodCallException('Missed or over limit the property of User IDs');
        }

        $options['id'] = implode('&id=', $ids);

        return $this->getUsers($options);
    }

    /**
     * @inheritDoc
     */
    public function getUsersByNames(array $names): ResultContract
    {
        $count = count($names);

        if (!$count || $count > 100) {
            throw  new BadMethodCallException('Missed or over limit the property of User Names');
        }

        $options['login'] = implode('&login=', $names);

        return $this->getUsers($options);
    }

    /**
     * @inheritDoc
     */
    public function updateUser(string $description): ResultContract
    {
        return $this->request()->put('users', [
            'description' => $description,
        ]);
    }

    /**
     * FOLLOWS
     */

    /**
     * @inheritDoc
     */
    public function getFollows(string $from = null, string $to = null, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        if (is_null($from) && is_null($to)) {
            throw new BadMethodCallException('At minimum, from or to must be provided for a query to be valid');
        }

        if (!is_null($from)) {
            $options['from_id'] = $from;
        }

        if (!is_null($to)) {
            $options['to_id'] = $to;
        }

        return $this->request()->get(self::ENDPOINT_USERS_FOLLOWS, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getFollowsFrom(string $from, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->getFollows($from, null, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getFollowsTo(string $to, array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->getFollows(null, $to, $options, $paginator);
    }

    /**
     * EXTENSIONS
     */

    /**
     * @inheritDoc
     */
    public function getAuthUserExtensions(): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_USERS_EXTENSIONS_LIST);
    }

    /**
     * @inheritDoc
     */
    public function getAuthUserActiveExtensions(): ResultContract
    {
        return $this->request()->get(self::ENDPOINT_USERS_EXTENSIONS);
    }

    /**
     * @inheritDoc
     */
    public function disableAllExtensions(): ResultContract
    {
        return $this->updateUserExtensions(null, null, true);
    }

    /**
     * @inheritDoc
     */
    public function disableUserExtensionById(string $extension = null): ResultContract
    {
        return $this->updateUserExtensions('id', $extension, false);
    }

    /**
     * @inheritDoc
     */
    public function disableUserExtensionByName(string $extension = null): ResultContract
    {
        return $this->updateUserExtensions('name', $extension, false);
    }

    /**
     * @inheritDoc
     */
    public function updateUserExtensions(string $method = null, string $extension = null, bool $disabled = false): ResultContract
    {
        $result = $this->getAuthUserActiveExtensions();

        $extensions = (array)$result->data();

        $data = (object)[
            'panel' => $extensions['panel'],
            'overlay' => $extensions['overlay'],
            'component' => $extensions['component']
        ];

        $processType = function (string $type) use (&$data, $method, $extension, $disabled) {
            $i = 1;

            foreach ($data->{$type} as $key => $value) {

                if ($disabled === true) {
                    $data->{$type}->{$i}->active = false;
                } else {

                    if (isset($value->{$method})) {

                        if ($value->{$method} <=> $extension) {
                            $data->{$type}->{$i}->active = false;
                        } else {
                            $data->{$type}->{$i}->active = $value->active;
                        }

                    } else {
                        $data->{$type}->{$i} = $value;
                    }
                }
                $i++;
            }
        };

        $processType('panel');
        $processType('overlay');
        $processType('component');

        return $this->request()->json('PUT', self::ENDPOINT_USERS_EXTENSIONS, (array)$data);
    }
}
