<?php namespace Anomaly\Streams\Platform\Ui\Icon\Command;

use Anomaly\Streams\Platform\Ui\Icon\Icon;
use Anomaly\Streams\Platform\Ui\Icon\IconRegistry;

/**
 * Class GetIcon
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetIcon
{

    /**
     * The icon type.
     *
     * @var string
     */
    protected $type;

    /**
     * The icon class.
     *
     * @var string
     */
    protected $class;

    /**
     * Create a new GetIcon instance.
     *
     * @param      $type
     * @param null $class
     */
    public function __construct($type, $class = null)
    {
        $this->type  = $type;
        $this->class = $class;
    }

    /**
     * Handle the command.
     *
     * @param  IconRegistry $registry
     * @return string
     */
    public function handle(IconRegistry $registry)
    {
        return (new Icon())->setType($registry->get($this->type))->setClass($this->class);
    }
}
