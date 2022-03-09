<?php

namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Illuminate\Support\Str;
use Illuminate\Contracts\Container\Container;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class HandleForm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HandleForm
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new HandleForm instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        if ($this->builder->hasFormErrors()) {
            return;
        }

        $handler = $this->builder->getHandler();

        if ($handler && !Str::contains($handler, '@')) {
            $handler .= '@handle';
        }

        $container->call($handler, ['builder' => $this->builder]);
    }
}
