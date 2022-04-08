<?php namespace Anomaly\Streams\Platform\Http;

use Illuminate\Contracts\Http\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\SurrogateInterface;

/**
 * Class CacheKernel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheKernel extends \Barryvdh\HttpCache\CacheKernel
{

    /**
     * System excluded.
     *
     * @var array
     */
    protected static $excluded = [
        '/admin',
        '/admin/*',
        '/cron',
        '/cron/*',
        '/streams/*-field_type/*',
        '/streams/*-extension/*',
        '/streams/*-module/*',
        '/entry/handle/*',
        '/form/handle/*',
        '/locks/touch',
        '/locks/release',
        '/logout*',
        '/login*',
    ];

    /**
     * Wrap a Laravel Kernel in a Symfony HttpKernel
     *
     * @param Kernel $kernel
     * @param null $storagePath
     * @param SurrogateInterface|null $surrogate
     * @param array $options
     * @return Kernel|HttpCache
     */
    public static function wrap(
        Kernel $kernel,
        $storagePath = null,
        SurrogateInterface $surrogate = null,
        $options = []
    ) {

        /**
         * Start setting up the HttpCache kernel.
         */
        $storagePath = $storagePath ?: storage_path('httpcache');

        /**
         * This is a special case for the domains
         * module. This is really the only place to
         * put this since addons are not registered.
         */
        $domains = [];

        if (file_exists($file = __DIR__ . '/../../../../../bootstrap/cache/domains.php')) {
            $domains = include $file;
        }

        $store = new Store($storagePath);

        $wrapper = new static($kernel);

        $cache = new HttpCache($wrapper, $store, $surrogate, $options);

        app()->singleton(
            \Anomaly\Streams\Platform\Http\HttpCache::class,
            function () use ($cache) {
                return $cache;
            }
        );

        /**
         * Disable for Control Panel
         */
        if (str_is(static::$excluded, $_SERVER['REQUEST_URI']) || in_array($_SERVER['HTTP_HOST'], $domains)) {
            return $kernel;
        }

        /**
         * Disable if they are or have been
         * accessing the control panel as well.
         */
        if (isset($_COOKIE['session_proxy'])) {
            return $kernel;
        }

        return $cache;
    }

    /**
     * Terminate the response.
     *
     * @param Request $request
     * @param Response $response
     */
    public function terminate(Request $request, Response $response)
    {
        $this->kernel->terminate($request, $response);
    }

}
