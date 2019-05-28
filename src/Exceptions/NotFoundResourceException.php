<?php

namespace Sevenpluss\TwitchApi\Exceptions;

use Exception;

/**
 * Interface NotFoundResourceException
 *
 * @package Sevenpluss\TwitchApi\Exceptions
 */
class NotFoundResourceException extends Exception
{
    /**
     * NotFoundResourceException constructor.
     *
     * @param string $resource
     *
     * @return void
     */
    public function __construct(string $resource)
    {
        parent::__construct('Not Found Resource ' . $resource, 404);
    }
}
