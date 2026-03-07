<?php

namespace Modules\Demo\App\Console;

use Illuminate\Console\Command;
use Modules\Demo\App\Support\DemoSchemaManager;
use Throwable;

class PrepareDemoCommand extends Command
{
    protected $signature = 'demo:prepare {uuid?}';

    protected $description = 'Prepare or refresh a temporary demo schema';

    public function handle(DemoSchemaManager $demoSchemaManager): int
    {
        try {
            $instance = $demoSchemaManager->prepare($this->argument('uuid'));

            $this->info('Demo prepared.');
            $this->line('UUID: '.$instance->uuid);
            $this->line('Schema: '.$instance->schema_name);
            $this->line('Expires: '.$instance->expires_at?->toDateTimeString());

            return self::SUCCESS;
        } catch (Throwable $exception) {
            report($exception);
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }
}
