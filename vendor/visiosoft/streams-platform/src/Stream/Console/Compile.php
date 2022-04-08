<?php namespace Anomaly\Streams\Platform\Stream\Console;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Console\Command;

/**
 * Class Compile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Compile extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'streams:compile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compile streams entry models.';

    /**
     * Execute the console command.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        /* @var StreamInterface|EloquentModel $stream */
        foreach ($streams->all() as $stream) {
            if ($streams->save($stream)) {
                $this->info($stream->getEntryModelName() . ' compiled successfully.');
            }
        }
    }
}
