<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Guesser;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Http\Request;

/**
 * Class RedirectGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Guesser
 */
class RedirectGuesser
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new RedirectGuesser instance.
     *
     * @param Request           $request
     * @param SectionCollection $sections
     */
    public function __construct(Request $request, SectionCollection $sections)
    {
        $this->request  = $request;
        $this->sections = $sections;
    }

    /**
     * Guess some some entity action parameters.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $actions = $builder->getActions();

        // Nothing to do if empty.
        if (!$section = $this->sections->active()) {
            return;
        }

        foreach ($actions as &$action) {

            // If we already have an HREF then skip it.
            if (isset($action['redirect'])) {
                return;
            }

            // Determine the HREF based on the action type.
            switch (array_get($action, 'action')) {

                case 'save':
                    $action['redirect'] = $section->getHref();
                    break;

                case 'save_and_edit':
                case 'save_and_continue':
                    $action['redirect'] = $section->getHref('edit/{request.route.parameters.id}');
                    break;

                case 'save_and_edit_next':
                    $ids = array_filter(explode(',', $builder->getRequestValue('edit_next')));

                    if (!$ids) {
                        $action['redirect'] = $section->getHref();
                    } elseif (count($ids) == 1) {
                        $action['redirect'] = $section->getHref('edit/' . array_shift($ids));
                    } else {
                        $action['redirect'] = $section->getHref(
                            'edit/' . array_shift($ids) . '?' . $builder->getOption('prefix') . 'edit_next=' . implode(
                                ',',
                                $ids
                            )
                        );
                    }
                    break;
            }
        }

        $builder->setActions($actions);
    }
}
