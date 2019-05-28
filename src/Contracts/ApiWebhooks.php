<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Sevenpluss\TwitchApi\Exceptions\ClientIdMissingException;
use Sevenpluss\TwitchApi\Exceptions\TokenMissingException;

/**
 * Interface ApiWebhooks
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ApiWebhooks
{
    /**
     * @param TwitchApiContract $api
     *
     * @return ApiWebhooks
     */
    public function setApiMediator(TwitchApiContract $api): ApiWebhooks;

    /**
     * Gets the Webhook subscriptions of a user identified by a Bearer token, in order of expiration
     *
     * @link  https://dev.twitch.tv/docs/api/reference#get-webhook-subscriptions
     *
     * @param array $options
     * @param PaginatorContract|null $paginator
     *
     * @return ResultContract
     * @throws GuzzleException
     * @throws ClientIdMissingException
     * @throws TokenMissingException
     */
    public function getWebhookSubscriptions(array $options = [], PaginatorContract $paginator = null): ResultContract;
}
