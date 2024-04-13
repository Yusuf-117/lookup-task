<?php

namespace App\Services;

class MinecraftService extends Service{

    public function __construct(){
        parent::__construct([
            // username not supported for steam
            'id' => "https://ident.tebex.io/usernameservices/4/username/%s"
        ]);
    }

}
