<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SaveForm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SaveForm
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SaveForm instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        // We can't save if there is no repository.
        if (!$repository = $this->builder->getRepository()) {
            return;
        }

        $this->builder->fire('saving', ['builder' => $this->builder]);
        $this->builder->fireFieldEvents('form_saving');

        $repository->save($this->builder);

        $this->builder->fire('saved', ['builder' => $this->builder]);
        $this->builder->fireFieldEvents('form_saved');

        event(new FormWasSaved($this->builder));
    }
}
