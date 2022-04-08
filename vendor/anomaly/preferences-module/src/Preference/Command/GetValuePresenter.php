<?php namespace Anomaly\PreferencesModule\Preference\Command;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetValuePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetValuePresenter
{

    use DispatchesJobs;

    /**
     * The preference instance.
     *
     * @var PreferenceInterface
     */
    protected $preference;

    /**
     * Create a new GetValuePresenter instance.
     *
     * @param PreferenceInterface $preference
     */
    public function __construct(PreferenceInterface $preference)
    {
        $this->preference = $preference;
    }

    /**
     * Handle the command.
     *
     * @return \Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter|mixed|object
     */
    public function handle()
    {
        /* @var FieldType $type */
        if ($type = $this->dispatch(new GetValueFieldType($this->preference))) {
            return $type->getPresenter();
        }

        return array_get($this->preference->getAttributes(), 'value');
    }
}
