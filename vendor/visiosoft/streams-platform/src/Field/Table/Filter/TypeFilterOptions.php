<?php namespace Anomaly\Streams\Platform\Field\Table\Filter;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\SelectFilterInterface;

/**
 * Class TypeFilterOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TypeFilterOptions
{

    /**
     * Handle the options.
     *
     * @param FieldTypeCollection $fieldTypes
     */
    public function handle(SelectFilterInterface $filter, FieldTypeCollection $fieldTypes)
    {
        $filter->setOptions($fieldTypes->pluck('title', 'namespace')->all());
    }
}
