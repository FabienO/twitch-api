# Tags

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Example Usage

```php
<?php

namespace YourApp\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class TagController
{
    protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
        
    }
    
    public function allStreamTags()
    {
        $tags = $this->api->tags()->getAllStreamTags()->data();
        
        return compact('tags');
    }
    
    public function streamTagsByBroadcasterId()
    {
        $broadcaster_id = '31239503';
        
        $tags = $this->api->tags()->getStreamTagsByBroadcasterId($broadcaster_id)->data();
          
        return compact('tags');      
    }
    
    public function replaceStreamTags()
    {
        $broadcaster_id = '257788195';
        
        $tags = [
            '621fb5bf-5498-4d8f-b4ac-db4d40d401bf',
            '79977fb9-f106-4a87-a386-f1b0f99783dd'
            ];
        
        $response = $this->api->tags()->replaceStreamTags($broadcaster_id, $tags);
        
        return $response->success();
    }
}
```
