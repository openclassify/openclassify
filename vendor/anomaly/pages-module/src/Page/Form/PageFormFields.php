<?php namespace Anomaly\PagesModule\Page\Form;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PageFormFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageFormFields
{

    use DispatchesJobs;

    /**
     * Handle the page fields.
     *
     * @param PageFormBuilder $builder
     * @param PreferenceRepositoryInterface $preferences
     */
    public function handle(PageFormBuilder $builder)
    {
        $parent = $builder->getParent();

        /* @var PageInterface $entry */
        if (!$parent && $entry = $builder->getFormEntry()) {
            $parent = $entry->getParent();
        }

        $builder->setFields(
            [
                '*',
                'parent'     => [
                    'config' => [
                        'mode'          => 'lookup',
                        'default_value' => $parent ? $parent->getId() : null,
                    ],
                ],
                'publish_at' => [
                    'config' => [
                        'default_value' => 'now',
                        'timezone'      => config('app.timezone'),
                    ],
                ],
            ]
        );

        if ($parent && $translations = $parent->getTranslations()) {
            $builder->setFields(
                array_merge(
                    $builder->getFields(),
                    $translations->map(
                        function ($translation) {

                            return [
                                'field'  => 'slug',
                                'locale' => $translation->locale,
                                'config' => [
                                    'prefix' => $translation->path,
                                ],
                            ];
                        }
                    )->all()
                )
            );
        }

        foreach (config('streams::locales.enabled') as $locale) {
            $builder->setFields(
                array_merge(
                    $builder->getFields(),
                    [
                        [
                            'readonly'     => true,
                            'translatable' => true,
                            'save'         => false,
                            'enabled'      => 'edit',
                            'locale'       => $locale,
                            'field'        => 'route_name',
                            'type'         => 'anomaly.field_type.text',
                            'label'        => 'anomaly.module.pages::field.route_name.name',
                            'hidden'       => $locale !== config('streams::locales.default'),
                            'instructions' => 'anomaly.module.pages::field.route_name.instructions',
                            'value'        => $builder->getFormEntryId(
                            ) ? "pages::{$builder->getFormEntryId()}.{$locale}" : null,
                        ],
                    ]
                )
            );
        }
    }
}
