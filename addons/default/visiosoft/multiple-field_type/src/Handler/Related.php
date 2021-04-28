<?php namespace Visiosoft\MultipleFieldType\Handler;

use Visiosoft\MultipleFieldType\MultipleFieldType;
use Anomaly\Streams\Platform\Support\Value;

class Related
{

    /**
     * Handle the options.
     *
     * @param  MultipleFieldType $fieldType
     * @param Value $value
     * @return array
     */
    public function handle(MultipleFieldType $fieldType, Value $value)
    {
        $model = $fieldType->getRelatedModel();

        $query   = $model->newQuery();
        $results = $query->get();

        try {

            /**
             * Try and use a non-parsing pattern.
             */
            if (strpos($fieldType->config('title_name', $model->getTitleName()), '{') === false) {
                $fieldType->setOptions(
                    $results->pluck(
                        $fieldType->config('title_name', $model->getTitleName()),
                        $fieldType->config('key_name', $model->getKeyName())
                    )->all()
                );
            }

            /**
             * Try and use a parsing pattern.
             */
            if (strpos($fieldType->config('title_name', $model->getTitleName()), '{') !== false) {
                $fieldType->setOptions(
                    array_combine(
                        $results->map(
                            function ($item) use ($fieldType, $model) {
                                return data_get($item, $fieldType->config('key_name', $model->getKeyName()));
                            }
                        )->all(),
                        $results->map(
                            function ($item) use ($fieldType, $model, $value) {
                                return $value->make($fieldType->config('title_name', $model->getTitleName()), $item);
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
