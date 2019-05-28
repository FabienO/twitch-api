<?php

namespace Sevenpluss\TwitchApi\Services;

use Sevenpluss\TwitchApi\Api\Analytics;
use Sevenpluss\TwitchApi\Api\Bits;
use Sevenpluss\TwitchApi\Api\Broadcaster;
use Sevenpluss\TwitchApi\Api\Clips;
use Sevenpluss\TwitchApi\Api\Entitlements;
use Sevenpluss\TwitchApi\Api\Games;
use Sevenpluss\TwitchApi\Api\Request;
use Sevenpluss\TwitchApi\Api\Streams;
use Sevenpluss\TwitchApi\Api\Tags;
use Sevenpluss\TwitchApi\Api\Users;
use Sevenpluss\TwitchApi\Api\Videos;
use Sevenpluss\TwitchApi\Api\Webhooks;
use Sevenpluss\TwitchApi\Contracts\ApiAnalytics;
use Sevenpluss\TwitchApi\Contracts\ApiBits;
use Sevenpluss\TwitchApi\Contracts\ApiBroadcaster;
use Sevenpluss\TwitchApi\Contracts\ApiClips;
use Sevenpluss\TwitchApi\Contracts\ApiEntitlements;
use Sevenpluss\TwitchApi\Contracts\ApiGames;
use Sevenpluss\TwitchApi\Contracts\ApiRequest;
use Sevenpluss\TwitchApi\Contracts\ApiStreams;
use Sevenpluss\TwitchApi\Contracts\ApiTags;
use Sevenpluss\TwitchApi\Contracts\ApiUsers;
use Sevenpluss\TwitchApi\Contracts\ApiVideos;
use Sevenpluss\TwitchApi\Contracts\ApiWebhooks;
use Sevenpluss\TwitchApi\Contracts\ClientSettingsContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class TwitchApi
 *
 * @package Sevenpluss\TwitchApi\Services
 */
class TwitchApi implements TwitchApiContract
{
    /**
     * @var ClientSettingsContract
     */
    protected $settings;

    /**
     * @var ApiRequest
     */
    protected $request;

    /**
     * @var ApiAnalytics
     */
    protected $analytics;

    /**
     * @var ApiBits
     */
    protected $bits;

    /**
     * @var ApiClips
     */
    protected $clips;

    /**
     * @var ApiEntitlements
     */
    protected $entitlements;

    /**
     * @var ApiGames
     */
    protected $games;

    /**
     * @var ApiStreams
     */
    protected $streams;

    /**
     * @var ApiBroadcaster
     */
    protected $broadcaster;

    /**
     * @var ApiTags
     */
    protected $tags;

    /**
     * @var ApiUsers
     */
    protected $users;

    /**
     * @var ApiVideos
     */
    protected $videos;

    /**
     * @var ApiWebhooks
     */
    protected $webhooks;

    /**
     * TwitchApi constructor.
     *
     * @param ClientSettingsContract $settings
     *
     * @return void
     */
    public function __construct(ClientSettingsContract $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return ClientSettingsContract
     */
    public function settings(): ClientSettingsContract
    {
        return $this->settings;
    }

    /**
     * @param string|null $token
     *
     * @return ApiRequest
     */
    public function request(string $token = null): ApiRequest
    {
        if (is_null($this->request)) {
            $this->request = new Request($token);
            $this->request->setApiMediator($this);
        }

        return $this->request;
    }

    /**
     * @inheritDoc
     */
    public function analytics(): ApiAnalytics
    {
        if (is_null($this->analytics)) {
            $this->analytics = new Analytics;
            $this->analytics->setApiMediator($this);
        }

        return $this->analytics;
    }

    /**
     * @inheritDoc
     */
    public function bits(): ApiBits
    {
        if (is_null($this->bits)) {
            $this->bits = new Bits;
            $this->bits->setApiMediator($this);
        }

        return $this->bits;
    }

    /**
     * @inheritDoc
     */
    public function clips(): ApiClips
    {
        if (is_null($this->clips)) {
            $this->clips = new Clips;
            $this->clips->setApiMediator($this);
        }

        return $this->clips;
    }

    /**
     * @inheritDoc
     */
    public function entitlements(): ApiEntitlements
    {
        if (is_null($this->entitlements)) {
            $this->entitlements = new Entitlements;
            $this->entitlements->setApiMediator($this);
        }

        return $this->entitlements;
    }

    /**
     * @inheritDoc
     */
    public function games(): ApiGames
    {
        if (is_null($this->games)) {
            $this->games = new Games;
            $this->games->setApiMediator($this);
        }

        return $this->games;
    }

    /**
     * @inheritDoc
     */
    public function streams(): ApiStreams
    {
        if (is_null($this->streams)) {
            $this->streams = new Streams;
            $this->streams->setApiMediator($this);
        }

        return $this->streams;
    }

    /**
     * @inheritDoc
     */
    public function broadcaster(): ApiBroadcaster
    {
        if (is_null($this->broadcaster)) {
            $this->broadcaster = new Broadcaster;
            $this->broadcaster->setApiMediator($this);
        }

        return $this->broadcaster;
    }

    /**
     * @inheritDoc
     */
    public function tags(): ApiTags
    {
        if (is_null($this->tags)) {
            $this->tags = new Tags;
            $this->tags->setApiMediator($this);
        }

        return $this->tags;
    }

    /**
     * @inheritDoc
     */
    public function users(): ApiUsers
    {
        if (is_null($this->users)) {
            $this->users = new Users;
            $this->users->setApiMediator($this);
        }

        return $this->users;
    }

    /**
     * @inheritDoc
     */
    public function videos(): ApiVideos
    {
        if (is_null($this->videos)) {
            $this->videos = new Videos;
            $this->videos->setApiMediator($this);
        }

        return $this->videos;
    }

    public function webhooks(): ApiWebhooks
    {
        if (is_null($this->webhooks)) {
            $this->webhooks = new Webhooks;
            $this->webhooks->setApiMediator($this);
        }

        return $this->webhooks;
    }
}
