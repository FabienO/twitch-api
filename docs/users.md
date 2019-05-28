# Users

User objects

[Twitch API](https://github.com/sevenpluss/twitch-api#documentation)

## Methods

```php
<?php

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

$twitch = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));



// require one from two properties id or login, max amount values 100
$options = [
    'login' => 'esl_csgo',
];

// User objects
$twitch->users()->getUsers($options);

$user_id = '31239503';

// Get the user by id
$twitch->users()->getUserById($user_id);

$ids = [
    '31239503',
    '257788195',
];

// Get the users by ids
$twitch->users()->getUsersByIds($ids);

$username = 'esl_csgo';
// Get the user by Twitch username
$twitch->users()->getUserByName($username);

$usernames = [
    'esl_csgo',
    'dota2ruhub'
];

// Get the users by Twitch usernames
$twitch->users()->getUsersByNames($usernames);

// Update the user description
$twitch->users()->updateUser('new user description');

// User Follows
$twitch->users()->getFollows($user_id);
$twitch->users()->getFollowsFrom($user_id);


// User Extensions
$extension = 'xxxxxxx';

$twitch->users()->getAuthUserExtensions();
$twitch->users()->getAuthUserActiveExtensions();
$twitch->users()->disableAllExtensions();
$twitch->users()->disableUserExtensionById($extension);
$twitch->users()->disableUserExtensionByName($extension);
$twitch->users()->updateUserExtensions();

```

## Example Usage

```php
<?php

namespace App\Http\Controllers;

use Sevenpluss\TwitchApi\Services\TwitchApi;
use Sevenpluss\TwitchApi\Services\ClientSettings;

class UserController
{
   protected $api;
    
    public function __construct() 
    {
        $this->api = new TwitchApi(new ClientSettings('client_id', 'client_secret', 'redirect_url'));
    }
    
    public function index()
    {
        $usernames = [
            'esl_csgo',
            'dota2ruhub'
        ];
            
        $users = $this->api->users()->getUsersByNames($usernames)->data();
    
        return compact('users');
    }
    
    public function show()
    {
        $user = $this->api->users()->getUserByName('esl_csgo')->data();
        
        return compact('user');
    }
}
```
