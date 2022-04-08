<?php namespace Anomaly\RedirectsModule\Redirect\Contract;

/*
 * Interface RedirectInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RedirectsModule\Redirect\Contract
 */
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface RedirectInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface RedirectInterface extends EntryInterface
{

    /**
     * Get the redirect from matcher.
     *
     * @return string
     */
    public function getFrom();

    /**
     * Get the redirect to path.
     *
     * @return string
     */
    public function getTo();

    /**
     * Get the redirect status.
     *
     * @return string
     */
    public function getStatus();

    /**
     * Return the secure flag.
     *
     * @return bool
     */
    public function isSecure();
}
