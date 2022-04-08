<?php namespace Anomaly\Streams\Platform\Installer;

use Closure;

/**
 * Class Installer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Installer
{

    /**
     * The installation task.
     *
     * @var Closure
     */
    protected $task;

    /**
     * The output message.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new Installer instance.
     *
     * @param          $message
     * @param callable $task
     */
    public function __construct($message, Closure $task)
    {
        $this->task    = $task;
        $this->message = $message;
    }

    /**
     * Get the message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get the task.
     *
     * @return callable
     */
    public function getTask()
    {
        return $this->task;
    }
}
