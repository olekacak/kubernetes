<?php

namespace App\Services;

use PDO;
use PDOException;

class PingPongService
{
    private PDO $pdo;

    public function __construct()
    {
        $host = getenv('POSTGRES_HOST') ?: 'postgres-svc';
        $db   = getenv('POSTGRES_DB')   ?: 'pingpong';
        $user = getenv('POSTGRES_USER') ?: 'postgres';
        $pass = getenv('POSTGRES_PASSWORD') ?: '';

        $this->pdo = new PDO("pgsql:host={$host};dbname={$db}", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS pings (id SERIAL PRIMARY KEY, count INTEGER NOT NULL DEFAULT 0)");

        $row = $this->pdo->query("SELECT COUNT(*) FROM pings")->fetchColumn();
        if ((int) $row === 0) {
            $this->pdo->exec("INSERT INTO pings (count) VALUES (0)");
        }
    }

    public function ping(): string
    {
        $this->pdo->exec("UPDATE pings SET count = count + 1");
        return "pong " . $this->count();
    }

    public function count(): int
    {
        return (int) $this->pdo->query("SELECT count FROM pings LIMIT 1")->fetchColumn();
    }
}
