<?php

use Illuminate\Support\Facades\Route;
use App\Services\ImageService;

Route::get('/', function (ImageService $service) {
    $service->imagePath(); // ensure image is cached
    return view('welcome');
});

Route::get('/image', function (ImageService $service) {
    $path = $service->imagePath();

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, ['Content-Type' => 'image/jpeg']);
});