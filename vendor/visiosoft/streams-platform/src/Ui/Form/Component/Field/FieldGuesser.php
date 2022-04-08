<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\DisabledGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\EnabledGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\InstructionsGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\LabelsGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\PlaceholdersGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\PrefixesGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\ReadOnlyGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\RequiredGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\TranslatableGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\UniqueGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\WarningsGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser\NullableGuesser;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

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
     * The enabled guesser.
     *
     * @var EnabledGuesser
     */
    protected $enabled;

    /**
     * The warnings guesser.
     *
     * @var WarningsGuesser
     */
    protected $warnings;

    /**
     * The nullable guesser.
     *
     * @var NullableGuesser
     */
    protected $nullable;

    /**
     * The prefixes guesser.
     *
     * @var PrefixesGuesser
     */
    protected $prefixes;

    /**
     * The read only guesser.
     *
     * @var ReadOnlyGuesser
     */
    protected $readOnly;

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
     * @param EnabledGuesser      $enabled
     * @param WarningsGuesser     $warnings
     * @param NullableGuesser     $nullable
     * @param PrefixesGuesser     $prefixes
     * @param RequiredGuesser     $required
     * @param DisabledGuesser     $disabled
     * @param ReadOnlyGuesser     $readOnly
     * @param TranslatableGuesser $translatable
     * @param InstructionsGuesser $instructions
     * @param PlaceholdersGuesser $placeholders
     */
    public function __construct(
        LabelsGuesser $labels,
        UniqueGuesser $unique,
        EnabledGuesser $enabled,
        WarningsGuesser $warnings,
        NullableGuesser $nullable,
        PrefixesGuesser $prefixes,
        RequiredGuesser $required,
        DisabledGuesser $disabled,
        ReadOnlyGuesser $readOnly,
        TranslatableGuesser $translatable,
        InstructionsGuesser $instructions,
        PlaceholdersGuesser $placeholders
    ) {
        $this->labels       = $labels;
        $this->unique       = $unique;
        $this->enabled      = $enabled;
        $this->warnings     = $warnings;
        $this->nullable     = $nullable;
        $this->prefixes     = $prefixes;
        $this->required     = $required;
        $this->disabled     = $disabled;
        $this->readOnly     = $readOnly;
        $this->translatable = $translatable;
        $this->instructions = $instructions;
        $this->placeholders = $placeholders;
    }

    /**
     * Guess field input.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $this->labels->guess($builder);
        $this->unique->guess($builder);
        $this->enabled->guess($builder);
        $this->warnings->guess($builder);
        $this->prefixes->guess($builder);
        $this->required->guess($builder);
        $this->nullable->guess($builder);
        $this->disabled->guess($builder);
        $this->readOnly->guess($builder);
        $this->translatable->guess($builder);
        $this->instructions->guess($builder);
        $this->placeholders->guess($builder);
    }
}
