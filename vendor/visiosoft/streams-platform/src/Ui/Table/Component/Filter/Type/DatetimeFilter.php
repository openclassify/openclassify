<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type;

use Anomaly\DatetimeFieldType\DatetimeFieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Filter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query\DatetimeFilterQuery;

/**
 * Class DatetimeFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFilter extends Filter
{

    /**
     * The query handler.
     *
     * @var string
     */
    protected $query = DatetimeFilterQuery::class;

    /**
     * Get the input HTML.
     *
     * @return null|string
     */
    public function getInput()
    {
        /* @var FieldTypeCollection $fieldTypes */
        $fieldTypes = app(FieldTypeCollection::class);

        /* @var DatetimeFieldType $datetime */
        if (!$datetime = $fieldTypes->get('anomaly.field_type.datetime')) {
            return null;
        }

        return $datetime
            ->setLocale(null)
            ->setField($this->getSlug())
            ->setValue($this->getValue())
            ->setPlaceholder($this->getPlaceholder())
            ->setPrefix($this->getPrefix() . 'filter_')
            ->getFilter();
    }
}
