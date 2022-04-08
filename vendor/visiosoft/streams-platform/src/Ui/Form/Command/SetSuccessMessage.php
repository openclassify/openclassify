<?php

namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SetSuccessMessage
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetSuccessMessage
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SetSuccessMessage instance.
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
     * @param Request    $request
     * @param MessageBag $messages
     */
    public function handle(Request $request, MessageBag $messages)
    {

        // If we can't save or there are errors then skip it.
        if ($this->builder->hasFormErrors() || !$this->builder->canSave()) {
            return;
        }

        $mode = $this->builder->getFormMode();

        // False means no message is desired.
        if ($this->builder->getFormOption('success_message') === false) {
            return;
        }

        $entry  = $this->builder->getFormEntry();
        $stream = $this->builder->getFormStream();

        $parameters = [
            'title' => is_object($entry) ? $entry->getTitle() : null,
            'name'  => is_object($stream) ? $stream->getName() : null,
        ];

        // If the name doesn't exist we need to be clever.
        if (Str::contains($parameters['name'], '::') && !trans()->has($parameters['name']) && $stream) {
            $parameters['name'] = ucfirst(Str::singular(str_replace('_', ' ', $stream->getSlug())));
        } elseif ($parameters['name']) {
            $parameters['name'] = Str::singular(trans($parameters['name']));
        } else {
            $parameters['name'] = trans('streams::entry.name');
        }

        /**
         * If there is no success message and
         * we are not in the control panel
         * then we don't want to force it.
         */
        if ($request->segment(1) !== 'admin' && $this->builder->getFormOption('success_message') === null) {
            return;
        }

        /*
         * Set the default success message.
         */
        if ($this->builder->getFormOption('success_message') === null) {
            $this->builder->setFormOption(
                'success_message',
                trans('streams::message.' . $mode . '_success', $parameters)
            );
        }

        $messages->{$this->builder->getFormOption('success_message_type', 'success')}(
            $this->builder->getFormOption('success_message')
        );
    }
}
