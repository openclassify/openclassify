<?php namespace Anomaly\Streams\Platform\Application\Event;

use Illuminate\Console\Command;

/**
 * Class SystemIsRefreshing
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SystemIsRefreshing
{

    /**
     * The command instance.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new SystemIsBuilding instance.
     *
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Get the command.
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }
}
