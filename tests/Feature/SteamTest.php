<?php

namespace Tests\Feature;

use Tests\TestCase;

class SteamTest extends TestCase {

    public function testSteamUsernameEndpointReturnsErrorMessage() {
        $response = $this->get( '/lookup?type=steam&username=test ' );
        $response->assertStatus( 400 )
        ->assertJson( json_decode( '{"errorMessage": "Steam only supports IDs","status": 400}', true ) );
    }

    public function testSteamIdEndpointReturnsCorrectJson() {
        $response = $this->get( '/lookup?type=steam&id=76561198806141009' );

        $response->assertStatus( 200 )
        ->assertJson( json_decode( '{"username":"Tebex","id":"76561198806141009","avatar":"https:\/\/avatars.steamstatic.com\/c86f94b0515600e8f6ff869d13394e05cfa0cd6a.jpg"}', true ) );
    }
}
