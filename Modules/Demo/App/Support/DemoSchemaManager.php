<?php

declare(strict_types=1);

namespace Modules\Demo\App\Support;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\Demo\App\Models\DemoInstance;
use Modules\Site\App\Settings\GeneralSettings;
use Modules\User\App\Models\User;
use Spatie\Permission\PermissionRegistrar;
use Throwable;

final class DemoSchemaManager
{
    private readonly string $defaultConnection;

    private readonly string $baseCachePrefix;

    private readonly string $basePermissionCacheKey;

    public function __construct(private readonly Application $app)
    {
        $this->defaultConnection = (string) config('database.default', 'pgsql');
        $this->baseCachePrefix = (string) config('cache.prefix', '');
        $this->basePermissionCacheKey = (string) config('permission.cache.key', 'spatie.permission.cache');
    }

    public function enabled(): bool
    {
        return (bool) config('demo.enabled');
    }

    public function prepare(?string $uuid = null): DemoInstance
    {
        $this->ensureEnabled();
        $this->cleanupExpired();

        $uuid = $this->normalizeUuid($uuid);

        if ($uuid) {
            $instance = $this->findActiveInstance($uuid);

            if ($instance) {
                return $this->reuse($instance);
            }
        }

        return $this->createFresh($uuid ?? (string) str()->uuid());
    }

    public function findActiveInstance(?string $uuid): ?DemoInstance
    {
        $uuid = $this->normalizeUuid($uuid);

        if (! $uuid) {
            return null;
        }

        return DemoInstance::findActive($uuid);
    }

    public function activateDemo(DemoInstance $instance): void
    {
        $this->activateSchema($instance->schema_name, $instance->uuid);
        $this->ensureLoginUserExists();
    }

    public function activatePublic(): void
    {
        if (! $this->enabled()) {
            return;
        }

        $this->activateSchema((string) config('demo.public_schema', 'public'));
    }

    public function cleanupExpired(): int
    {
        if (! $this->enabled()) {
            return 0;
        }

        $count = 0;
        foreach (DemoInstance::expired() as $instance) {
            DemoInstance::dropSchema($instance->schema_name);
            $instance->delete();
            $count++;
        }

        return $count;
    }

    public function resolveLoginUser(): User
    {
        return User::demoLoginUser();
    }

    public function clearDemoArtifacts(?string $uuid): void
    {
        $uuid = $this->normalizeUuid($uuid);

        if (! $uuid) {
            return;
        }

        $instance = DemoInstance::findByUuid($uuid);

        if ($instance) {
            DemoInstance::dropSchema($instance->schema_name);
            $instance->delete();

            return;
        }

        DemoInstance::dropSchema($this->schemaNameFor($uuid));
    }

    private function reuse(DemoInstance $instance): DemoInstance
    {
        $instance->extendExpiry();

        $this->activateDemo($instance);

        return $instance;
    }

    private function createFresh(string $uuid): DemoInstance
    {
        $this->ensureProvisioningCapacity();

        $schema = $this->schemaNameFor($uuid);

        try {
            DemoInstance::createSchema($schema);
            $this->activateSchema($schema, $uuid);
            $this->runProvisioningCommands();
            $this->ensureLoginUserExists();

            return DemoInstance::prepare($uuid, $schema);
        } catch (Throwable $exception) {
            DemoInstance::dropSchema($schema);
            DemoInstance::findByUuid($uuid)?->delete();
            $this->activatePublic();

            throw $exception;
        }
    }

    private function runProvisioningCommands(): void
    {
        config(['demo.provisioning' => true]);

        try {
            Artisan::call('migrate', [
                '--database' => $this->defaultConnection,
                '--force' => true,
            ]);

            Artisan::call('db:seed', [
                '--class' => DatabaseSeeder::class,
                '--database' => $this->defaultConnection,
                '--force' => true,
            ]);
        } finally {
            config(['demo.provisioning' => false]);
        }
    }

    private function ensureEnabled(): void
    {
        if (! $this->enabled()) {
            throw new \RuntimeException('Demo mode is disabled.');
        }
    }

    private function ensureProvisioningCapacity(): void
    {
        $maxInstances = max(1, (int) config('demo.max_concurrent_instances', 25));
        $activeInstances = DemoInstance::activeCount();

        if ($activeInstances >= $maxInstances) {
            throw new \RuntimeException('Demo capacity is full. Please try again in a few minutes.');
        }
    }

    private function activateSchema(string $schema, ?string $uuid = null): void
    {
        config([
            "database.connections.{$this->defaultConnection}.search_path" => $schema,
            'cache.prefix' => $uuid
                ? $this->baseCachePrefix.'demo-'.$uuid.'-'
                : $this->baseCachePrefix,
            'permission.cache.key' => $uuid
                ? $this->basePermissionCacheKey.'.'.$uuid
                : $this->basePermissionCacheKey,
        ]);

        DB::purge($this->defaultConnection);
        DB::reconnect($this->defaultConnection);

        if ($this->app->resolved(GeneralSettings::class)) {
            $this->app->forgetInstance(GeneralSettings::class);
        }

        if ($this->app->resolved('cache') && method_exists($this->app['cache'], 'forgetDriver')) {
            $this->app['cache']->forgetDriver(config('cache.default'));
        }

        if ($this->app->resolved(PermissionRegistrar::class)) {
            $permissionRegistrar = $this->app->make(PermissionRegistrar::class);
            $permissionRegistrar->initializeCache();
            $permissionRegistrar->clearPermissionsCollection();
        }
    }

    private function ensureLoginUserExists(): void
    {
        $this->resolveLoginUser();
    }

    private function normalizeUuid(?string $uuid): ?string
    {
        $uuid = trim((string) $uuid);

        if ($uuid === '' || ! preg_match('/^[a-f0-9-]{36}$/i', $uuid)) {
            return null;
        }

        return strtolower($uuid);
    }

    private function schemaNameFor(string $uuid): string
    {
        $prefix = strtolower((string) config('demo.schema_prefix', 'demo_'));
        $prefix = preg_replace('/[^a-z0-9_]+/', '_', $prefix) ?? 'demo_';
        $prefix = trim($prefix, '_');
        $prefix = $prefix !== '' ? $prefix.'_' : 'demo_';
        $suffix = str_replace('-', '', strtolower($uuid));

        return substr($prefix.$suffix, 0, 63);
    }
}
