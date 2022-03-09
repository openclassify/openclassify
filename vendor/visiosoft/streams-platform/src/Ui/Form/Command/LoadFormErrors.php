<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Session\Store;

/**
 * Class LoadFormErrors
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadFormErrors
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new LoadFormErrors instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     */
    public function handle(Store $session)
    {
        /* @var MessageBag $errors */
        if ($errors = $session->get($this->builder->getOption('prefix') . 'errors')) {
            $this->builder->setFormErrors($errors);
        }
    }
}
