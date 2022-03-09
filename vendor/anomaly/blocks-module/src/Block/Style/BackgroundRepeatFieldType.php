<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class BackgroundRepeatFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BackgroundRepeatFieldType extends SelectFieldType
{

    use ProvidesStyle;

    /**
     * The required flag.
     *
     * @var bool
     */
    protected $required = true;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.background_repeat.label';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'repeat'    => 'anomaly.module.blocks::style.background_repeat.option.repeat',
        'repeat-x'  => 'anomaly.module.blocks::style.background_repeat.option.repeat-x',
        'repeat-y'  => 'anomaly.module.blocks::style.background_repeat.option.repeat-y',
        'no-repeat' => 'anomaly.module.blocks::style.background_repeat.option.no-repeat',
        'space'     => 'anomaly.module.blocks::style.background_repeat.option.space',
        'round'     => 'anomaly.module.blocks::style.background_repeat.option.round',
    ];

    /**
     * Get the configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['default_value'] = 'no-repeat';

        return $config;
    }

}
