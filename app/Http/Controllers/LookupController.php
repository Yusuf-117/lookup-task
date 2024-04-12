<?php declare(strict_types=1);

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

/**
 * Class LookupController
 *
 * @package App\Http\Controllers
 */
class LookupController extends Controller
{
    public function lookup(Request $request) {
        // Plan:
        // Requestable Interface > Service Class > three subclasses: minecraft, steam and xlb

        /*
         Service class has construct for getting the correct url based on username or id (just an assoc array ok "username"=>url and "id"=>url).
         It also has the layout code for the makeRequest() method which does the guzzle request stuff

         url arrays:

         minecraft:
         [
            'username' => "https://api.mojang.com/users/profiles/minecraft/{$username}",
            'id' = "https://sessionserver.mojang.com/session/minecraft/profile/{$userId}"
         ]

         steam:
         [
            'username' => 'UNSUPPORTED - figure this out later',
            'id' = "https://ident.tebex.io/usernameservices/4/username/{$id}"
         ]

         xbl:
         [
            'username' => "https://ident.tebex.io/usernameservices/3/username/" . $request->get("username") . "?type=username"'",
            'id' = "https://sessionserver.mojang.com/session/minecraft/profile/{$userId}"
         ]

         $id = $request->get("id");
         $guzzle = new Client();
         $url = "https://ident.tebex.io/usernameservices/4/username/{$id}";
         $match = json_decode($guzzle->get($url)->getBody()->getContents());
        */
    }
}
