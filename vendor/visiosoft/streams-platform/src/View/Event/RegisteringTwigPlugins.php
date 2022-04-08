<?php namespace Anomaly\Streams\Platform\View\Event;

use Anomaly\Streams\Platform\View\Twig\Bridge;

/**
 * Class RegisteringTwigPlugins
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RegisteringTwigPlugins
{

    /**
     * The Twig instance.
     *
     * @var Bridge
     */
    protected $twig;

    /**
     * Create a new RegisteringTwigPlugins instance.
     *
     * @param Bridge $twig
     */
    public function __construct(Bridge $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Get the Twig instance.
     *
     * @return Bridge
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
