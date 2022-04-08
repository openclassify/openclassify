<?php namespace Anomaly\ContactPlugin\Form\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Robbo\Presenter\Decorator;

/**
 * Class GetMessageData
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class GetMessageData
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new GetMessageData instance.
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
     * @param  Decorator $decorator
     * @param  Parser    $parser
     * @return array
     */
    public function handle(Decorator $decorator, Parser $parser)
    {
        return [
            'form' => $this->builder->getFormPresenter(),
            'fields' => $decorator->decorate($this->builder->getFormFields()),
            'subject' => $parser->parse(
                $this->builder->getOption('subject', 'Contact Request'),
                $this->builder->getFormValues()->all()
            ),
        ];
    }
}
