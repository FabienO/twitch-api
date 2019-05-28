# Broadcaster

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$twitch->broadcaster()->getBroadcasterSubscriptions('31239503');
$twitch->broadcaster()->getBroadcasterSubscribers('31239503', [ '257788195']);
```

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class BroadcasterController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function subscriptions()
    {
        $subscriptions = $this->api->broadcaster()->getBroadcasterSubscriptions('31239503')->data();
        
        return compact('subscriptions');
    }
    
    public function subscribers()
    {
        $subscribers = $this->api->broadcaster()->getBroadcasterSubscribers('31239503', ['257788195'])->data();
        
        return compact('subscribers');
    }
}
```
