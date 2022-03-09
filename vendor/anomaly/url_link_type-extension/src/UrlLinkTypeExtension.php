<?php namespace Anomaly\UrlLinkTypeExtension;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Type\Contract\LinkTypeInterface;
use Anomaly\NavigationModule\Link\Type\LinkTypeExtension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UrlLinkTypeExtension\Command\GetUrl;
use Anomaly\UrlLinkTypeExtension\Form\UrlLinkTypeFormBuilder;

/**
 * Class UrlLinkTypeExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UrlLinkTypeExtension extends LinkTypeExtension implements LinkTypeInterface
{

    /**
     * This extension provides the URL
     * link type for the Navigation module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.navigation::link_type.url';

    /**
     * Return the entry URL.
     *
     * @param  LinkInterface $link
     * @return string
     */
    public function url(LinkInterface $link)
    {
        return url($this->dispatch(new GetUrl($link->getEntry())));
    }

    /**
     * Return the entry title.
     *
     * @param  LinkInterface $link
     * @return string
     */
    public function title(LinkInterface $link)
    {
        return $link->getEntry()->getTitle();
    }

    /**
     * Return the form builder for
     * the link type entry.
     *
     * @return FormBuilder
     */
    public function builder()
    {
        return app(UrlLinkTypeFormBuilder::class);
    }
}
