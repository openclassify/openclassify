<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\Component\Formatter\Contract\FormatterInterface;
use Anomaly\Streams\Platform\Support\Hydrator;

/**
 * Class FormatterFactory
 *

 * @package Visiosoft\ConnectModule\Resource\Component\Formatter
 */
class FormatterFactory
{

    /**
     * The default formatter class.
     *
     * @var string
     */
    protected $formatter = Formatter::class;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * Create a new FormatterFactory instance.
     *
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Make a formatter.
     *
     * @param  array $parameters
     * @return FormatterInterface
     */
    public function make(array $parameters)
    {
        $formatter = app()->make(array_get($parameters, 'formatter', $this->formatter), $parameters);

        $this->hydrator->hydrate($formatter, $parameters);

        return $formatter;
    }
}
