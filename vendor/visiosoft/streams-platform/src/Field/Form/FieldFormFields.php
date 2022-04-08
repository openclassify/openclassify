<?php namespace Anomaly\Streams\Platform\Field\Form;

use Anomaly\Streams\Platform\Field\Form\Command\GetConfigFields;
use Anomaly\Streams\Platform\Field\Form\Validator\SlugValidator;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class FieldFormFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldFormFields
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param FieldFormBuilder $builder
     */
    public function handle(FieldFormBuilder $builder)
    {
        $id        = $builder->getEntry();
        $namespace = $builder->getFieldNamespace();

        $builder->setFields(
            [
                'name'         => [
                    'label'        => 'streams::field.name.name',
                    'instructions' => 'streams::field.name.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'required'     => true,
                    'translatable' => true,
                    'config'       => [
                        'max'       => 64,
                        'suggested' => 20,
                    ],
                ],
                'slug'         => [
                    'label'        => 'streams::field.slug.name',
                    'instructions' => 'streams::field.slug.instructions',
                    'type'         => 'anomaly.field_type.slug',
                    'required'     => true,
                    'config'       => [
                        'slugify' => 'name',
                        'type'    => '_',
                        'max'     => 64,
                    ],
                    'rules'        => [
                        'valid_slug',
                        'unique:streams_fields,slug,' . (int)$id . ',id,namespace,' . $namespace,
                    ],
                    'validators'   => [
                        'valid_slug' => [
                            'handler' => SlugValidator::class,
                            'message' => 'streams::validation.invalid',
                        ],
                    ],
                ],
                'placeholder'  => [
                    'label'        => 'streams::field.placeholder.name',
                    'instructions' => 'streams::field.placeholder.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'translatable' => true,
                ],
                'instructions' => [
                    'label'        => 'streams::field.instructions.name',
                    'instructions' => 'streams::field.instructions.instructions',
                    'type'         => 'anomaly.field_type.textarea',
                    'translatable' => true,
                ],
                'warning'      => [
                    'label'        => 'streams::field.warning.name',
                    'instructions' => 'streams::field.warning.instructions',
                    'type'         => 'anomaly.field_type.text',
                    'translatable' => true,
                ],
            ]
        );

        if (($type = $builder->getFieldType()) || ($type = $builder->getFormEntry()->getType())) {
            $this->dispatchNow(new GetConfigFields($builder, $type));
        }
    }
}
