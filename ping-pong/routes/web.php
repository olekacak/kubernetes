<?php

use Illuminate\Support\Facades\Route;
use App\Services\PingPongService;

Route::get('/', function (PingPongService $service) {
    return $service->ping();
});

Route::get('/pingpong', function (PingPongService $service) {
    return $service->ping();
});

Route::get('/pings', function (PingPongService $service) {
    return response($service->count(), 200)
        ->header('Content-Type', 'text/plain');
});