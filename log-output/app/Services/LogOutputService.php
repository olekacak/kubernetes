<?php

namespace App\Services;

class LogOutputService
{
    private string $path = '/shared/output.txt';

    public function status(): string
    {
        if (!file_exists($this->path)) {
            return 'Waiting for log output...';
        }

        return file_get_contents($this->path);
    }
}