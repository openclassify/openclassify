<?php namespace Anomaly\RedirectsModule\Domain\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface DomainInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface DomainInterface extends EntryInterface
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
