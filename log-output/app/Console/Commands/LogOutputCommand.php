<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('log:output')]
#[Description('Generate a UUID once and write it with a timestamp to /shared/output.txt every 5 seconds')]
class LogOutputCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $uuid = Str::uuid()->toString();
        $path = '/shared/output.txt';

        while (true) {
            $line = now()->utc()->format('Y-m-d\TH:i:s.v\Z') . ': ' . $uuid;

            file_put_contents($path, $line);

            $this->info($line);

            sleep(5);
        }
    }
}
