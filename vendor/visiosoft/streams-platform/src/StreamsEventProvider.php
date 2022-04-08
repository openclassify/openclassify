<?php namespace Anomaly\Streams\Platform;

use Anomaly\Streams\Platform\Addon\Event\AddonsHaveRegistered;
use Anomaly\Streams\Platform\Addon\Module\Listener\DetectActiveModule;
use Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded;
use Anomaly\Streams\Platform\Asset\Listener\AddAddonPaths as AddAddonAssetPaths;
use Anomaly\Streams\Platform\Image\Listener\AddAddonPaths as AddAddonImagePaths;
use Anomaly\Streams\Platform\Message\Listener\LoadMessageBag;
use Anomaly\Streams\Platform\Stream\Event\StreamIsDeleting;
use Anomaly\Streams\Platform\Stream\Event\StreamWasDeleted;
use Anomaly\Streams\Platform\Ui\Breadcrumb\Listener\GuessBreadcrumbs;
use Anomaly\Streams\Platform\Ui\Breadcrumb\Listener\LoadBreadcrumbs;
use Anomaly\Streams\Platform\Ui\ControlPanel\Listener\LoadControlPanel;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Listener\FilterResults;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Listener\ApplyView;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\Streams\Platform\Version\Listener\DeleteModuleVersions;
use Anomaly\Streams\Platform\Version\Listener\DeleteVersionableHistory;
use Anomaly\Streams\Platform\View\Event\TemplateDataIsLoading;
use Anomaly\Streams\Platform\View\Event\ViewComposed;
use Anomaly\Streams\Platform\View\Listener\DecorateData;
use Anomaly\Streams\Platform\View\Listener\LoadGlobalData;
use Anomaly\Streams\Platform\View\Listener\LoadTemplateData;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

/**
 * Class StreamsEventProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamsEventProvider extends EventServiceProvider
{

    /**
     * Event listeners.
     *
     * @var array
     */
    protected $listen = [
        ApplicationHasLoaded::class  => [
            DetectActiveModule::class,
            LoadControlPanel::class,
            GuessBreadcrumbs::class,
            LoadBreadcrumbs::class,
            LoadMessageBag::class,
        ],
        AddonsHaveRegistered::class  => [
            AddAddonAssetPaths::class,
            AddAddonImagePaths::class,
        ],
        ViewComposed::class          => [
            DecorateData::class,
            LoadTemplateData::class,
        ],
        TemplateDataIsLoading::class => [
            LoadGlobalData::class,
        ],
        TableIsQuerying::class       => [
            ApplyView::class,
            FilterResults::class,
        ],
        StreamIsDeleting::class      => [
            DeleteVersionableHistory::class,
        ],
    ];
}
