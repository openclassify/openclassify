<?php namespace Anomaly\PagesModule;

use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;

/**
 * Class PagesModuleCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesModuleCriteria extends PluginCriteria
{

    /**
     * Set options for Bootstrap 4
     *
     * @return $this
     */
    public function bootstrap4()
    {
        $this->options['link_attributes_dropdown'] = ['data-toggle' => 'dropdown'];
        $this->options['child_list_class']         = 'dropdown-menu';
        $this->options['child_link_class']         = 'dropdown-item';
        $this->options['item_class']               = 'nav-item';
        $this->options['link_class']               = 'nav-link';
        $this->options['list_class']               = 'nav';
        $this->options['child_item_class']         = '';

        return $this;
    }

    /**
     * Set options for Bootstrap 3
     *
     * @return $this
     */
    public function bootstrap3()
    {
        $this->options['link_attributes_dropdown'] = ['data-toggle' => 'dropdown'];
        $this->options['child_list_class']         = 'dropdown-menu';
        $this->options['list_class']               = 'nav';

        return $this;
    }

}
