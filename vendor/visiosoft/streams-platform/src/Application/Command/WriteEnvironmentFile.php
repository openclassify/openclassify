<?php

namespace Anomaly\Streams\Platform\Application\Command;

use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class WriteEnvironmentFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteEnvironmentFile
{

    use DispatchesJobs;

    /**
     * The environment variables.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new WriteEnvironmentFile instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $contents = '';

        foreach ($this->data as $key => $value) {

            if (Str::contains($value, [' ', '$', '\n'])) {
                $value = '"' . trim($value, '"') . '"';
            }

            if ($key) {
                $contents .= strtoupper($key) . '=' . $value . PHP_EOL;
            } else {
                $contents .= $value . PHP_EOL;
            }
        }

        $file = $this->dispatchNow(new GetEnvironmentFile());

        file_put_contents($file, $contents);
    }
}
