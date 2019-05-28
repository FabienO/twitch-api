<?php

namespace Sevenpluss\TwitchApi\Services;

use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;

/**
 * Class Paginator
 *
 * @package Sevenpluss\TwitchApi\Services
 */
class Paginator implements PaginatorContract
{
    /**
     * Twitch response pagination cursor
     *
     * @var array|null
     */
    protected $pagination;

    /**
     * Next desired action (first, after, before)
     *
     * @var string|null
     */
    protected $action;

    /**
     * Paginator constructor.
     *
     * @param array|null $pagination Twitch response pagination cursor
     *
     * @return void
     */
    public function __construct(array $pagination = null)
    {
        $this->pagination = $pagination;
    }

    /**
     * @inheritDoc
     */
    public static function from(ResultContract $result): PaginatorContract
    {


        return new self($result->pagination());
    }

    /**
     * @inheritDoc
     */
    public function action(): ?string
    {
        return $this->action;
    }

    /**
     * @inheritDoc
     */
    public function cursor(): ?string
    {
        return $this->pagination['cursor'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function first(): PaginatorContract
    {
        $this->action = 'first';
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function next(): PaginatorContract
    {
        $this->action = 'after';
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function back(): PaginatorContract
    {
        $this->action = 'before';
        return $this;
    }
}
