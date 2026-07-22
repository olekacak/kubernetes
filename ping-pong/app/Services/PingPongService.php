<?php

namespace App\Services;

class PingPongService
{
    private string $path = '/tmp/pings.txt';

    public function ping(): string
    {
        $count = $this->count() + 1;

        file_put_contents($this->path, $count);

        return "pong {$count}";
    }

    public function count(): int
    {
        return file_exists($this->path)
            ? (int) file_get_contents($this->path)
            : 0;
    }
}