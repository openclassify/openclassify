<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\DisabledGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\InstructionsGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\LabelsGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\PlaceholdersGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\PrefixesGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\RequiredGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\TranslatableGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser\UniqueGuesser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class HeadingGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldGuesser
{

    /**
     * The labels guesser.
     *
     * @var LabelsGuesser
     */
    protected $labels;

    /**
     * The unique guesser.
     *
     * @var UniqueGuesser
     */
    protected $unique;

    /**
     * The prefixes guesser.
     *
     * @var PrefixesGuesser
     */
    protected $prefixes;

    /**
     * The required guesser.
     *
     * @var RequiredGuesser
     */
    protected $required;

    /**
     * The disabled guesser.
     *
     * @var DisabledGuesser
     */
    protected $disabled;

    /**
     * The translatable guesser.
     *
     * @var TranslatableGuesser
     */
    protected $translatable;

    /**
     * The instructions guesser.
     *
     * @var InstructionsGuesser
     */
    protected $instructions;

    /**
     * The placeholders guesser.
     *
     * @var PlaceholdersGuesser
     */
    protected $placeholders;

    /**
     * Create a new HeadingGuesser instance.
     *
     * @param LabelsGuesser       $labels
     * @param UniqueGuesser       $unique
     * @param PrefixesGuesser     $prefixes
     * @param RequiredGuesser     $required
     * @param DisabledGuesser     $disabled
     * @param TranslatableGuesser $translatable
     * @param InstructionsGuesser $instructions
     * @param PlaceholdersGuesser $placeholders
     */
    public function __construct(
        LabelsGuesser $labels,
        UniqueGuesser $unique,
        PrefixesGuesser $prefixes,
        RequiredGuesser $required,
        DisabledGuesser $disabled,
        TranslatableGuesser $translatable,
        InstructionsGuesser $instructions,
        PlaceholdersGuesser $placeholders
    ) {
        $this->labels       = $labels;
        $this->unique       = $unique;
        $this->prefixes     = $prefixes;
        $this->required     = $required;
        $this->disabled     = $disabled;
        $this->translatable = $translatable;
        $this->instructions = $instructions;
        $this->placeholders = $placeholders;
    }

    /**
     * Guess field input.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $this->labels->guess($builder);
        $this->unique->guess($builder);
        $this->prefixes->guess($builder);
        $this->required->guess($builder);
        $this->disabled->guess($builder);
        $this->translatable->guess($builder);
        $this->instructions->guess($builder);
        $this->placeholders->guess($builder);
    }
}
