<?php

namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Illuminate\Support\Str;
use Anomaly\Streams\Platform\Ui\Form\FormRules;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormHandler;
use Anomaly\Streams\Platform\Ui\Form\FormValidator;

/**
 * Class SetDefaultParameters
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetDefaultParameters
{

    /**
     * Skip these.
     *
     * @var array
     */
    protected $skips = [
        'model',
        'repository',
    ];

    /**
     * Default properties.
     *
     * @var array
     */
    protected $defaults = [
        'handler'   => FormHandler::class,
        'validator' => FormValidator::class,
    ];

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormColumnsCommand instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Set the form model object from the builder's model.
     *
     * @param SetDefaultParameters $command
     */
    public function handle()
    {
        /*
         * Set the form mode according
         * to the builder's entry.
         */
        if (!$this->builder->getFormMode()) {
            $this->builder->setFormMode(
                ($this->builder->getFormEntryId() || $this->builder->getEntry()) ? 'edit' : 'create'
            );
        }

        /*
         * Next we'll loop each property and look for a handler.
         */
        $reflection = new \ReflectionClass($this->builder);

        // Stash this for later.
        $builder = get_class($this->builder);

        /* @var \ReflectionProperty $property */
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PROTECTED) as $property) {

            if (in_array($property->getName(), $this->skips)) {
                continue;
            }

            /*
             * If there is no getter then skip it.
             */
            if (!method_exists($this->builder, $method = 'get' . ucfirst($property->getName()))) {
                continue;
            }

            /*
             * If the parameter already
             * has a value then skip it.
             */
            if ($this->builder->{$method}()) {
                continue;
            }

            /*
             * Check if we can transform the
             * builder property into a handler.
             * If it exists, then go ahead and use it.
             */
            $handler = str_replace('FormBuilder', 'Form' . ucfirst($property->getName()), $builder);

            if ($handler !== $builder && class_exists($handler)) {

                /*
                 * Make sure the handler is
                 * formatted properly.
                 */
                if (!Str::contains($handler, '@')) {
                    $handler .= '@handle';
                }

                /**
                 * We have to make a special case
                 * for form rules since we have
                 * a service named the same.
                 */
                if ($property->getName() == 'rules' && $handler == FormRules::class . '@handle') {
                    continue;
                }

                $this->builder->{'set' . ucfirst($property->getName())}($handler);

                continue;
            }

            /*
             * If the handler does not exist and
             * we have a default handler, use it.
             */
            if ($default = array_get($this->defaults, $property->getName())) {
                $this->builder->{'set' . ucfirst($property->getName())}($default);
            }
        }
    }
}
