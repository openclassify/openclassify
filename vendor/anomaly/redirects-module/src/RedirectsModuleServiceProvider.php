<?php namespace Anomaly\RedirectsModule;

use Anomaly\RedirectsModule\Console\Dump;
use Anomaly\RedirectsModule\Domain\Command\DumpDomains;
use Anomaly\RedirectsModule\Domain\Contract\DomainRepositoryInterface;
use Anomaly\RedirectsModule\Domain\DomainModel;
use Anomaly\RedirectsModule\Domain\DomainRepository;
use Anomaly\RedirectsModule\Http\Middleware\RedirectDomains;
use Anomaly\RedirectsModule\Listener\RefreshRedirectsModule;
use Anomaly\RedirectsModule\Redirect\Command\DumpRedirects;
use Anomaly\RedirectsModule\Redirect\Contract\RedirectRepositoryInterface;
use Anomaly\RedirectsModule\Redirect\RedirectModel;
use Anomaly\RedirectsModule\Redirect\RedirectRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Model\Redirects\RedirectsDomainsEntryModel;
use Anomaly\Streams\Platform\Model\Redirects\RedirectsRedirectsEntryModel;

/**
 * Class RedirectsModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        Dump::class,
    ];

    /**
     * The addon middleware.
     *
     * @var array
     */
    protected $middleware = [
        RedirectDomains::class,
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        SystemIsRefreshing::class => [
            RefreshRedirectsModule::class,
        ],
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        RedirectsDomainsEntryModel::class   => DomainModel::class,
        RedirectsRedirectsEntryModel::class => RedirectModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        DomainRepositoryInterface::class   => DomainRepository::class,
        RedirectRepositoryInterface::class => RedirectRepository::class,
    ];

    /**
     * Load additional routes.
     */
    public function map()
    {
        if (!file_exists($routes = app_storage_path('redirects/routes.php'))) {
            dispatch_now(new DumpRedirects());
        }

        if (!file_exists(app_storage_path('redirects/domains.php'))) {
            dispatch_now(new DumpDomains());
        }

        require $routes;
    }

}
