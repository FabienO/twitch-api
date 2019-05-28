<?php

namespace Sevenpluss\TwitchApi\Services;

use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;

/**
 * Class Result
 *
 * @package Sevenpluss\TwitchApi\Services
 */
class Result implements ResultContract
{
    /**
     * The query is successful?
     *
     * @var bool
     */
    protected $success = false;

    /**
     * Guzzle exception, if present
     *
     * @var Exception|null
     */
    protected $exception = null;

    /**
     * The query result data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Total amount of result data
     *
     * @var int
     */
    protected $total = 0;

    /**
     * Status Code
     *
     * @var int
     */
    protected $status = 0;

    /**
     * Original Guzzle HTTP Response
     *
     * @var Response
     */
    protected $response;

    /**
     * Original Guzzle HTTP Request
     *
     * @var Request
     */
    protected $request;

    /**
     * Twitch response pagination cursor
     *
     * @var array|null
     */
    protected $pagination;

    /**
     * Internal paginator
     *
     * @var Paginator|null
     */
    protected $paginator;

    /**
     * Constructor
     *
     * @param Response $response HTTP response
     * @param Exception|null $exception Exception, if present
     * @param PaginatorContract|null $paginator
     *
     * @return void
     */
    public function __construct(Response $response, Exception $exception = null, PaginatorContract $paginator = null)
    {
        $this->response = $response;

        $this->success = $exception === null;

        $this->exception = $exception;

        $this->status = $response->getStatusCode();

        $json = @json_decode($response->getBody(), true);

        if(isset($json['data'])){
            $this->data = $json['data'];
        } else {
            $this->data = $json;
        }

        if(isset($json['pagination'])){

            $this->pagination = $json['pagination'];
        }

        if(isset($json['total'])){

            $this->total = $json['total'];
        }

        if($exception instanceof Exception && $paginator instanceof PaginatorContract){
            $this->paginator = $paginator;
        } else {
            $this->paginator = Paginator::from($this);
        }
    }

    /**
     * @inheritDoc
     */
    public function success(): bool
    {
        return $this->success;
    }

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return $this->data['data'] ?? $this->data;
    }

    /**
     * @inheritDoc
     */
    public function error(): string
    {
        if ($this->exception === null || !$this->exception->hasResponse()) {
            return 'Twitch API Unavailable';
        }

        $exception = (string)$this->exception->getResponse()->getBody();
        $exception = @json_decode($exception);

        if (property_exists($exception, 'message') && !empty($exception->message)) {
            return $exception->message;
        }

        return $this->exception->getMessage();
    }

    /**
     * @inheritDoc
     */
    public function shift(): ?array
    {
        if (!empty($this->data())) {
            $data = $this->data();

            return array_shift($data);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count((array)$this->data);
    }

    /**
     * @inheritDoc
     */
    public function hasPaginator(): bool
    {
        return $this->paginator instanceof PaginatorContract;
    }

    /**
     * @inheritDoc
     */
    public function paginator(): ?PaginatorContract
    {
        return $this->paginator;
    }

    /**
     * @inheritDoc
     */
    public function pagination(): ?array
    {
        return $this->pagination;
    }

    /**
     * @inheritDoc
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
