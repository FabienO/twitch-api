<?php

namespace Sevenpluss\TwitchApi\Contracts;

use GuzzleHttp\Psr7\Request;

/**
 * Interface ResultContract
 *
 * @package Sevenpluss\TwitchApi\Contracts
 */
interface ResultContract
{
    /**
     * Returns whether the query was successful
     *
     * @return bool Success state
     */
    public function success(): bool;

    /**
     * Get the response data, also available as public attribute
     *
     * @return array
     */
    public function data(): array;

    /**
     * Returns the last HTTP or API error
     *
     * @return string Error message
     */
    public function error(): string;

    /**
     * Shifts the current result (Use for single user/video etc. query)
     *
     * @return array|null
     */
    public function shift(): ?array;

    /**
     * Return the current count of items in dataset
     *
     * @return int
     */
    public function count(): int;

    /**
     * @return bool
     */
    public function hasPaginator(): bool;

    /**
     * @return PaginatorContract|null
     */
    public function paginator(): ?PaginatorContract;

    /**
     * @return array|null
     */
    public function pagination(): ?array ;

    /**
     * Set the original Guzzle HTTP Request
     *
     * @param Request $request
     *
     * @return void
     */
    public function setRequest(Request $request): void;

    /**
     * Get the original Guzzle HTTP Request
     *
     * @return Request
     */
    public function getRequest(): Request;
}
