<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionParser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionParser
{

    /**
     * The parser utility.
     *
     * @var Parser
     */
    protected $parser;

    /**
     * Create a new ButtonParser instance.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Parse the entity buttons.
     *
     * @param EntityBuilder $builder
     */
    public function parse(EntityBuilder $builder)
    {
        $entry = $builder->getEntityEntry();

        $builder->setActions($this->parser->parse($builder->getActions(), compact('entry')));
    }
}
