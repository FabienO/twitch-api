# Paginator

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Example Usage

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));

$user = $twitch->users()->getUserByName('esl_csgo');

$video_all = $twitch->videos()->getVideosByUserId($user->shift()['id'], ['first'=> 10]);

// page one
$video_one = $twitch->videos()->getVideosByUserId($user->shift()['id'], ['first'=> 5]);

// page two
// FROM PAGINATOR
$video_two = $twitch->videos()->getVideosByUserId($user->shift()['id'], ['first'=> 5], $video_one->paginator()->next());

// OR FROM OPTIONS
$video_two = $twitch->videos()->getVideosByUserId($user->shift()['id'], ['first'=> 5, 'after'=> $video_one->paginator()->cursor()]);

var_dump($video_all, $video_one, $video_two);
``` 
