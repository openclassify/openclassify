<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Model\Traits\Versionable;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class HandleVersioning
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HandleVersioning
{

    use DispatchesJobs;

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new HandleVersioning instance.
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
     * @param MessageBag $messages
     */
    public function handle(MessageBag $messages)
    {
        /**
         * If we can't save, there are
         * errors, or no model then skip.
         */
        if (
            $this->builder instanceof MultipleFormBuilder
            || $this->builder->hasFormErrors()
            || !$this->builder->canSave()
            || !$this->builder->getFormEntry()
            || !$this->builder->versioningEnabled()
        ) {
            return;
        }

        /* @var EntryModel|EloquentModel $entry */
        if (!is_object($entry = $this->builder->getFormEntry())) {
            return;
        }

        /**
         * Now that the model has finished
         * post-processing we can version.
         */
        if (
            in_array(Versionable::class, class_uses_recursive($entry)) &&
            !$entry->versioningDisabled() &&
            $entry->isVersionable()
        ) {
            $entry->unguard();

            // try {
            //     $entry->version();
            // } catch (\Exception $exception) {
            //     $messages->error('Versioning failed: ' . $exception->getMessage());
            // }

            $entry->version();

            $entry->reguard();
        }
    }
}
