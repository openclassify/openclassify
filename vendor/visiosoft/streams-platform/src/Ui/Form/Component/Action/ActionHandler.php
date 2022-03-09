<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Session\Store;

/**
 * Class ActionHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionHandler
{

    /**
     * The parser utility.
     *
     * @var Parser
     */
    protected $parser;

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The redirector utility.
     *
     * @var Redirector
     */
    protected $redirector;

    /**
     * Create a new ActionHandler instance.
     *
     * @param Parser $parser
     * @param Store $session
     * @param Request $request
     * @param Redirector $redirector
     */
    public function __construct(Parser $parser, Store $session, Request $request, Redirector $redirector)
    {
        $this->parser     = $parser;
        $this->session    = $session;
        $this->request    = $request;
        $this->redirector = $redirector;
    }

    /**
     * Handle the form response.
     *
     * @param FormBuilder $builder
     */
    public function handle(FormBuilder $builder)
    {
        /*
         * If the form already has a response
         * then we're being overridden. Abort!
         */
        if ($builder->getFormResponse()) {
            return;
        }

        /**
         * If a redirect is undesired then
         * skip this step all together.
         */
        if ($builder->getFormOption('redirect') === false) {
            return;
        }

        $entry   = $builder->getFormEntry();
        $actions = $builder->getFormActions();

        $action = $actions->active();

        if ($entry && $entry instanceof Arrayable) {
            $entry = $entry->toArray();
        }

        $redirect = $action->getRedirect();

        if ($redirect instanceof RedirectResponse) {
            $builder->setFormResponse($redirect);

            return;
        }

        if ($redirect === false) {
            return;
        }

        $redirect = $this->parser->parse($redirect, compact('entry'));

        /*
         * If the redirect is null then use the current one.
         */
        if ($redirect === null) {
            $redirect = $this->redirector->back()->getTargetUrl();
        }

        /*
         * If the URL is a closure then call it.
         */
        if ($redirect instanceof \Closure) {
            $redirect = app()->call($redirect, compact('builder'));
        }

        /*
         * Restore the query string prior if
         * we're coming from a table.
         *
         * Do not manipulate versionable workflow.
         */
        if (($query = $this->session->get('table::' . $redirect)) && !strpos($query, 'versionable')) {
            $redirect = strpos($redirect, '?') ? $redirect . '&' . $query : $redirect . '?' . $query;
        }

        $builder->setFormResponse($this->redirector->to($redirect));
    }
}
