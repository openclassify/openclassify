<?php namespace Anomaly\PagesModule;

use Anomaly\PagesModule\Console\Dump;
use Anomaly\PagesModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\PagesModule\Http\Controller\Admin\FieldsController;
use Anomaly\PagesModule\Http\Controller\Admin\VersionsController;
use Anomaly\PagesModule\Listener\RefreshPagesModule;
use Anomaly\PagesModule\Page\Command\DumpPages;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\PagesModule\Page\PageRepository;
use Anomaly\PagesModule\Page\PageTranslationsModel;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PagesModule\Type\TypeModel;
use Anomaly\PagesModule\Type\TypeRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryModel;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryTranslationsModel;
use Anomaly\Streams\Platform\Model\Pages\PagesTypesEntryModel;
use Anomaly\Streams\Platform\Version\VersionRouter;

/**
 * Class PagesModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesModuleServiceProvider extends AddonServiceProvider
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
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        PagesModulePlugin::class,
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        SystemIsRefreshing::class => [
            RefreshPagesModule::class,
        ],
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        PagesPagesEntryModel::class             => PageModel::class,
        PagesTypesEntryModel::class             => TypeModel::class,
        PagesPagesEntryTranslationsModel::class => PageTranslationsModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        PageRepositoryInterface::class => PageRepository::class,
        TypeRepositoryInterface::class => TypeRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'pages/preview/{id}' => 'Anomaly\PagesModule\Http\Controller\PagesController@preview',
    ];

    /**
     * Map additional routes.
     *
     * @param FieldRouter $fields
     * @param VersionRouter $versions
     * @param AssignmentRouter $assignments
     */
    public function map(
        FieldRouter $fields,
        VersionRouter $versions,
        AssignmentRouter $assignments
    ) {
        $versions->route($this->addon, VersionsController::class);

        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class, 'admin/pages/types');

        if (!file_exists($routes = app_storage_path('pages/routes.php'))) {
            dispatch_now(new DumpPages());
        }

        require $routes;
    }
}
