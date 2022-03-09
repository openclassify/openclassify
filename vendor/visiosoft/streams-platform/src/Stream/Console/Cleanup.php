<?php namespace Anomaly\Streams\Platform\Stream\Console;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Console\Command;

/**
 * Class Cleanup
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Cleanup extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'streams:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup streams entry models.';

    /**
     * Execute the console command.
     *
     * @param FieldRepositoryInterface      $fields
     * @param StreamRepositoryInterface     $streams
     * @param AssignmentRepositoryInterface $assignments
     */
    public function handle(
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        AssignmentRepositoryInterface $assignments
    ) {
        $streams->cleanup();
        $this->info('Abandoned streams deleted successfully.');

        $fields->cleanup();
        $this->info('Abandoned fields deleted successfully.');

        $assignments->cleanup();
        $this->info('Abandoned assignments deleted successfully.');
    }
}
