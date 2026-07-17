<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('log:output')]
#[Description('Generate a UUID once and print it every 5 seconds')]
class LogOutputCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $uuid = Str::uuid()->toString();

        while (true) {
            
            $this->info(
                now()
                    ->utc()
                    ->format('Y-m-d\TH:i:s.v\Z')
                . ': ' .
                $uuid
            );

            sleep(5);
        }
    }
}
