<?php

namespace Sevenpluss\TwitchApi\Exceptions;

use Exception;

/**
 * Class AuthenticationException
 *
 * @package Sevenpluss\TwitchApi\Exceptions
 */
class AuthenticationException extends Exception
{
    /**
     * AuthenticationException constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Unauthenticated Twitch User.', 403);
    }
}
