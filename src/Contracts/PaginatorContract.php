<?php

namespace Sevenpluss\TwitchApi\Contracts;


/**
 * Interface PaginatorContract
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface PaginatorContract
{
    /**
     * Create Paginator from Result object
     *
     * @param ResultContract $result
     *
     * @return PaginatorContract
     */
    public static function from(ResultContract $result): PaginatorContract;

    /**
     * Get Next desired action (first, after, before)
     *
     * @return string|null
     */
    public function action(): ?string;

    /**
     * Return the current active cursor
     *
     * @return string|null Twitch cursor
     */
    public function cursor(): ?string;

    /**
     * Set the Paginator to fetch the next set of results
     *
     * @return PaginatorContract
     */
    public function first(): PaginatorContract;

    /**
     * Set the Paginator to fetch the first set of results
     *
     * @return PaginatorContract
     */
    public function next(): PaginatorContract;

    /**
     * Set the Paginator to fetch the last set of results
     *
     * @return PaginatorContract
     */
    public function back(): PaginatorContract;
}
