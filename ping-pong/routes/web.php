<?php

use Illuminate\Support\Facades\Route;
use App\Services\PingPongService;

Route::get('/pingpong', function (PingPongService $service) {
    return $service->ping();
});