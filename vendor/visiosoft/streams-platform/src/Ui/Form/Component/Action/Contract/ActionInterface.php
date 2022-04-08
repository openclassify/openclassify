<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract;

use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;

/**
 * Interface ActionInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ActionInterface extends ButtonInterface
{

    /**
     * Set the action handler.
     *
     * @param $handler
     * @return $this
     */
    public function setHandler($handler);

    /**
     * Get the action handler.
     *
     * @return mixed
     */
    public function getHandler();

    /**
     * Set the redirect URL.
     *
     * @param $redirect
     * @return $this
     */
    public function setRedirect($redirect);

    /**
     * Get the redirect URL.
     *
     * @return null|string
     */
    public function getRedirect();

    /**
     * Set the active flag.
     *
     * @param  $active
     * @return mixed
     */
    public function setActive($active);

    /**
     * Get the active flag.
     *
     * @return mixed
     */
    public function isActive();

    /**
     * Set the action prefix.
     *
     * @param  $prefix
     * @return mixed
     */
    public function setPrefix($prefix);

    /**
     * Get the action prefix.
     *
     * @return mixed
     */
    public function getPrefix();

    /**
     * Set the action slug.
     *
     * @param  $slug
     * @return mixed
     */
    public function setSlug($slug);

    /**
     * Get the action slug.
     *
     * @return mixed
     */
    public function getSlug();
}
