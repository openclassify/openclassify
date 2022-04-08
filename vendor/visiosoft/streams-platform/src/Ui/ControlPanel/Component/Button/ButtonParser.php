<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Http\Request;

/**
 * Class ButtonParser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new ButtonParser instance.
     *
     * @param Parser  $parser
     * @param Request $request
     */
    public function __construct(Parser $parser, Request $request)
    {
        $this->parser  = $parser;
        $this->request = $request;
    }

    /**
     * Parse the control panel buttons.
     *
     * @param ControlPanelBuilder $builder
     */
    public function parse(ControlPanelBuilder $builder)
    {
        $parameters = $this->request->route()->parameters();

        $builder->setButtons($this->parser->parse($builder->getButtons(), compact('parameters')));
    }
}
