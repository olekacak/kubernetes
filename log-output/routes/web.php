<?php

use Illuminate\Support\Facades\Route;
use App\Services\LogOutputService;

Route::get('/', function (LogOutputService $service) {
    return response()->json(
        $service->status()
    );
});