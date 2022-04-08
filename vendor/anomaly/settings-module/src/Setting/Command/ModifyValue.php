<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ModifyValue
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ModifyValue
{

    use DispatchesJobs;

    /**
     * The setting value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * The setting instance.
     *
     * @var SettingInterface
     */
    protected $setting;

    /**
     * Create a new ModifyValue instance.
     *
     * @param SettingInterface $setting
     * @param                  $value
     */
    public function __construct(SettingInterface $setting, $value)
    {
        $this->value   = $value;
        $this->setting = $setting;
    }

    /**
     * Handle the command.
     *
     * @return mixed
     */
    public function handle()
    {
        /* @var FieldType $type */
        if ($type = $this->dispatch(new GetValueFieldType($this->setting))) {
            return $type->getModifier()->modify($this->value);
        }

        return $this->value;
    }
}
