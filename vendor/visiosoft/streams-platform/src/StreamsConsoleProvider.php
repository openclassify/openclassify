<?php namespace Anomaly\Streams\Platform;

use Anomaly\Streams\Platform\Artisan\ArtisanServiceProvider;
use Anomaly\Streams\Platform\Database\Migration\MigrationServiceProvider;
use Illuminate\Foundation\Providers\ComposerServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;

/**
 * Class StreamsConsoleProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamsConsoleProvider extends ConsoleSupportServiceProvider
{

    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        ArtisanServiceProvider::class,
        MigrationServiceProvider::class,
        ComposerServiceProvider::class,
    ];
}
