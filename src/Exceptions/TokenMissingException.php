<?php

namespace Sevenpluss\TwitchApi\Exceptions;

use Exception;

/**
 * Class TokenMissingException
 *
 * @package Sevenpluss\TwitchApi\Exceptions
 */
class TokenMissingException extends Exception
{
    /**
     * TokenMissingException constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('No Twitch Token set');
    }
}
