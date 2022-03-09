<?php namespace Anomaly\Streams\Platform\Field\Form;

/**
 * Class FieldFormSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldFormSections
{

    /**
     * Handle the form sections.
     *
     * @param FieldFormBuilder $builder
     */
    public function handle(FieldFormBuilder $builder)
    {
        $builder->setSections(
            [
                'field' => [
                    'fields' => function (FieldFormBuilder $builder) {
                        return array_map(
                            function ($field) {
                                return $field['field'];
                            },
                            array_filter(
                                $builder->getFields(),
                                function ($field) {

                                    // No config fields.
                                    if (starts_with($field['field'], 'config__')) {
                                        return false;
                                    }

                                    // Only default locale fields.
                                    if (isset($field['locale']) && $field['locale'] !== config('streams::locales.default')) {
                                        return false;
                                    }

                                    return true;
                                }
                            )
                        );
                    },
                ],
            ]
        );

        if (($type = $builder->getFormEntry()->getType()) || ($type = $builder->getFieldType())) {
            if ($sections = config($type->getNamespace('config/sections'))) {
                foreach ($sections as $slug => $section) {
                    $builder->addSection($slug, $section);
                }
            } else {
                $builder->addSection(
                    'configuration',
                    [
                        'fields' => function (FieldFormBuilder $builder) {
                            return array_map(
                                function ($field) {
                                    return $field['field'];
                                },
                                array_filter(
                                    $builder->getFields(),
                                    function ($field) {

                                        // Only config fields.
                                        if (!starts_with($field['field'], 'config__')) {
                                            return false;
                                        }

                                        // Only default locale fields.
                                        if (isset($field['locale']) && $field['locale'] !== config(
                                                'app.fallback_locale'
                                            )
                                        ) {
                                            return false;
                                        }

                                        return true;
                                    }
                                )
                            );
                        },
                    ]
                );
            }
        }
    }
}
