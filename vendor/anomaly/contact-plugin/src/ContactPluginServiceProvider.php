<?php namespace Anomaly\ContactPlugin;

use Anomaly\ContactPlugin\Form\ContactFormBuilder;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class ContactPluginServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ContactPluginServiceProvider extends AddonServiceProvider
{

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        'contact' => ContactFormBuilder::class,
    ];
}
