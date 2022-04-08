<?php namespace Anomaly\Streams\Platform\Assignment\Form;

/**
 * Class AssignmentFormFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentFormFields
{

    /**
     * Handle the form fields.
     *
     * @param AssignmentFormBuilder $builder
     */
    public function handle(AssignmentFormBuilder $builder)
    {
        $builder->setFields(
            [
                'label'        => [
                    'label'        => 'streams::assignment.label.name',
                    'instructions' => 'streams::assignment.label.instructions',
                    'type'         => 'anomaly.field_type.text',
                ],
                'placeholder'  => [
                    'label'        => 'streams::assignment.placeholder.name',
                    'instructions' => 'streams::assignment.placeholder.instructions',
                    'type'         => 'anomaly.field_type.text',
                ],
                'instructions' => [
                    'label'        => 'streams::assignment.instructions.name',
                    'instructions' => 'streams::assignment.instructions.instructions',
                    'type'         => 'anomaly.field_type.textarea',
                ],
                'warning'      => [
                    'label'        => 'streams::assignment.warning.name',
                    'instructions' => 'streams::assignment.warning.instructions',
                    'type'         => 'anomaly.field_type.text',
                ],
                'required'     => [
                    'label'        => 'streams::assignment.required.label',
                    'instructions' => 'streams::assignment.required.instructions',
                    'type'         => 'anomaly.field_type.boolean',
                ],
                'unique'       => [
                    'label'        => 'streams::assignment.unique.label',
                    'instructions' => 'streams::assignment.unique.instructions',
                    'type'         => 'anomaly.field_type.boolean',
                ],
                'searchable'   => [
                    'label'        => 'streams::assignment.searchable.label',
                    'instructions' => 'streams::assignment.searchable.instructions',
                    'type'         => 'anomaly.field_type.boolean',
                ],
                'translatable' => [
                    'label'        => 'streams::assignment.translatable.label',
                    'instructions' => 'streams::assignment.translatable.instructions',
                    'type'         => 'anomaly.field_type.boolean',
                    'warning'      => function (AssignmentFormBuilder $builder) {

                        $stream = $builder->getStream();

                        if ($stream && !$stream->isTranslatable()) {
                            return 'streams::assignment.translatable.warning.stream';
                        }

                        $type = $builder->getFieldType();

                        if (!$type->getColumnType()) {
                            return 'streams::assignment.translatable.warning.column_type';
                        }

                        return null;
                    },
                    'disabled'     => function (AssignmentFormBuilder $builder) {

                        $stream = $builder->getStream();

                        if ($stream && !$stream->isTranslatable()) {
                            return true;
                        }

                        $type = $builder->getFieldType();

                        return (!$type->getColumnType());
                    },
                ],
            ]
        );
    }
}
