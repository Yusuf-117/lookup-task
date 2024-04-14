<?php

namespace Tests\Feature;

use Tests\TestCase;

class XBLTest extends TestCase {

    public function testXblUsernameEndpointReturnsCorrectJson() {
        $response = $this->get( '/lookup?type=xbl&username=tebex' );

        $response->assertStatus( 200 )
        ->assertJson( json_decode( '{"username":"Tebex","id":"2533274844413377","avatar":"https:\/\/avatar-ssl.xboxlive.com\/avatar\/2533274844413377\/avatarpic-l.png"}', true ) );
    }

    public function testXblIdEndpointReturnsCorrectJson() {
        $response = $this->get( '/lookup?type=xbl&id=2533274884045330' );

        $response->assertStatus( 200 )
        ->assertJson( json_decode( '{"username":"d34dmanwalkin","id":"2533274884045330","avatar":"https:\/\/avatar-ssl.xboxlive.com\/avatar\/2533274884045330\/avatarpic-l.png"}', true ) );
    }
}
