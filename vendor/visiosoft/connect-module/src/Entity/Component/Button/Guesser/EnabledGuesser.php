<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button\Guesser;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Http\Request;

/**
 * Class EnabledGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button\Guesser
 */
class EnabledGuesser
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new EnabledGuesser instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Guess the HREF for a button.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $buttons = $builder->getButtons();
        $mode    = $builder->getEntityMode();

        foreach ($buttons as &$button) {

            if (isset($button['enabled']) && is_bool($button['enabled'])) {
                return;
            }

            switch (array_get($button, 'button')) {

                case 'delete':
                    $button['enabled'] = ($mode === 'edit');
                    break;
            }
        }

        $builder->setButtons($buttons);
    }
}
