<?php

namespace App\Services;

class MinecraftService extends Service {

    public function __construct() {
        parent::__construct( [
            'username' => 'https://api.mojang.com/users/profiles/minecraft/%s',
            'id' => 'https://sessionserver.mojang.com/session/minecraft/profile/%s'
        ] );
    }

    protected function transformResponse( $response ) {
        return [
            'username' => $response->name,
            'id' => $response->id,
            'avatar' => 'https://crafatar.com/avatars/' . $response->id
        ];
    }

}
