<?php

header('Content-Type: application/json');

$host   = getenv('POSTGRES_HOST')     ?: 'postgres-svc';
$db     = getenv('POSTGRES_DB')       ?: 'todos';
$user   = getenv('POSTGRES_USER')     ?: 'postgres';
$pass   = getenv('POSTGRES_PASSWORD') ?: '';

try {
    $pdo = new PDO("pgsql:host={$host};dbname={$db}", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $pdo->exec("CREATE TABLE IF NOT EXISTS todos (id SERIAL PRIMARY KEY, content TEXT NOT NULL)");
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connection failed: ' . $e->getMessage()]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($method === 'GET' && $path === '/todos') {
    $rows = $pdo->query("SELECT content FROM todos ORDER BY id")->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($rows);

} elseif ($method === 'POST' && $path === '/todos') {
    $body    = json_decode(file_get_contents('php://input'), true) ?? [];
    $content = trim($body['content'] ?? '');

    if ($content === '' || mb_strlen($content) > 140) {
        error_log(sprintf("REJECTED todo (length=%d): %s", mb_strlen($content), $content));
        http_response_code(400);
        echo json_encode(['error' => 'Content must be 1-140 characters']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO todos (content) VALUES (?)");
    $stmt->execute([$content]);

    error_log(sprintf("CREATED todo (length=%d): %s", mb_strlen($content), $content));

    http_response_code(201);
    echo json_encode(['status' => 'created', 'todo' => $content]);

} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not found']);
}
