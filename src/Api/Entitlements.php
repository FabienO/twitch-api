<?php

namespace Sevenpluss\TwitchApi\Api;

use BadMethodCallException;
use Sevenpluss\TwitchApi\Contracts\ApiEntitlements;
use Sevenpluss\TwitchApi\Contracts\ResultContract;
use Sevenpluss\TwitchApi\Contracts\TwitchApiContract;

/**
 * Class Entitlements
 *
 * @package Sevenpluss\TwitchApi\Api
 */
class Entitlements implements ApiEntitlements
{
    use HandleApiMethods;

    protected const ENDPOINT_ENTITLEMENTS_UPLOAD = 'entitlements/upload';

    protected const ENDPOINT_ENTITLEMENTS_CODES = 'entitlements/codes';

    /**
     * @inheritDoc
     */
    public function setApiMediator(TwitchApiContract $api): ApiEntitlements
    {
        $this->mediator = $api;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createEntitlementUrl(string $manifest): ResultContract
    {
        return $this->request()->post(self::ENDPOINT_ENTITLEMENTS_UPLOAD, [
            'manifest_id' => $manifest,
            'type' => 'bulk_drops_grant'
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getCodeStatus(int $user_id, array $codes): ResultContract
    {
        $count = count($codes);

        if (!$count || $count > 20) {
            throw  new BadMethodCallException('Missed or over limit the property of Codes');
        }

        return $this->request()->get(self::ENDPOINT_ENTITLEMENTS_CODES, [
            'user_id' => $user_id,
            'code' => implode('&code=', $codes)
        ]);
    }

    /**
     * @inheritDoc
     */
    public function redeemCode(int $user_id, array $codes): ResultContract
    {
        $count = count($codes);

        if (!$count || $count > 20) {
            throw  new BadMethodCallException('Missed or over limit the property of Codes');
        }

        return $this->request()->post(self::ENDPOINT_ENTITLEMENTS_CODES, [
            'user_id' => $user_id,
            'code' => implode('&code=', $codes)
        ]);
    }
}
