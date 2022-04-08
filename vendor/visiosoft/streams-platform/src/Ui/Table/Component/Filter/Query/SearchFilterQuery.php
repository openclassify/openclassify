<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\EloquentQueryBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\SearchFilterInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;

/**
 * Class SearchFilterQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchFilterQuery
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new FieldFilterQuery instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Handle the filter.
     *
     * @param Builder $query
     * @param SearchFilterInterface $filter
     */
    public function handle(Builder $query, TableBuilder $builder, SearchFilterInterface $filter)
    {
        $stream = $filter->getStream();
        $model  = $builder->getTableModel();

        /**
         * If the model is translatable then
         * join it's translations so they
         * are filterable too.
         *
         * @var EloquentQueryBuilder|\Illuminate\Database\Query\Builder $query
         */
        if (
            $model instanceof EloquentModel &&
            $model->getTranslationModelName() &&
            !$query->hasJoin($model->getTranslationTableName())
        ) {
            $query->leftJoin(
                $model->getTranslationTableName(),
                $model->getTableName() . '.id',
                '=',
                $model->getTranslationTableName() . '.' . $model->getRelationKey()
            );
        }

        $query->where(
            function (Builder $query) use ($filter, $stream, $builder) {

                /* @var Builder|HasAttributes $query */
                $casts = $query
                    ->getModel()
                    ->getCasts();

                foreach ($filter->getColumns() as $column) {

                    $value = $filter->getValue();

                    if (array_get($casts, $column) == 'json') {
                        $value = addslashes(substr(json_encode($value), 1, -1));
                    }

                    $query->orWhere($column, 'LIKE', "%{$value}%");
                }

                foreach ($filter->getFields() as $field) {

                    $filter->setField($field);

                    $fieldType      = $stream->getFieldType($field);
                    $fieldTypeQuery = $fieldType->getQuery();

                    $fieldTypeQuery->setConstraint('or');

                    $this->container->call([$fieldTypeQuery, 'filter'], compact('query', 'filter', 'builder'));
                }
            }
        );
    }
}
