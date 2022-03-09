<?php namespace Anomaly\Streams\Platform\View\Event;

use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class TemplateDataIsLoading
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TemplateDataIsLoading
{

    /**
     * Create a new TemplateDataIsLoading instance.
     *
     * @param ViewTemplate $template
     */
    public function __construct(ViewTemplate $template)
    {
        $this->template = $template;
    }

    /**
     * Get the template.
     *
     * @return ViewTemplate
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
