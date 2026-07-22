<?php

header('Content-Type: application/json');

$file   = '/tmp/todos.json';
$todos  = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$method = $_SERVER['REQUEST_METHOD'];
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($method === 'GET' && $path === '/todos') {
    echo json_encode($todos);

} elseif ($method === 'POST' && $path === '/todos') {
    $body    = json_decode(file_get_contents('php://input'), true) ?? [];
    $content = trim($body['content'] ?? '');

    if ($content === '' || mb_strlen($content) > 140) {
        http_response_code(400);
        echo json_encode(['error' => 'Content must be 1-140 characters']);
        exit;
    }

    $todos[] = $content;
    file_put_contents($file, json_encode($todos));

    http_response_code(201);
    echo json_encode(['status' => 'created', 'todo' => $content]);

} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not found']);
}
