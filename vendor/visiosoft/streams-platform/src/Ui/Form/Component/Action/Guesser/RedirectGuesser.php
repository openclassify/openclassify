<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;

/**
 * Class RedirectGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * Guess some some form action parameters.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $actions = $builder->getActions();

        $section = $this->sections->active();

        reset($actions);

        $first = key($actions);

        /**
         * Remove any system / protected query
         * string based flags for the redirect.
         */
        parse_str($this->request->getQueryString(), $query);
        array_pull($query, 'version');
        array_pull($query, 'versionable');

        if ($query = http_build_query($query)) {
            $query = '?' . $query;
        }

        foreach ($actions as $key => &$action) {

            /*
             * If we already have an
             * HREF then skip it.
             */
            if (isset($action['redirect'])) {
                continue;
            }

            /*
             * If this is the first action and the
             * form builder has a redirect option
             * then use it for the action redirect.
             */
            if ($key == $first && $redirect = $builder->getOption('redirect')) {
                $action['redirect'] = $redirect;

                continue;
            }

            /*
             * If we're not in admin then just assume we
             * need to head back to the form. No redirect
             * will redirect back in this case.
             */
            if ($this->request->segment(1) !== 'admin') {
                continue;
            }

            // Determine the HREF based on the action type.
            switch (array_get($action, 'action')) {

                case 'submit':
                case 'save_exit':
                    $action['redirect'] = $section ? $section->getHref() : $this->request->url() . $query;
                    break;

                case 'save_create':
                    $action['redirect'] = $this->request->url() . $query;
                    break;

                case 'save':
                case 'update':
                case 'save_edit':
                case 'save_continue':
                    $action['redirect'] = function () use ($section, $builder, $query) {
                        if ($section && $builder->getFormMode() == 'create') {
                            return $section->getHref('edit/' . $builder->getContextualId());
                        }

                        return $this->request->url() . $query;
                    };
                    break;

                case 'save_edit_next':
                    $ids = array_filter(explode(',', $builder->getRequestValue('edit_next')));

                    if (!$ids) {
                        $action['redirect'] = $section ? $section->getHref() : $this->request->url() . $query;
                    } elseif (count($ids) == 1) {
                        $action['redirect'] = $section ? $section->getHref(
                            'edit/' . array_shift($ids)
                        ) : $this->request->url() . $query;
                    } else {
                        $action['redirect'] = $section ? $section->getHref(
                            'edit/' . array_shift($ids) . '?' . $builder->getOption('prefix') . 'edit_next=' . implode(
                                ',',
                                $ids
                            )
                        ) : $this->request->url() . $query;
                    }
                    break;
            }
        }

        $builder->setActions($actions);
    }
}
