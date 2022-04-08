<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class SetStreamsData
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetStreamsData
{

    /**
     * The data collection.
     *
     * @var Collection
     */
    protected $data;

    /**
     * Create a new SetStreamsData instance.
     *
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->data->put('APP_ENV', 'local');
        $this->data->put('INSTALLED', 'false');
        $this->data->put('APP_KEY', str_random(32));
        $this->data->put('APP_DEBUG', 'true');
        $this->data->put('DEBUG_BAR', 'false');
    }
}
