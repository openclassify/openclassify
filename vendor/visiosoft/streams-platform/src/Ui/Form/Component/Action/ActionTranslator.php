<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Support\Translator;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class ActionTranslator
{

    /**
     * The translator utility.
     *
     * @var Translator
     */
    protected $translator;

    /**
     * Create a new ActionTranslator instance.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Translate the actions.
     *
     * @param FormBuilder $builder
     */
    public function translate(FormBuilder $builder)
    {
        $builder->setActions($this->translator->translate($builder->getActions()));
    }
}
