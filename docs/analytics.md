# Analytics

Extension and game analytics

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

`$options` is an optional parameter

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$twitch->analytics()->getExtensionAnalytics();
$twitch->analytics()->getExtensionAnalyticsByExtensionId('abcdefgh');

$game_id = '493057';

$options = [
    'game_id' => $game_id
];

$twitch->analytics()->getGameAnalytics($options);
$twitch->analytics()->getGameAnalyticsByGameId($game_id);

```

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class AnalyticController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function extensionAnalytics()
    {
        $analytic = $this->api->analytics()->getExtensionAnalytics()->data();
        
        return compact('analytic');
    }
    
    public function extensionAnalyticsByExtensionId()
    {
        $analytic = $this->api->analytics()->getExtensionAnalyticsByExtensionId('abcdefgh')->data();
               
        return compact('analytic'); 
    }
    
    public function gameAnalytics()
    {
        $analytic = $this->api->analytics()->getGameAnalytics([
            'game_id' => '493057'                                   ])->data();
        
        return compact('analytic');
    }
    
    public function gameAnalyticsByGameId()
    {
        $analytic = $this->api->analytics()->getGameAnalyticsByGameId('493057')->data();
                
        return compact('analytic');
    }
}
```
