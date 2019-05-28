# Helix Twitch Api

[![Latest Stable Version](https://img.shields.io/packagist/v/sevenpluss/twitch-api.svg?style=flat-square)](https://packagist.org/packages/sevenpluss/twitch-api)
[![Total Downloads](https://img.shields.io/packagist/dt/sevenpluss/twitch-api.svg?style=flat-square)](https://packagist.org/packages/sevenpluss/twitch-api)
[![License](https://img.shields.io/packagist/l/sevenpluss/twitch-api.svg?style=flat-square)](https://packagist.org/packages/sevenpluss/twitch-api)

**NOTICE:** This library uses the latest Twitch HELIX API which ist not fully featured yet

## Table of contents

1. [Installation](https://github.com/sevenpluss/twitch-api#installation)
2. [Usage Example](https://github.com/sevenpluss/twitch-api#usage)
3. [Configuration](https://github.com/sevenpluss/twitch-api#configuration)
4. [Documentation](https://github.com/sevenpluss/twitch-api#documentation)

## Installation

Minimum Requirements: __php 7.1__

```
composer require sevenpluss/twitch-api
```

Or add `sevenpluss/twitch-api` to your `composer.json`

```
"sevenpluss/twitch-api": "^1.0"
```

Run `composer update` to pull the latest version.

## Usage Example

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
        // make a self extended ClientSettings class with custom settings
        $settings = new ClientSettings('client_id', 'client_secret', 'redirect_url');
        
        $this->api = new TwitchApi($settings);
        
    }
    
    public function index()
    {
        $videos = $this->api->videos()->getVideosByUserId('31239503')->data();
        
        return compact('videos');
    }
}
```

## Configuration

1. [Laravel Configuration](https://github.com/sevenpluss/twitch-api)

## Documentation

**Twitch Helix API Documentation: https://dev.twitch.tv/docs/api/reference**

The everyone response from Twitch Server encapsulated at `Services/Result` object. 

1. [Analytics](https://github.com/sevenpluss/twitch-api/tree/master/docs/analytics.md)
2. [Bits Leaderboard](https://github.com/sevenpluss/twitch-api/tree/master/docs/bits.md)
3. [Clips](https://github.com/sevenpluss/twitch-api/tree/master/docs/clips.md)
4. [Entitlements](https://github.com/sevenpluss/twitch-api/tree/master/docs/entitlements.md)
5. [Games](https://github.com/sevenpluss/twitch-api/tree/master/docs/games.md)
6. [Streams](https://github.com/sevenpluss/twitch-api/tree/master/docs/streams.md)
7. [Broadcaster](https://github.com/sevenpluss/twitch-api/tree/master/docs/broadcaster.md)
8. [Tags](https://github.com/sevenpluss/twitch-api/tree/master/docs/tags.md)
9. [Users](https://github.com/sevenpluss/twitch-api/tree/master/docs/users.md)
10. [Videos](https://github.com/sevenpluss/twitch-api/tree/master/docs/videos.md)
11. [WebHooks](https://github.com/sevenpluss/twitch-api/tree/master/docs/webhooks.md)
12. [Auth](https://github.com/sevenpluss/twitch-api/tree/master/docs/auth.md)
13. [Paginator](https://github.com/sevenpluss/twitch-api/tree/master/docs/paginator.md)
