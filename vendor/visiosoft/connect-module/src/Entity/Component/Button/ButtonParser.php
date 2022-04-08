<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonParser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button
 */
class ButtonParser
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

        $builder->setButtons($this->parser->parse($builder->getButtons(), compact('entry')));
    }
}
