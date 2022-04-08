<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ViewDefaults
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewDefaults
{

    /**
     * Default table views.
     *
     * @param TableBuilder $builder
     */
    public function defaults(TableBuilder $builder)
    {
        if (!$stream = $builder->getTableStream()) {
            return;
        }

        if ($stream->isTrashable() && !$builder->getViews() && !$builder->isAjax()) {
            $builder->setViews(
                [
                    'all',
                    'trash',
                ]
            );
        }
    }
}
