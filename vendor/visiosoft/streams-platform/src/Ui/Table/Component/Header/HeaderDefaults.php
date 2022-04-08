<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HeaderDefaults
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HeaderDefaults
{

    /**
     * Set defaults.
     *
     * @param TableBuilder $builder
     */
    public function defaults(TableBuilder $builder)
    {
        if (!$stream = $builder->getTableStream()) {
            return;
        }

        if ($builder->getColumns() == []) {
            $builder->setColumns([$stream->getTitleColumn()]);
        }
    }
}
