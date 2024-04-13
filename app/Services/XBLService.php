<?php

namespace App\Services;

class XBLService extends Service{

    public function __construct(){
        parent::__construct([
            'username' => "https://ident.tebex.io/usernameservices/3/username/%s?type=username",
            'id' => "https://ident.tebex.io/usernameservices/3/username/%s"
        ]);
    }

    protected function transformResponse( $response ) {
        return [
            'username' => $response->username,
            'id' => $response->id,
            'avatar' => $response->meta->avatar
        ];
    }

}
