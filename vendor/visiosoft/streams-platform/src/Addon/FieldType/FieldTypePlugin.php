<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class FieldTypePlugin
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypePlugin extends Plugin
{

    /**
     * The plugin functions.
     *
     * @var FieldTypePluginFunctions
     */
    protected $functions;

    /**
     * Create a new FieldTypePlugin instance.
     *
     * @param FieldTypePluginFunctions $functions
     */
    public function __construct(FieldTypePluginFunctions $functions)
    {
        $this->functions = $functions;
    }

    /**
     * Get plugin functions.
     *
     * @return array|void
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('field_group', [$this->functions, 'fieldGroup']),
        ];
    }
}
