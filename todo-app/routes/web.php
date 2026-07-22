<?php

use Illuminate\Support\Facades\Route;
use App\Services\ImageService;

define('TODO_BACKEND', 'http://todo-backend-svc/todos');

Route::get('/', function (ImageService $service) {
    $service->imagePath();

    $response = @file_get_contents(TODO_BACKEND);
    $todos    = $response !== false ? json_decode($response, true) : [];

    return view('welcome', ['todos' => $todos]);
});

Route::post('/todos', function () {
    $content = request('todo', '');

    if ($content !== '') {
        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode(['content' => $content]),
            ],
        ]);
        @file_get_contents(TODO_BACKEND, false, $context);
    }

    return redirect('/');
});

Route::get('/image', function (ImageService $service) {
    $path = $service->imagePath();

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, ['Content-Type' => 'image/jpeg']);
});