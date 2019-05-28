<?php

namespace Sevenpluss\TwitchApi\Api;

use Sevenpluss\TwitchApi\Contracts\ApiWebhooks;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Webhooks
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Webhooks implements ApiWebhooks
{
    use HandleApiMethods;

    protected const URL_WEBHOOKS_SUBSCRIPTIONS = 'webhooks/subscriptions';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiWebhooks
    {
        $this->mediator = $api;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getWebhookSubscriptions(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        return $this->request()->get(self::URL_WEBHOOKS_SUBSCRIPTIONS, $options, $paginator);
    }
}
