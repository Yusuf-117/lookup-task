<?php declare( strict_types = 1 );

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

/**
* Class LookupController
*
* @package App\Http\Controllers
*/

class LookupController extends Controller {
    /**
    * lookup() - gets user details based on inputs provided for type and username or id
    *
    * @param Request $request - requires: type, id and/or username
    *
    * @return json object - username, id and avatar
    */

    public function lookup( Request $request ) {
        $validator = Validator::make( $request->all(), [
            'type' => 'required|string',
            'id' => 'required_without:username|string',
            'username' => 'required_without:id|string',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 400 );
        }

        $services = config( 'serviceProviders' );

        if ( !array_key_exists( $request->get( 'type' ), $services ) ) {
            return response()->json( 'Service not found', 400 );
        }

        $serviceClass = $services[ $request->get( 'type' ) ];
        $service = new $serviceClass();

        $userProp = $request->filled( 'id' ) ? 'id' : 'username';
        $value = $request->input( $userProp );
        $serviceType = $request->get( 'type' );

        $cacheKey = "${serviceType}_{$userProp}_{$value}";

        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            return response()->json($cachedData);
        }

        $response = $service->getUserDetails( $userProp, $value );

        $status = $response["status"] ?? $response["code"] ?? 200;

        if($status == 200){
            Cache::put($cacheKey, $response, now()->addMinutes(60));
        }
        return response()->json( $response, $status );
    }
}
