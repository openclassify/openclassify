<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Section;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

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
     * The section input reader.
     *
     * @var SectionInput
     */
    protected $input;

    /**
     * Create a new SectionBuilder instance.
     *
     * @param SectionInput $input
     */
    public function __construct(SectionInput $input)
    {
        $this->input = $input;
    }

    /**
     * Build the sections.
     *
     * @param FormBuilder $builder
     */
    public function build(FormBuilder $builder)
    {
        $this->input->read($builder);

        foreach ($builder->getSections() as $slug => $section) {
            $builder->addFormSection($slug, $section);
        }
    }
}
