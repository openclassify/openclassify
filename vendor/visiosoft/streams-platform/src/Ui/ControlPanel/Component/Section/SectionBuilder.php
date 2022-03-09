<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section;

use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class SectionBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SectionBuilder
{

    /**
     * The section input.
     *
     * @var SectionInput
     */
    protected $input;

    /**
     * The section factory.
     *
     * @var SectionFactory
     */
    protected $factory;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new SectionBuilder instance.
     *
     * @param SectionInput   $input
     * @param SectionFactory $factory
     * @param Authorizer     $authorizer
     */
    public function __construct(SectionInput $input, SectionFactory $factory, Authorizer $authorizer)
    {
        $this->input      = $input;
        $this->factory    = $factory;
        $this->authorizer = $authorizer;
    }

    /**
     * Build the sections and push them to the control_panel.
     *
     * @param ControlPanelBuilder $builder
     */
    public function build(ControlPanelBuilder $builder)
    {
        $controlPanel = $builder->getControlPanel();

        $this->input->read($builder);

        foreach ($builder->getSections() as $section) {

            if (!$this->authorizer->authorize(array_get($section, 'permission'))) {
                continue;
            }

            $controlPanel->addSection($this->factory->make($section));
        }
    }
}
