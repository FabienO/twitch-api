<?php

namespace Sevenpluss\TwitchApi\Exceptions;

use Exception;

/**
 * Class UriMissingException
 *
 * @package Sevenpluss\TwitchApi\Exceptions
 */
class UriMissingException extends Exception
{
    /**
     * UriMissingException constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('No Twitch Redirect URI set');
    }
}
