<?php

namespace App\Services;

class LogOutputService
{
    private string $outputPath = '/shared/output.txt';
    private string $pingsPath  = '/shared/pings.txt';

    public function status(): string
    {
        $output = file_exists($this->outputPath)
            ? file_get_contents($this->outputPath)
            : 'Waiting for log output...';

        $pings = file_exists($this->pingsPath)
            ? (int) file_get_contents($this->pingsPath)
            : 0;

        return $output . "\nPing / Pongs: {$pings}";
    }
}