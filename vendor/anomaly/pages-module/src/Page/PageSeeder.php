<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class PageSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageSeeder extends Seeder
{

    /**
     * The page repository.
     *
     * @var PageRepositoryInterface
     */
    protected $pages;

    /**
     * The types repository.
     *
     * @var TypeRepositoryInterface
     */
    protected $types;

    /**
     * Create a new PageSeeder instance.
     *
     * @param PageRepositoryInterface $pages
     * @param TypeRepositoryInterface $types
     */
    public function __construct(PageRepositoryInterface $pages, TypeRepositoryInterface $types)
    {
        $this->pages = $pages;
        $this->types = $types;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->pages->truncate();

        $type = $this->types->findBySlug('default');

        $this->pages->create(
            [
                'en'           => [
                    'title' => 'Welcome',
                ],
                'slug'         => 'welcome',
                'entry'        => $type->getEntryModel()->create(
                    [
                        'en' => [
                            'content' => '<p>Welcome to PyroCMS!</p>',
                        ],
                    ]
                ),
                'type'         => $type,
                'enabled'      => true,
                'home'         => true,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en'           => [
                    'title' => 'Contact',
                ],
                'slug'         => 'contact',
                'entry'        => $type->getEntryModel()->create(
                    [
                        'en' => [
                            'content' => '<p>Drop us a line! We\'d love to hear from you!</p><p><br></p>
<p>{{ form(\'contact\').to(\'example@domain.com\')|raw }}</p>',
                        ],
                    ]
                ),
                'type'         => $type,
                'enabled'      => true,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);
    }
}
