<?php

namespace App\Services;

class LogOutputService
{
    private string $outputPath  = '/shared/output.txt';
    private string $configFile  = '/config/information.txt';
    private string $pingPongUrl = 'http://ping-pong-svc/pings';

    public function status(): string
    {
        $fileContent = file_exists($this->configFile)
            ? trim(file_get_contents($this->configFile))
            : 'N/A';

        $message = getenv('MESSAGE') ?: 'N/A';

        $output = file_exists($this->outputPath)
            ? file_get_contents($this->outputPath)
            : 'Waiting for log output...';

        $pings = @file_get_contents($this->pingPongUrl);
        $pings = ($pings !== false) ? (int) $pings : 0;

        return "file content: {$fileContent}\n"
            . "env variable: MESSAGE={$message}\n"
            . $output . "\n"
            . "Ping / Pongs: {$pings}";
    }
}