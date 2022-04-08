<?php namespace Anomaly\RelationshipFieldType\Handler;

use Anomaly\RelationshipFieldType\RelationshipFieldType;
use Anomaly\Streams\Platform\Support\Value;

/**
 * Class Related
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Related
{

    /**
     * Handle the options.
     *
     * @param  RelationshipFieldType $fieldType
     * @param Value $value
     * @return array
     */
    public function handle(RelationshipFieldType $fieldType, Value $value)
    {
        $model = $fieldType->getRelatedModel();

        $query   = $model->newQuery();
        $results = $query->get();

        $titleName = $fieldType->config('title_name', $model->getTitleName()) ?: $model->getTitleName();
        $keyName   = $fieldType->config('key_name', $model->getKeyName()) ?: $model->getKeyName();

        try {

            /**
             * Try and use a non-parsing pattern.
             */
            if (strpos($titleName, '{') === false) {
                $fieldType->setOptions(
                    $results
                        ->pluck(
                            $titleName,
                            $keyName
                        )
                        ->all()
                );
            }

            /**
             * Try and use a parsing pattern.
             */
            if (strpos($titleName, '{') !== false) {
                $fieldType->setOptions(
                    array_combine(
                        $results->map(
                            function ($item) use ($keyName) {
                                return data_get($item, $keyName);
                            }
                        )->all(),
                        $results->map(
                            function ($item) use ($titleName, $value) {
                                return $value->make($titleName, $item);
                            }
                        )->all()
                    )
                );
            }
        } catch (\Exception $e) {
            $fieldType->setOptions(
                $results->pluck(
                    $model->getTitleName(),
                    $model->getKeyName()
                )->all()
            );
        }
    }
}
