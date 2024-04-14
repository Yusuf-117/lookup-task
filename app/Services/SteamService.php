<?php

namespace App\Services;

class SteamService extends Service {

    public function __construct() {
        parent::__construct( [
            'username' => 'Steam only supports IDs',
            'id' => 'https://ident.tebex.io/usernameservices/4/username/%s'
        ] );
    }

    protected function transformResponse( $response ) {
        return isset( $response->username, $response->id, $response->meta->avatar ) ? [
            'username' => $response->username,
            'id' => $response->id,
            'avatar' => $response->meta->avatar
        ] : get_object_vars($response->error);

    }

}
