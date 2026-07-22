<?php

use Illuminate\Support\Facades\Route;
use App\Services\LogOutputService;

Route::get('/', function (LogOutputService $service) {
    return response($service->status(), 200)
        ->header('Content-Type', 'text/plain');
});