<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SetFormEntry
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetFormEntry
{

    /**
     * The form builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Form\FormBuilder
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
     * @param Decorator $decorator
     */
    public function handle(Decorator $decorator)
    {
        $this->builder->fire('setting_entry', ['builder' => $this->builder]);

        if ($this->builder->getFormEntry()) {
            return;
        }

        $entry      = $this->builder->getEntry();
        $repository = $this->builder->getRepository();

        /**
         * Undecorate the entry in case it's coming
         * in case the system has been through the
         * view layer and has decorated already.
         */
        $entry = $decorator->undecorate($entry);

        /*
         * If the entry is null or an ID and the
         * model is an instance of FormModelInterface
         * then use the model to fetch the entry
         * or create a new one.
         */
        if (is_numeric($entry) || $entry === null) {
            if ($repository instanceof FormRepositoryInterface) {

                $this->builder->setFormEntry($entry = $repository->findOrNew($entry));

                $this->builder->fire('entry_set', ['builder' => $this->builder, 'entry' => $entry]);

                return;
            }
        }

        /*
         * If the entry is a plain 'ole
         * object  then just use it as is.
         */
        if (is_object($entry)) {

            $this->builder->setFormEntry($entry);

            $this->builder->fire('entry_set', ['builder' => $this->builder, 'entry' => $entry]);

            return;
        }

        /*
         * Whatever it is - just use it.
         */
        $this->builder->setFormEntry($entry);

        $this->builder->fire('entry_set', ['builder' => $this->builder, 'entry' => $entry]);
    }
}
