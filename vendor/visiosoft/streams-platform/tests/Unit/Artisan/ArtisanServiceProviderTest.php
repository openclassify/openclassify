<?php

class ArtisanServiceProviderTest extends TestCase
{

    public function testCanRegisterStreamsCommands()
    {
        /* @var \Anomaly\Streams\Platform\Console\Kernel $artisan */
        $artisan = app(\Anomaly\Streams\Platform\Console\Kernel::class);

        $this->assertEquals(isset($artisan->all()['streams:compile']), true);
    }

    public function testRegisterSeedCommand()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Database\Seeder\Console\SeedCommand::class,
            app('command.seed')
        );
    }

    public function testRegisterMigrateCommand()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Database\Migration\Console\MigrateCommand::class,
            app('command.migrate')
        );
    }

    public function testRegisterMigrateMakeCommand()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Database\Migration\Console\MigrateMakeCommand::class,
            app('command.migrate.make')
        );
    }

    public function testRegisterMigrateRefreshCommand()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Database\Migration\Console\RefreshCommand::class,
            app('command.migrate.refresh')
        );
    }

    public function testRegisterMigrateResetCommand()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Database\Migration\Console\ResetCommand::class,
            app('command.migrate.reset')
        );
    }

    public function testRegisterMigrateRollbackCommand()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Database\Migration\Console\RollbackCommand::class,
            app('command.migrate.rollback')
        );
    }
}
