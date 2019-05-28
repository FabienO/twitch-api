<?php

namespace Sevenpluss\TwitchApi\Exceptions;

use Exception;

/**
 * Class ClientSecretMissingException
 *
 * @package Sevenpluss\TwitchApi\Exceptions
 */
class ClientSecretMissingException extends Exception
{
    /**
     * ClientSecretMissingException constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('No Twitch Client-Secret specified');
    }
}
