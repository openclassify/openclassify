<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SetSuccessMessage
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetSuccessMessage
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetSuccessMessage instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle(MessageBag $messages)
    {
        // If we can't save or there are errors then skip it.
        if ($this->builder->hasEntityErrors() || !$this->builder->canSave()) {
            return;
        }

        // If there is no model and there isn't anything specific to say, skip it.
        if (!$this->builder->getEntityEntry() && !$this->builder->getEntityOption('success_message')) {
            return;
        }

        $mode = $this->builder->getEntityMode();

        // False means no message is desired.
        if ($this->builder->getEntityOption('success_message') === false) {
            return;
        }

        $entry  = $this->builder->getEntityEntry();
        $stream = $this->builder->getEntityStream();

        $parameters = [
            'title' => is_object($entry) ? $entry->getTitle() : null,
            'name'  => is_object($stream) ? $stream->getName() : null,
        ];

        // If the name doesn't exist we need to be clever.
        if (str_contains($parameters['name'], '::') && !trans()->has($parameters['name']) && $stream) {
            $parameters['name'] = ucfirst(str_singular(str_replace('_', ' ', $stream->getSlug())));
        } elseif ($parameters['name']) {
            $parameters['name'] = str_singular(trans($parameters['name']));
        } else {
            $parameters['name'] = trans('streams::entry.name');
        }

        /**
         * Use the option success message.
         */
        if ($this->builder->getEntityOption('success_message') !== null) {
            $this->builder->setEntityOption(
                'success_message',
                trans('streams::message.' . $mode . '_success', $parameters)
            );
        }

        /**
         * Set the default success message.
         */
        if ($this->builder->getEntityOption('success_message') === null) {
            $this->builder->setEntityOption(
                'success_message',
                trans('streams::message.' . $mode . '_success', $parameters)
            );
        }

        $messages->success($this->builder->getEntityOption('success_message'));
    }
}
