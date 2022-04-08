<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Button;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Button\ButtonCollection;
use Anomaly\Streams\Platform\Ui\Button\ButtonFactory;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ButtonBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonBuilder
{

    /**
     * The button reader.
     *
     * @var ButtonInput
     */
    protected $input;

    /**
     * The button value utility.
     *
     * @var ButtonValue
     */
    protected $value;

    /**
     * The button parser.
     *
     * @var ButtonParser
     */
    protected $parser;

    /**
     * The button factory.
     *
     * @var ButtonFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new ButtonBuilder instance.
     *
     * @param ButtonInput $input
     * @param ButtonValue $value
     * @param ButtonParser $parser
     * @param ButtonFactory $factory
     * @param Evaluator $evaluator
     */
    public function __construct(
        ButtonInput $input,
        ButtonValue $value,
        ButtonParser $parser,
        ButtonFactory $factory,
        Evaluator $evaluator
    ) {
        $this->input     = $input;
        $this->value     = $value;
        $this->parser    = $parser;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the buttons.
     *
     * @param  TableBuilder $builder
     * @param                   $entry
     * @return ButtonCollection
     */
    public function build(TableBuilder $builder, $entry)
    {
        $table = $builder->getTable();

        $buttons = new ButtonCollection();

        $this->input->read($builder);

        foreach ($builder->getButtons() as $button) {
            array_set($button, 'entry', $entry);

            $button = $this->evaluator->evaluate($button, compact('entry', 'table'));
            $button = $this->parser->parse($button, $entry);
            $button = $this->value->replace($button, $entry);
            $button = $this->factory->make($button);

            if (!$button->isEnabled()) {
                continue;
            }

            $buttons->push($button);
        }

        return $buttons;
    }
}
