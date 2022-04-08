<?php namespace Anomaly\RedirectsModule\Domain;

use Anomaly\RedirectsModule\Domain\Contract\DomainInterface;
use Anomaly\Streams\Platform\Model\Redirects\RedirectsDomainsEntryModel;

/**
 * Class DomainModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DomainModel extends RedirectsDomainsEntryModel implements DomainInterface
{

    /**
     * Get the redirect from matcher.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get the redirect to path.
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Get the redirect status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Return whether the redirect is secure or not.
     *
     * @return bool
     */
    public function isSecure()
    {
        return $this->secure;
    }

}
