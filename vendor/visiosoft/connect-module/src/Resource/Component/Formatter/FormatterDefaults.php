<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class FormatterDefaults
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter
 */
class FormatterDefaults
{

    /**
     * Default the form actions when none are defined.
     *
     * @param ResourceBuilder $builder
     */
    public function defaults(ResourceBuilder $builder)
    {
        if ($builder->getFormatters() === [] && $stream = $builder->getResourceStream()) {
            // Don't know.
        }
    }
}
