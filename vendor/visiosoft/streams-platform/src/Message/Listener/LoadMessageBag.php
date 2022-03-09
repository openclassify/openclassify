<?php namespace Anomaly\Streams\Platform\Message\Listener;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class LoadMessageBag
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadMessageBag
{

    /**
     * The view template.
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * The message bag.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * Create a new LoadBreadcrumbs instance.
     *
     * @param ViewTemplate $template
     * @param MessageBag   $messages
     */
    public function __construct(ViewTemplate $template, MessageBag $messages)
    {
        $this->template = $template;
        $this->messages = $messages;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $this->template->set('messages', $this->messages);
    }
}
