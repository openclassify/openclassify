<?php namespace Visiosoft\StyleSelectorModule\Provider\Command;

use Visiosoft\StyleSelectorModule\Provider\ProviderExtension;
use Anomaly\Streams\Platform\Addon\AddonPresenter;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class GetProviderExtension
 *
 * @link   http://visiosoft.com.tr/
 * @author Visiosoft, Inc. <support@visiosoft.com.tr>
 * @author Vedat Akdoğan <vedat@visiosoft.com.tr>
 */
class GetProviderExtension
{

    /**
     * The provider identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetProviderExtension instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param ExtensionCollection $extensions
     * @return ProviderExtension|Extension|null
     */
    public function handle(ExtensionCollection $extensions)
    {
        if (is_string($this->identifier) && str_is('*.*.*::provider.*', $this->identifier)) {
            return $extensions->find($this->identifier);
        }

        if (is_string($this->identifier) && str_is('*.*.*', $this->identifier)) {
            return $extensions->get($this->identifier);
        }

        if (is_string($this->identifier) && !strpos($this->identifier, '.')) {
            return $extensions->find('visiosoft.module.social::provider.' . $this->identifier);
        }

        if ($this->identifier instanceof AddonPresenter) {
            $this->identifier = $this->identifier->getObject();
        }

        if ($this->identifier instanceof ProviderExtension) {
            return $this->identifier;
        }

        return null;
    }
}
