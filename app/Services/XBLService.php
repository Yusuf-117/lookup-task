<?php

namespace App\Services;

class MinecraftService extends Service{

    public function __construct(){
        parent::__construct([
            'username' => "https://ident.tebex.io/usernameservices/3/username/%s?type=username",
            'id' => "https://ident.tebex.io/usernameservices/3/username/%s"
        ]);
    }

}
