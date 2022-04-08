<?php

namespace Anomaly\Streams\Platform\View\Command;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\Factory;

/**
 * Class GetLayoutName
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetLayoutName
{

    /**
     * The layout name.
     *
     * @var string
     */
    protected $layout;

    /**
     * The default layout name.
     *
     * @var string
     */
    protected $default;

    /**
     * Create a new GetLayoutName instance.
     *
     * @param string $default
     * @param string $layout
     */
    public function __construct($layout, $default = 'default')
    {
        $this->layout  = $layout;
        $this->default = $default;
    }

    /**
     * Handle the command.
     *
     * @param Factory $view
     * @return string
     */
    public function handle(Factory $view)
    {
        if (Str::contains($this->layout, '::')) {
            return $this->layout;
        }

        if ($view->exists($layout = "theme::layouts/{$this->layout}")) {
            return $layout;
        }

        return Str::contains($this->default, '::') ? $this->default : "theme::layouts/{$this->default}";
    }
}
