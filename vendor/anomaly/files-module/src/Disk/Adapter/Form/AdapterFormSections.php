<?php namespace Anomaly\FilesModule\Disk\Adapter\Form;

/**
 * Class AdapterFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AdapterFormSections
{

    /**
     * Handle the form fields.
     *
     * @param AdapterFormBuilder $builder
     */
    public function handle(AdapterFormBuilder $builder)
    {
        $disk          = $builder->getChildForm('disk');
        $configuration = $builder->getChildForm('configuration');

        $builder->setSections(
            [
                'disk'          => [
                    'fields' => function () use ($disk) {
                        return array_map(
                            function ($slug) {
                                return 'disk_' . $slug;
                            },
                            $disk->getFormFieldSlugs()
                        );
                    },
                ],
                'configuration' => [
                    'fields' => function () use ($configuration) {
                        return array_map(
                            function ($slug) {
                                return 'configuration_' . $slug;
                            },
                            $configuration->getFormFieldSlugs()
                        );
                    },
                ],
            ]
        );
    }
}
