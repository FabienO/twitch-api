<?php

namespace Sevenpluss\TwitchApi\Exceptions;

use Exception;

/**
 * Class ClientIdMissingException
 *
 * @package Sevenpluss\TwitchApi\Exceptions
 */
class ClientIdMissingException extends Exception
{
    /**
     * ClientIdMissingException constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('No Twitch Client-ID specified');
    }
}
