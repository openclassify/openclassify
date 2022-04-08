<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Anomaly\Streams\Platform\Support\Presenter;

/**
 * Class AddonFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonFieldTypeModifier extends FieldTypeModifier
{

    /**
     * The addon collection.E
     *
     * @var AddonCollection
     */
    private $addons;

    /**
     * Create a new AddonFieldTypeModifier
     *
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
    }

    /**
     * Modify the value.
     *
     * @param  $value
     * @return mixed
     */
    public function modify($value)
    {
        if ($value instanceof Presenter) {
            $value = $value->getObject();
        }

        if ($value instanceof Addon) {
            $value = $value->getNamespace();
        }

        return $value;
    }

    /**
     * Restore the value.
     *
     * @param  $value
     * @return null|Addon
     */
    public function restore($value)
    {
        if ($value instanceof Addon) {
            return $value;
        }

        if ($value && $addon = $this->addons->get($value)) {
            return $addon;
        }

        return null;
    }
}
