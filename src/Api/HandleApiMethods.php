<?php

namespace Sevenpluss\TwitchApi\Api;

use Sevenpluss\TwitchApi\Contracts\ApiRequest;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Trait HandleApiMethods
 *
 * @package Sevenpluss\TwitchApi\Api
 */
trait HandleApiMethods
{
    /**
     * @var TwitchApiContract
     */
    protected $mediator;

    /**
     * @return ApiRequest
     */
    protected function request(): ApiRequest
    {
        return $this->mediator->request();
    }
}
