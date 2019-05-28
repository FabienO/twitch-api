<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiTags;
use Sevenpluss\TwitchApi\Contracts\PaginatorContract;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Tags
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Tags implements ApiTags
{
    use HandleApiMethods;

    protected const URL_TAGS = 'tags/streams';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiTags
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAllStreamTags(array $options = [], PaginatorContract $paginator = null): ResultContract
    {
        if (isset($options['tag_id']) && is_array($options['tag_id'])) {

            $count = count($options['tag_id']);

            if (!$count || $count > 100) {
                throw  new BadMethodCallException('Missed or over limit the property of tag_id');
            }

            $options['tag_id'] = implode('&tag_id=', $options['tag_id']);
        }

        return $this->request()->get(self::URL_TAGS, $options, $paginator);
    }

    /**
     * @inheritDoc
     */
    public function getStreamTagsByBroadcasterId(string $broadcaster_id): ResultContract
    {
        return $this->request()->get(self::URL_TAGS, [
            'broadcaster_id' => $broadcaster_id
        ]);
    }

    /**
     * @inheritDoc
     */
    public function replaceStreamTags(string $broadcaster_id, array $tag_ids = []): ResultContract
    {
        $options = [
            'broadcaster_id' => $broadcaster_id
        ];

        if(!empty($tag_ids)){

            $count = count($tag_ids);

            if ($count > 100) {
                throw  new BadMethodCallException('Over limit the property of tag_ids');
            }

            $options['tag_ids'] = $tag_ids;
        }

        return $this->request()->json('PUT',self::URL_TAGS, $options);
    }
}
