# Streams

Twitch streams

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

`$options` is an optional parameter

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));


// get list of the streams for any channels
$options = [
    'first' => 10
];

// get list of the streams for esl_csgo channel by twitch username
$options = [
    'user_login' => 'esl_csgo',
    'first' => 10
];

// get list of the streams by twitch user id
$options = [
    'user_id' => '31239503',
    'first' => 10
];

// get list of the streams
$twitch->streams()->getStreams($options);


// get list of the streams by twitch user id
$options = [
    'first' => 10
];

$user_id = '31239503';

$twitch->streams()->getStreamsByUserId($user_id, $options);

// get list of the streams for esl_csgo channel by twitch username
$twitch->streams()->getStreamsByUserName('esl_csgo', $options);

$user_ids = [
    '31239503',
    '257788195'
];

// get list of the streams by twitch user ids
$twitch->streams()->getStreamsByUserIds($user_ids, $options);

$usernames = [
   'esl_csgo',
   'dota2ruhub'
];

// get list of the streams by twitch usernames
$twitch->streams()->getStreamsByUserNames($usernames, $options);

$twitch->streams()->getStreamsByGameId('493057');

$game_ids = [
    '493057',
    '113057'
];

$twitch->streams()->getStreamsByGameIds($game_ids);

// stream metadata
$twitch->streams()->getStreamsMetadata();

$user_id = '31239503';

// stream markers
$twitch->streams()->createStreamMarker($user_id);
$twitch->streams()->getStreamMarker([
    'user_id'=> $user_id
]);
```
