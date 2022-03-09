<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;


/**
 * Class GetSettingValue
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetSettingValue
{

    /**
     * The setting key.
     *
     * @var string
     */
    protected $key;

    /**
     * The default value.
     *
     * @var mixed
     */
    protected $default;

    /**
     * Create a new GetSettingValue instance.
     *
     * @param      $key
     * @param null $default
     */
    public function __construct($key, $default = null)
    {
        $this->key     = $key;
        $this->default = $default;
    }

    /**
     * Handle the command.
     *
     * @param  SettingRepositoryInterface $settings
     * @return mixed
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        return $settings->value($this->key, $this->default);
    }
}
