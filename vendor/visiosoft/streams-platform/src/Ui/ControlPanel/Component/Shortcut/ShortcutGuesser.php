<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Guesser\PermissionGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Guesser\TitleGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class ShortcutGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShortcutGuesser
{

    /**
     * The HREF guesser.
     *
     * @var HrefGuesser
     */
    protected $href;

    /**
     * The title guesser.
     *
     * @var TitleGuesser
     */
    protected $title;

    /**
     * The permission guesser.
     *
     * @var PermissionGuesser
     */
    protected $permission;

    /**
     * Create a new ShortcutGuesser instance.
     *
     * @param HrefGuesser $href
     * @param TitleGuesser $title
     * @param PermissionGuesser $permission
     */
    public function __construct(
        HrefGuesser $href,
        TitleGuesser $title,
        PermissionGuesser $permission
    ) {
        $this->href       = $href;
        $this->title      = $title;
        $this->permission = $permission;
    }

    /**
     * Guess shortcut properties.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $this->href->guess($builder);
        $this->title->guess($builder);
        $this->permission->guess($builder);
    }
}
