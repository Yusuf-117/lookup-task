<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class Service {
    protected $baseUrls;

    public function __construct( $baseUrls ) {
        $this->baseUrls = $baseUrls;
    }

    /**
    * Make a request based on user props
    *
    * @param string $type - 'username' or 'id'
    * @param string $value - the value or username or id
    *
    * @return array The user details
    */

    public function makeRequest( $type, $value ) {
        $baseUrl = $this->baseUrls[ $type ] ?? null;

        if ( !$baseUrl || !$value ) {
            throw new Exception( 'Incorrect User property or value' );
        }

        $guzzle = new Client();
        $url = sprintf( $baseUrl, $value );
        $match = json_decode( $guzzle->get( $url )->getBody()->getContents() );

        return $this->transformResponse($match);
    }
}
