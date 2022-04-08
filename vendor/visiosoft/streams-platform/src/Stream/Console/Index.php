<?php namespace Anomaly\Streams\Platform\Stream\Console;

use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Index
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Index extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'streams:index';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Update search indexes for one or more Streams.';

    /**
     * Handle the command.
     *
     * @param Kernel $console
     * @param StreamRepositoryInterface $streams
     */
    public function handle(Kernel $console, StreamRepositoryInterface $streams)
    {

        $slug      = $this->argument('stream');
        $namespace = $this->argument('namespace');

        if ($slug && $namespace) {
            $streams = [$streams->findBySlugAndNamespace($slug, $namespace)];
        }

        if (!$slug && $namespace) {
            $streams = $streams->findAllByNamespace($namespace);
        }

        if (!$slug && !$namespace) {
            $streams = $streams->all();
        }

        /* @var StreamInterface $stream */
        foreach ($streams as $stream) {

            /**
             * If the stream is not searchable
             * then skip over it.
             */
            if (!$stream->isSearchable()) {

                $this->warn($stream->getNamespace() . '.' . $stream->getSlug() . ' is not searchable.');

                continue;
            }

            /**
             * Grab the bound entry model name
             * so that any overriding configuration
             * can have it's say when indexing.
             */
            $model = $stream->getBoundEntryModelName();

            /**
             * Optionally flush before indexing.
             */
            if ($this->option('flush')) {

                $console->call(
                    'scout:flush',
                    [
                        'model' => $model,
                    ],
                    $this->getOutput()
                );
            }

            /**
             * Index using the bound model name.
             */
            $console->call(
                'scout:import',
                [
                    'model' => $model,
                ],
                $this->getOutput()
            );
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['namespace', InputArgument::OPTIONAL, 'The stream namespace to index.'],
            ['stream', InputArgument::OPTIONAL, 'The slug of the stream to index.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['flush', null, InputOption::VALUE_NONE, 'Indicates if index(es) should first be flushed.'],
        ];
    }

}
