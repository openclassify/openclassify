<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Entry\EntryFormRepository;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\EloquentFormRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class SetRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetRepository
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SetRepository instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        /*
         * Set the default options handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$this->builder->getRepository()) {
            $model = $this->builder->getFormModel();
            $entry = $this->builder->getEntry();
            $form  = $this->builder->getForm();

            $repository = str_replace('FormBuilder', 'FormRepository', get_class($this->builder));

            if (!$this->builder->getRepository() && class_exists($repository)) {
                $this->builder->setRepository($container->make($repository, compact('form', 'model')));
            } elseif (!$this->builder->getRepository() && $model instanceof EntryModel) {
                $this->builder->setRepository(
                    $container->make(EntryFormRepository::class, compact('form', 'model'))
                );
            } elseif (!$this->builder->getRepository() && $model instanceof EloquentModel) {
                $this->builder->setRepository(
                    $container->make(EloquentFormRepository::class, compact('form', 'model'))
                );
            } elseif (!$this->builder->getRepository() && $entry instanceof EntryModel) {
                $this->builder->setRepository(
                    $container->make(EntryFormRepository::class, ['form' => $form, 'model' => $entry])
                );
            } elseif (!$this->builder->getRepository() && $entry instanceof EloquentModel) {
                $this->builder->setRepository(
                    $container->make(EloquentFormRepository::class, ['form' => $form, 'model' => $entry])
                );
            }
        }
    }
}
