<?php

namespace App\Services;

class PingPongService
{
    private static int $counter = 0;

    public function ping(): string
    {
        return "pong " . self::$counter++;
    }
}