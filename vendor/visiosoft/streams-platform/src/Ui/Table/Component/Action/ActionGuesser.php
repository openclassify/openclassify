<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\Guesser\HandlerGuesser;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\Guesser\PermissionGuesser;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\Guesser\TextGuesser;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ActionGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionGuesser
{

    /**
     * The text guesser.
     *
     * @var TextGuesser
     */
    protected $text;

    /**
     * The handler guesser.
     *
     * @var HandlerGuesser
     */
    protected $handler;

    /**
     * The permission guesser.
     *
     * @var PermissionGuesser
     */
    protected $permission;

    /**
     * Create a new ActionGuesser instance.
     *
     * @param TextGuesser       $text
     * @param HandlerGuesser    $handler
     * @param PermissionGuesser $permission
     */
    public function __construct(TextGuesser $text, HandlerGuesser $handler, PermissionGuesser $permission)
    {
        $this->text       = $text;
        $this->handler    = $handler;
        $this->permission = $permission;
    }

    /**
     * Guess action parameters.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $this->text->guess($builder);
        $this->handler->guess($builder);
        $this->permission->guess($builder);
    }
}
