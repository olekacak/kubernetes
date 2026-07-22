<?php

namespace App\Services;

use Illuminate\Support\Str;

class LogOutputService
{
    private string $random;

    public function __construct()
    {
        $this->random = Str::uuid()->toString();
    }

    public function status(): array
    {
        return [
            'timestamp' => now()
                ->utc()
                ->format('Y-m-d\TH:i:s.v\Z'),
            'random' => $this->random,
        ];
    }
}