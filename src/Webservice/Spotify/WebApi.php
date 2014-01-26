<?php
namespace Webservice\Spotify;

use Zend\Http\Client;
use Zend\Http\Headers;
use Zend\Json\Json;

class WebApi {
    protected $source = "http://ws.spotify.com";

    private $apiVersion = 1;

    private function createURI($service, $method, $format = "json") {
        //http://ws.spotify.com/service/version/method[.format]?parameters
        return sprintf("%s/%s/%s/%s.%s", $this->source, $service, $this->apiVersion, $method, $format);
    }

    private function validate($service, $method, $format) {

        if(!($service == 'search' || $service == 'lookout' ))
            throw new \Exception("$service is not an acceptable service!");

        if(!($format == 'json' || $format == 'xml' ))
            throw new \Exception("$format is not an acceptable format!");
    }

    public function get($service, $method, $format = "json", $parameters = array() ) {

        $this->validate($service, $method, $format);

        $http = new Client();
        $http->setUri($this->createURI($service, $method, $format));
        $http->setOptions(array('sslverifypeer' => false));
        $http->setMethod('GET');

        $http->setParameterGet($parameters);

        $response = $http->send();

        if($format == 'json' )
            $result = Json::decode($response->getBody());
        else
            $result = simplexml_load_string($response->getBody());

        return $result;
    }
}
?>
