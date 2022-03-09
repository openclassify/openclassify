<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldParser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldParser
{

    /**
     * The parser instance.
     *
     * @var Parser
     */
    protected $parser;

    /**
     * Create a new FieldParser instance.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Parse the entity fields.
     *
     * @param EntityBuilder $builder
     */
    public function parse(EntityBuilder $builder)
    {
        $entry = $builder->getEntityEntry();

        $builder->setFields($this->parser->parse($builder->getFields(), compact('entry')));
    }
}
