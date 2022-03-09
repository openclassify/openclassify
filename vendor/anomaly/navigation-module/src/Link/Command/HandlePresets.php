<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class HandlePresets
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class HandlePresets
{

    use DispatchesJobs;

    /**
     * The options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new HandlePresets instance.
     *
     * @param Collection $options
     */
    public function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        switch ($this->options->get('preset')) {

            case 'bootstrap':

                $this->options->put('list_class', $this->options->get('list_class', 'nav navbar-nav'));
                $this->options->put('child_list_class', $this->options->get('child_list_class', 'dropdown-menu'));
                $this->options->put('link_class_dropdown', $this->options->get('link_class_dropdown', 'dropdown'));

                $this->options->put(
                    'link_attributes_dropdown',
                    $this->options->get('link_attributes_dropdown', ['data-toggle' => 'dropdown'])
                );

                break;

            default:
                break;
        }
    }
}
