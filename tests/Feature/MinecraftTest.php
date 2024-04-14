<?php

namespace Tests\Feature;

use Tests\TestCase;

class MinecraftTest extends TestCase {

    public function testMinecraftUsernameEndpointReturnsCorrectJson() {
        $response = $this->get( '/lookup?type=minecraft&username=Notch' );

        $response->assertStatus( 200 )
        ->assertJson( json_decode( '{"username":"Notch","id":"069a79f444e94726a5befca90e38aaf5","avatar":"https:\/\/crafatar.com\/avatars/069a79f444e94726a5befca90e38aaf5"}', true ) );
    }

    public function testMinecraftIdEndpointReturnsCorrectJson() {
        $response = $this->get( '/lookup?type=minecraft&id=d8d5a9237b2043d8883b1150148d6955' );

        $response->assertStatus( 200 )
        ->assertJson( json_decode( '{"username":"Test","id":"d8d5a9237b2043d8883b1150148d6955","avatar":"https:\/\/crafatar.com\/avatars/d8d5a9237b2043d8883b1150148d6955"}', true ) );
    }

    public function testMinecraftUsernameEndpointFailsOnIncorrectUsername() {
        $response = $this->get( '/lookup?type=minecraft&username=SurelyDoesntExist' );

        $response->assertStatus( 404 )
        ->assertJson( json_decode( '{"path": "/users/profiles/minecraft/SurelyDoesntExist","errorMessage": "Couldn\'t find any profile with name SurelyDoesntExist","status": 404}', true ) );
    }
}
