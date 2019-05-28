# Entitlements

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$manifest = '123456789';
$twitch->entitlements()->createEntitlementUrl($manifest);

$user_id = 156900877;

$codes = [
    '8CD5P-V3J92-2S6JY',
    'PUN4G-HYFVP-MMFET'
];

$twitch->entitlements()->getCodeStatus($user_id, $codes);

$twitch->entitlements()->redeemCode($user_id, []);
```

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class EntitlementController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function createEntitlementUrl()
    {
        $url = $this->api->entitlements()->createEntitlementUrl('123456789')->data();
        
        return compact('url');
    }
    
    public function codeStatus()
    {
        $user_id = 156900877;
        
        $codes = [
            '8CD5P-V3J92-2S6JY',
            'PUN4G-HYFVP-MMFET'
        ];
        
        $code = $this->api->entitlements()->getCodeStatus($user_id, $codes)->data();
        
        return compact('code');
    }
    
    public function redeemCode()
    {
        $user_id = 156900877;
             
        $codes = [
           '8CD5P-V3J92-2S6JY',
           'PUN4G-HYFVP-MMFET'
        ];
        
        $response = $this->api->entitlements()->redeemCode($user_id, $codes);
        
        return compact('response');
    }
}
```
