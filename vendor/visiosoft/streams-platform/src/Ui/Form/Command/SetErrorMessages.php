<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;

/**
 * Class SetErrorMessages
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetErrorMessages
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SetErrorMessages instance.
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
     * @param Request $request
     * @param MessageBag $messages
     */
    public function handle(Request $request, MessageBag $messages)
    {
        if ($this->builder->isAjax()) {
            return;
        }

        $errors = $this->builder->getFormErrors();

        $messages->error($errors->all());

        if ($request->segment(1) == 'admin' && ($stream = $this->builder->getFormStream()) && $stream->isTrashable()) {

            /* @var AssignmentInterface $assignment */
            foreach ($stream->getUniqueAssignments() as $assignment) {
                if ($this->builder->hasFormError($assignment->getFieldSlug())) {
                    $messages->warning(
                        trans(
                            'streams::validation.unique_trash',
                            [
                                'attribute' => '"' . trans($assignment->getFieldName()) . '"',
                            ]
                        )
                    );
                }
            }
        }
    }
}
