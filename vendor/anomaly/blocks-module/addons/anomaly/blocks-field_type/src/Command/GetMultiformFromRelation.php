<?php namespace Anomaly\BlocksFieldType\Command;

use Anomaly\BlocksFieldType\BlocksFieldType;
use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class GetMultiformFromRelation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetMultiformFromRelation
{

    /**
     * The field type instance.
     *
     * @var BlocksFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetMultiformFromRelation instance.
     *
     * @param BlocksFieldType $fieldType
     */
    public function __construct(BlocksFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Get the multiple form builder from the value.
     *
     * @param FieldRepositoryInterface $fields
     * @param MultipleFormBuilder $forms
     * @param Decorator $decorator
     * @return MultipleFormBuilder|null
     */
    public function handle(FieldRepositoryInterface $fields, MultipleFormBuilder $forms, Decorator $decorator)
    {
        /* @var EntryCollection $value */
        if (!$value = $decorator->undecorate($this->fieldType->getValue())) {
            return null;
        }

        $decorator = new Decorator();

        /* @var BlockInterface $entry */
        foreach ($value as $instance => $entry) {

            $entry     = $decorator->undecorate($entry);
            $extension = $decorator->undecorate($entry->extension());

            /* @var FieldInterface $field */
            if (!$field = $fields->find($this->fieldType->id())) {
                continue;
            }

            /* @var BlocksFieldType $type */
            $type = $field->getType();

            $type->setPrefix($this->fieldType->getPrefix());

            $extension->setBlock($entry);

            $form = $type->form(
                $field,
                $extension,
                $instance
            );

            if ($block = $form->getChildForm('block')) {
                $block->setEntry($entry);
            }

            /* @var ConfigurationFormBuilder $configuration */
            if ($configuration = $form->getChildForm('configuration')) {
                $configuration
                    ->setEntry($extension->getNamespace())
                    ->setScope($entry->getId());
            }

            if ($form->hasChildForm('entry')) {
                $form->setChildFormEntry('entry', $entry->getEntry());
            }

            $form
                ->setReadOnly($this->fieldType->isReadOnly())
                ->setOption('block_id', $entry->getId())
                ->setOption('block_subtitle', $entry->getTitle());

            $forms->addForm($this->fieldType->getFieldName() . '_' . $instance, $form);
        }

        $forms
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false);

        return $forms;
    }
}
