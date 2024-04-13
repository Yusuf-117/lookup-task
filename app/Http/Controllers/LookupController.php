<?php declare(strict_types=1);

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\XBLService;
use App\Services\SteamService;
use App\Services\MinecraftService;

/**
 * Class LookupController
 *
 * @package App\Http\Controllers
 */
class LookupController extends Controller
{
    public function lookup(Request $request) {
        $services = [
            'minecraft' => MinecraftService::class,
            'steam' => SteamService::class,
            'xbl' => XBLService::class,
        ];

        $serviceClass = $services[$request->get('type')];

        if(!class_exists($serviceClass)){
            return response()->json("Service not found", 400);
        }

        $service = new $serviceClass();

        $type = $request->get('id') ? "id" : "username";
        $value = $request->get('id') ?? $request->get('username');

        $response = $service->makeRequest($type, $value);

        return response()->json($response);
    }
}
