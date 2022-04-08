<?php namespace Anomaly\BlocksFieldType\Support\Config;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class BlocksHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksHandler
{

    /**
     * Handle the options.
     *
     * @param CheckboxesFieldType $fieldType
     * @param ExtensionCollection $extensions
     */
    public function handle(CheckboxesFieldType $fieldType, ExtensionCollection $extensions)
    {
        $options = [];

        /* @var BlockExtension $extension */
        foreach ($extensions->search('anomaly.module.blocks::block.*')->enabled() as $extension) {
            $options[$extension->getNamespace()] = $extension->getTitle();
        }

        ksort($options);

        $fieldType->setOptions($options);
    }
}
