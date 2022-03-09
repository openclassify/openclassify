<?php namespace Anomaly\RepeaterFieldType\Validation;

use Anomaly\RepeaterFieldType\Command\GetMultiformFromPost;
use Anomaly\RepeaterFieldType\RepeaterFieldType;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ValidateRepeater
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateRepeater
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param RepeaterFieldType $fieldType
     * @return bool
     */
    public function handle(RepeaterFieldType $fieldType)
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
