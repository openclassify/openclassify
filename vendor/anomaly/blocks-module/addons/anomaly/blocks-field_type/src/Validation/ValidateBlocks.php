<?php namespace Anomaly\BlocksFieldType\Validation;

use Anomaly\BlocksFieldType\Command\GetMultiformFromPost;
use Anomaly\BlocksFieldType\BlocksFieldType;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ValidateBlocks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateBlocks
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param BlocksFieldType $fieldType
     * @return bool
     */
    public function handle(BlocksFieldType $fieldType)
    {
        /* @var MultipleFormBuilder $forms */
        if (!$forms = $this->dispatch(new GetMultiformFromPost($fieldType))) {
            return true;
        }

        $forms
            ->build()
            ->validate();

        if (!$forms->getFormErrors()->isEmpty()) {
            return false;
        }

        return true;
    }
}
