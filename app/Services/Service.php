<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Contracts\UserDetailsInterface;

abstract class Service implements UserDetailsInterface {
    protected $endpoints;

    public function __construct( $endpoints ) {
        $this->endpoints = $endpoints;
    }

    public function getUserDetails( $type, $value ) {
        $target = $this->endpoints[ $type ] ?? null;

        if ( !$target || !$value ) {
            return [
                "errorMessage" => 'Incorrect User property or value',
                "status" => 400
            ];
        }

        //If $target is not a NULL or a URL then it's an error string set in the subclass
        if ( !filter_var( $target, FILTER_VALIDATE_URL ) ) {
            return [
                "errorMessage" => $target,
                "status" => 400
            ];
        }

        try {
            $guzzle = new Client();
            $url = sprintf( $target, $value );
            $match = json_decode( $guzzle->get( $url )->getBody()->getContents() );

            return $this->transformResponse( $match );
        } catch( \Exception $e ) {
            if ( $e->hasResponse() ) {
                $body = json_decode( $e->getResponse()->getBody()->getContents() );
                $body->status = $e->getResponse()->getStatusCode();
                return json_decode(json_encode($body),true);
            }
        }
    }

    abstract protected function transformResponse( $response );
}
