<?php namespace Visiosoft\ConnectModule\Resource;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Support\Locator;

/**
 * Class ResourceAuthorizer
 *

 * @package       Visiosoft\ConnectModule\Resource
 */
class ResourceAuthorizer
{

    /**
     * The model locator.
     *
     * @var Locator
     */
    protected $locator;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new ResourceAuthorizer instance.
     *
     * @param Locator    $locator
     * @param Authorizer $authorizer
     */
    public function __construct(Locator $locator, Authorizer $authorizer)
    {
        $this->locator    = $locator;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the resource.
     *
     * @param ResourceBuilder $builder
     */
    public function authorize(ResourceBuilder $builder)
    {
        // Try the option first.
        $permission = $builder->getResourceOption('permission');

        /**
         * If the option is not set then
         * try and automate the permission.
         *
         * @var StreamInterface $stream
         */
        if (
            !$permission &&
            ($stream = $builder->getResourceStream()) &&
            ($namespace = $this->locator->locate($stream->getEntryModel()))
        ) {
            $permission = $namespace . '::' . $stream->getSlug() . '.read';
        }

        if (!$builder->getOption('read') and !$this->authorizer->authorize($permission)) {
            abort(403);
        }
    }
}
