<?php

namespace Modules\Demo\App\Console;

use Illuminate\Console\Command;
use Modules\Demo\App\Support\DemoSchemaManager;
use Throwable;

class CleanupDemoCommand extends Command
{
    protected $signature = 'demo:cleanup';

    protected $description = 'Delete expired temporary demo schemas';

    public function handle(DemoSchemaManager $demoSchemaManager): int
    {
        try {
            $deletedCount = $demoSchemaManager->cleanupExpired();
            $this->info("Expired demos removed: {$deletedCount}");

            return self::SUCCESS;
        } catch (Throwable $exception) {
            report($exception);
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }
}
