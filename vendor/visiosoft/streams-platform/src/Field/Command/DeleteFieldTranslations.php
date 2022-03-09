<?php namespace Anomaly\Streams\Platform\Field\Command;

use Anomaly\Streams\Platform\Field\Contract\FieldInterface;

/**
 * Class DeleteFieldTranslations
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteFieldTranslations
{

    /**
     * The field instance.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * Create a new DeleteFieldTranslations instance.
     *
     * @param FieldInterface $field
     */
    public function __construct(FieldInterface $field)
    {
        $this->field = $field;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        foreach ($this->field->getTranslations() as $translation) {
            $translation->delete();
        }
    }
}
