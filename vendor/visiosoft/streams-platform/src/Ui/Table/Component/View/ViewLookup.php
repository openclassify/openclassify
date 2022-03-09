<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ViewLookup
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewLookup
{

    /**
     * The view registry.
     *
     * @var ViewRegistry
     */
    protected $views;

    /**
     * Create a new ViewRegistry instance.
     *
     * @param ViewRegistry $views
     */
    public function __construct(ViewRegistry $views)
    {
        $this->views = $views;
    }

    /**
     * Merge in registered parameters.
     *
     * @param TableBuilder $builder
     */
    public function merge(TableBuilder $builder)
    {
        $views = $builder->getViews();

        foreach ($views as &$parameters) {
            if ($view = $this->views->get(array_get($parameters, 'view'))) {
                $parameters = array_replace_recursive($view, array_except($parameters, ['view']));
            }
        }

        $builder->setViews($views);
    }
}
