<?php declare( strict_types = 1 );

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

/**
* Class LookupController
*
* @package App\Http\Controllers
*/

class LookupController extends Controller {
    public function lookup( Request $request ) {
        $services = config( 'serviceProviders' );

        if ( !array_key_exists( $request->get( 'type' ), $services ) ) {
            return response()->json( 'Service not found', 400 );
        }

        $serviceClass = $services[ $request->get( 'type' ) ];

        $service = new $serviceClass();

        $type = $request->get( 'id' ) ? 'id' : 'username';
        $value = $request->get( 'id' ) ?? $request->get( 'username' );

        $response = $service->makeRequest( $type, $value );

        return response()->json( $response );
    }
}
