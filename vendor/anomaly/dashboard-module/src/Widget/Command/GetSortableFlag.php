<?php namespace Anomaly\DashboardModule\Widget\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\Streams\Platform\Support\Authorizer;


/**
 * Class GetSortableFlag
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetSortableFlag
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new GetSortableFlag instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the command.
     *
     * @param  Authorizer $authorizer
     * @return bool
     */
    public function handle(Authorizer $authorizer)
    {
        return $authorizer->authorize('anomaly.module.dashboard::dashboard.write');
    }
}
