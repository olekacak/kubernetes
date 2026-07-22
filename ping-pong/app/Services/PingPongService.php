<?php

namespace App\Services;

class PingPongService
{
    private string $path = '/shared/pings.txt';

    public function ping(): string
    {
        $count = file_exists($this->path)
            ? (int) file_get_contents($this->path)
            : 0;

        $count++;

        file_put_contents($this->path, $count);

        return "pong {$count}";
    }
}