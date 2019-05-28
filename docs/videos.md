# Videos

Video objects

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class VideoController
{
    
    protected $api;
        
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
            
    }
    
    public function videosByUserId()
    {
        $videos = $this->api->videos()->getVideosByUserId('31239503')->data();
                
        return compact('videos');
    }
    
    public function videoById()
    {
        $video = $this->api->videos()->getVideoById('2222222')->data();
                        
        return compact('video');
    }
    
    public function videosByGameId()
    {
        $videos = $this->api->videos()->getVideosByGameId('493057')->data();
                        
        return compact('videos');   
    }   
}
```
