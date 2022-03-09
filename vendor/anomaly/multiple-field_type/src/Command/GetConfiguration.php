<?php namespace Anomaly\MultipleFieldType\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Crypt;

/**
 * Class GetConfiguration
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetConfiguration
{

    /**
     * The config key.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new GetConfiguration instance.
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Handle the command.
     *
     * @param  Repository $cache
     * @return Collection
     */
    public function handle(Repository $cache)
    {
        return new Collection(
            array_merge(Crypt::decrypt($this->key), ['key' => $this->key])
        );
    }
}
