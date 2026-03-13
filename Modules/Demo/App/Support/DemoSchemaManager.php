<?php

namespace Modules\Demo\App\Support;

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

    private readonly string $publicConnection;

    private readonly string $baseCachePrefix;

    private readonly string $basePermissionCacheKey;

    public function __construct(private readonly Application $app)
    {
        $this->defaultConnection = (string) config('database.default', 'pgsql');
        $this->publicConnection = 'pgsql_public';
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

        return DemoInstance::query()->activeUuid($uuid)->first();
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

        $expired = DemoInstance::query()
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($expired as $instance) {
            $this->dropSchema($instance->schema_name);
            $instance->delete();
        }

        return $expired->count();
    }

    public function resolveLoginUser(): User
    {
        $user = User::query()
            ->where('email', (string) config('demo.login_email', 'a@a.com'))
            ->first();

        if (! $user) {
            throw new \RuntimeException('The seeded demo login user could not be found.');
        }

        return $user;
    }

    public function clearDemoArtifacts(?string $uuid): void
    {
        $uuid = $this->normalizeUuid($uuid);

        if (! $uuid) {
            return;
        }

        $instance = DemoInstance::query()->where('uuid', $uuid)->first();

        if ($instance) {
            $this->dropSchema($instance->schema_name);
            $instance->delete();

            return;
        }

        $this->dropSchema($this->schemaNameFor($uuid));
    }

    private function reuse(DemoInstance $instance): DemoInstance
    {
        $instance->forceFill([
            'expires_at' => now()->addMinutes((int) config('demo.ttl_minutes', 360)),
        ])->save();

        $this->activateDemo($instance);

        return $instance->fresh() ?? $instance;
    }

    private function createFresh(string $uuid): DemoInstance
    {
        $schema = $this->schemaNameFor($uuid);

        try {
            $this->createSchema($schema);
            $this->activateSchema($schema, $uuid);
            $this->runProvisioningCommands();
            $this->ensureLoginUserExists();

            return DemoInstance::query()->updateOrCreate(
                ['uuid' => $uuid],
                [
                    'schema_name' => $schema,
                    'prepared_at' => now(),
                    'expires_at' => now()->addMinutes((int) config('demo.ttl_minutes', 360)),
                ],
            );
        } catch (Throwable $exception) {
            $this->dropSchema($schema);
            DemoInstance::query()->where('uuid', $uuid)->delete();
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
                '--class' => \Database\Seeders\DatabaseSeeder::class,
                '--database' => $this->defaultConnection,
                '--force' => true,
            ]);
        } finally {
            config(['demo.provisioning' => false]);
        }
    }

    private function createSchema(string $schema): void
    {
        DB::connection($this->publicConnection)->statement(
            sprintf('CREATE SCHEMA IF NOT EXISTS %s', $this->quoteIdentifier($schema))
        );
    }

    private function dropSchema(string $schema): void
    {
        DB::connection($this->publicConnection)->statement(
            sprintf('DROP SCHEMA IF EXISTS %s CASCADE', $this->quoteIdentifier($schema))
        );
    }

    private function ensureEnabled(): void
    {
        if (! $this->enabled()) {
            throw new \RuntimeException('Demo mode is disabled.');
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

    private function quoteIdentifier(string $identifier): string
    {
        if (! preg_match('/^[a-z0-9_]+$/', $identifier)) {
            throw new \RuntimeException('Invalid demo schema identifier.');
        }

        return '"'.$identifier.'"';
    }
}
