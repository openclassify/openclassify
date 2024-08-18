<?php namespace Visiosoft\CustomfieldsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class CustomfieldsModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-braille';

    /**
     * Set the sections.
     *
     * @param array $sections
     * @return $this
     */
    public function getSections()
    {
        $this->sections = [
            'custom_fields' => [
                'buttons' => [
                    'new_custom_field',
                    'assets_clear' => [
                        'type' => 'warning',
                        'icon' => 'fa fa-refresh',
                        'href' => '/admin/assets/clear',
                    ]
                ],
            ],
            'cfvalue' => [
                'buttons' => [
                    'new_cfvalue' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'href' => 'admin/customfields/cfvalue/choose',
                    ],
                ],
            ],
        ];

        if (is_extension_installed('visiosoft.extension.selected_cf')){
            $tab = [
                'selectedcf' => [
                    'href' => '/admin/customfields/selectedcf',
                ]
            ];
            $this->sections=array_merge($this->sections, $tab);
        }

        return $this->sections;
    }

}
