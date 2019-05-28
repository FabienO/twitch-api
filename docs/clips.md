# Clips

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$broadcaster_id = '44322889';
$twitch->clips()->createClip($broadcaster_id);

$options = [
    'broadcaster_id'=> $broadcaster_id
];

$twitch->clips()->getClip($options);

```

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class ClipController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function create()
    {
        $clip = $this->api->clips()->createClip('44322889')->data();
        
        return compact('clip');
    }
    
    public function show()
    {
        $clip = $this->api->clips()->getClip([
            'broadcaster_id'=> '44322889'                           ])->data();
        
        return compact('clip');
    }
}
```
