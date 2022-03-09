<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Button\Button;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract\ActionInterface;

/**
 * Class Action
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Action extends Button implements ActionInterface
{

    /**
     * The button tag.
     *
     * @var string
     */
    protected $tag = 'button';

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The action prefix.
     *
     * @var string|null
     */
    protected $prefix = null;

    /**
     * The action slug.
     *
     * @var string
     */
    protected $slug = 'default';

    /**
     *
     * @var bool
     */
    protected $save = true;

    /**
     * The responding redirect URL.
     *
     * @var null|string
     */
    protected $redirect = null;

    /**
     * The action handler.
     *
     * @var string
     */
    protected $handler = ActionHandler::class;

    /**
     * Get the action handler.
     *
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Set the action handler.
     *
     * @param $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Get the redirect URL.
     *
     * @return null|string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set the redirect URL.
     *
     * @param $redirect
     * @return $this
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Set the active flag.
     *
     * @param  bool $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Get the action prefix.
     *
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set the action prefix.
     *
     * @param  string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the action slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the action slug.
     *
     * @param  string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
