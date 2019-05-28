# Webhook Subscriptions

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class WebhookController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function webhook()
    {
        $hooks = $this->api->webhooks()->getWebhookSubscriptions()->data();
        
        return compact('hooks');
    }
}
```
