<?php

namespace App\Services;

class LogOutputService
{
    private string $outputPath  = '/shared/output.txt';
    private string $pingPongUrl = 'http://ping-pong-svc/pings';

    public function status(): string
    {
        $output = file_exists($this->outputPath)
            ? file_get_contents($this->outputPath)
            : 'Waiting for log output...';

        $pings = @file_get_contents($this->pingPongUrl);
        $pings = ($pings !== false) ? (int) $pings : 0;

        return $output . "\nPing / Pongs: {$pings}";
    }
}