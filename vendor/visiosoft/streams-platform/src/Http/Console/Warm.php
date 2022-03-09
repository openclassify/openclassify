<?php namespace Anomaly\Streams\Platform\Http\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Warm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Warm extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'httpcache:warm';

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (config('streams::httpcache.enabled', false) === false) {

            $this->error('HTTP cache is not enabled.');

            return;
        }

        if ($this->option('clear')) {
            $this->call('httpcache:clear');
        }

        $sleep = $this->option('sleep');

        $sitemaps = simplexml_load_string(file_get_contents(config('app.url') . '/sitemap.xml'));

        foreach ($sitemaps as $sitemap) {

            if ($sleep) {
                sleep($sleep);
            }

            $this->info('Warming: ' . (string)$sitemap->loc);

            $items = simplexml_load_string(file_get_contents((string)$sitemap->loc));

            foreach ($items as $item) {

                if ($sleep) {
                    sleep($sleep);
                }

                file_get_contents((string)$item->loc);

                $this->info('Cached: ' . (string)$item->loc);
            }
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['sleep', null, InputOption::VALUE_OPTIONAL, 'The wait time between each request.'],
            ['clear', null, InputOption::VALUE_NONE, 'Clear cache before warming.'],
        ];
    }
}
