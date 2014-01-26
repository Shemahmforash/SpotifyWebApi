SpotifyWebApi
=============

Abstraction of the spotify web-abi (aka metadata api) - https://developer.spotify.com/technologies/web-api/

## Installation
This project is in Composer format, so you just need to run `php composer.phar install`, and all dependencies will be installed:

##Example
It is very simple to use this class. You just need to include the autoload, instantiate the class and call its public method `get`.
```php
require 'vendor/autoload.php';
$api = new Webservice\Spotify\WebApi();
$results = $api->get('search', 'artist', 'json', array("q" => "Queen"));
```
