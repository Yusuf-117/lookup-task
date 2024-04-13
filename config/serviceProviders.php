<?php

use App\Services\XBLService;
use App\Services\SteamService;
use App\Services\MinecraftService;

return [
    'minecraft' => MinecraftService::class,
    'steam' => SteamService::class,
    'xbl' => XBLService::class,
];
