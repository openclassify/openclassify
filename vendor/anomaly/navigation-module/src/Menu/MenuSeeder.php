<?php

namespace Anomaly\NavigationModule\Menu;

use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class MenuSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MenuSeeder extends Seeder
{

    /**
     * The menu repository.
     *
     * @var MenuRepositoryInterface
     */
    protected $menus;

    /**
     * Create a new MenuSeeder instance.
     *
     * @param $menus
     */
    public function __construct(MenuRepositoryInterface $menus)
    {
        $this->menus = $menus;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->menus
            ->truncate()
            ->create(
                [
                    config('app.locale', 'en')   => [
                        'name'        => 'Footer',
                        'description' => 'This is the main footer menu.',
                    ],
                    'slug' => 'footer',
                ]
            );
    }
}
