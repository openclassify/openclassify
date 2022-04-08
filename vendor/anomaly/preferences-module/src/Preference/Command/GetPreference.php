<?php namespace Anomaly\PreferencesModule\Preference\Command;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;


/**
 * Class GetPreference
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetPreference
{

    /**
     * The preference key.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new GetPreference instance.
     *
     * @param      $key
     * @param null $default
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Handle the command.
     *
     * @param  PreferenceRepositoryInterface $preferences
     * @return mixed
     */
    public function handle(PreferenceRepositoryInterface $preferences)
    {
        return $preferences->get($this->key);
    }
}
