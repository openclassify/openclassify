<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Section;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class SectionBuilder
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Section
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
     * @param EntityBuilder $builder
     */
    public function build(EntityBuilder $builder)
    {
        $this->input->read($builder);

        foreach ($builder->getSections() as $slug => $section) {
            $builder->addEntitySection($slug, $section);
        }
    }
}
