# Bits Leaderboard

Gets a ranked list of Bits leaderboard information for an authorized broadcaster

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

`$options` is an optional parameter

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$twitch->bits()->getBitsLeaderboard();

$twitch->bits()->getBitsLeaderboardByUserId('31239503');

```

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class BitController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function leaderboard()
    {
        $bits = $this->api->bits()->getBitsLeaderboard()->data();
        
        return compact('bits');
    }
    
    public function leaderboardByUserId()
    {
        $bits = $this->api->bits()->getBitsLeaderboardByUserId('31239503')->data();
        
        return compact('bits');
    }
}
```
