<?php

namespace App\Services;

class SteamService extends Service {

    public function __construct() {
        parent::__construct( [
            // username not supported for steam
            'id' => 'https://ident.tebex.io/usernameservices/4/username/%s'
        ] );
    }

    protected function transformResponse( $response ) {
        return [
            'username' => $response->username,
            'id' => $response->id,
            'avatar' => $response->meta->avatar
        ];
    }

}
