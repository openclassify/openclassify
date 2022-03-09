<?php

namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;

/**
 * Class LinkSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinkSeeder extends Seeder
{

    /**
     * The link repository.
     *
     * @var LinkRepositoryInterface
     */
    protected $links;

    /**
     * The menu repository.
     *
     * @var MenuRepositoryInterface
     */
    protected $menus;

    /**
     * Create a new LinkSeeder instance.
     *
     * @param LinkRepositoryInterface $links
     * @param MenuRepositoryInterface $menus
     */
    public function __construct(LinkRepositoryInterface $links, MenuRepositoryInterface $menus)
    {
        $this->links = $links;
        $this->menus = $menus;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $repository = new EntryRepository();

        $repository->setModel(new UrlLinkTypeModel());

        $repository->truncate();

        $menu = $this->menus->findBySlug('footer');

        $pyrocms = $repository->create(
            [
                config('app.locale', 'en')   => [
                    'title' => 'PyroCMS.com',
                ],
                'url' => 'http://pyrocms.com/',
            ]
        );

        $documentation = $repository->create(
            [
                config('app.locale', 'en')   => [
                    'title' => 'Documentation',
                ],
                'url' => 'http://pyrocms.com/documentation',
            ]
        );

        $this->links->truncate();

        $this->links->create(
            [
                'menu'   => $menu,
                'target' => '_blank',
                'entry'  => $pyrocms,
                'type'   => 'anomaly.extension.url_link_type',
            ]
        );

        $this->links->create(
            [
                'menu'   => $menu,
                'target' => '_blank',
                'entry'  => $documentation,
                'type'   => 'anomaly.extension.url_link_type',
            ]
        );
    }
}
