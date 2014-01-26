<?php

namespace Webservice\Spotify;

use Zend\Http\Client;
use Zend\Http\Headers;
use Zend\Json\Json;

class WebApi {
    protected $source = "http://ws.spotify.com/";

    private $apiVersion = 1;

    private function createURI($service, $method, $format = "json") {
        //http://ws.spotify.com/service/version/method[.format]?parameters
        return sprintf("%s/%s/%s/%s.%s", $this->source, $service, $this->apiVersion, $method, $format);
    }

    public function get($service, $format = "json", $method, $parameters = array() ) {
        $http = new Client();
        $http->setUri($this->createURI($service, $method, $format));
        $http->setOptions(array('sslverifypeer' => false));
        $http->setMethod('GET');

        $http->setParameterGet($parameters);

        $response = $http->send();
        return Json::decode($response->getBody());
    }

}

?>
