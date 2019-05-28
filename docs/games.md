# Games

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

`$options` is an optional parameter

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$twitch->games()->getGames(['id'=> '493057']);

$twitch->games()->getGamesById('493057');

$twitch->games()->getGamesByName('esl_csgo');

$ids = [
    '493057',
    '363057'  
];

$twitch->games()->getGamesByIds($ids);

$names = [
    'esl_csgo',
    'dota2ruhub'
];

$twitch->games()->getGamesByNames($names);

$twitch->games()->getTopGames();

```


## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class GameController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function games()
    {
        $games = $this->api->games()->getGames(['id'=> '493057', 'name'=> 'Pokemon'])->data();
        
        return compact('games');
    }
    
    public function gamesById()
    {
        $games = $this->api->games()->getGamesById('493057')->data();
        
        return compact('games');
    }
    
    public function gamesByIds()
    {
        $games = $this->api->games()->getGamesByIds([
            '493057',                                                   '363057'  
        ])->data();
            
        return compact('games');
    }
    
    public function gamesByName()
    {
        $games = $this->api->games()->getGamesByName('Pokemon')->data();
            
        return compact('games');   
    }
    
    public function gamesByNames()
    {
        $games = $this->api->games()->getGamesByNames([
                'Pokemon',
                'Dota2'
            ])->data();
                
        return compact('games');   
    }
    
    public function topGames()
    {
        $games = $this->api->games()->getTopGames()->data();
                
        return compact('games');   
    }
}
```
