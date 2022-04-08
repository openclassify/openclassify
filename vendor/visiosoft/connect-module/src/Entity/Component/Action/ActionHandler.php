<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class ActionHandler
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
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
     * @param Parser     $parser
     * @param Request    $request
     * @param Redirector $redirector
     */
    public function __construct(Parser $parser, Request $request, Redirector $redirector)
    {
        $this->parser     = $parser;
        $this->request    = $request;
        $this->redirector = $redirector;
    }

    /**
     * Handle the entity response.
     *
     * @param EntityBuilder $builder
     */
    public function handle(EntityBuilder $builder)
    {
        /**
         * If the entity already has a response
         * then we're being overridden. Abort!
         */
        if ($builder->getEntityResponse()) {
            return;
        }

        $entry   = $builder->getEntityEntry();
        $actions = $builder->getEntityActions();

        $action = $actions->active();

        if ($entry && $entry instanceof Arrayable) {
            $entry = $entry->toArray();
        }

        // Get the redirect from the entity first.
        $url = $builder->getEntityOption('redirect');

        if ($url === null) {
            $url = $action->getRedirect();
        }

        if ($url === false) {
            return;
        }

        $url = $this->parser->parse($url, compact('entry'));

        /**
         * If the URL is null then use the current one.
         */
        if ($url === null) {
            $url = $this->request->fullUrl();
        }

        /**
         * If the URL is a closure then call it.
         */
        if ($url instanceof \Closure) {
            $url = app()->call($url, compact('builder'));
        }

        $builder->setEntityResponse($this->redirector->to($url));
    }
}
