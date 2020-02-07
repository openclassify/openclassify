<?php

use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;
use Illuminate\Database\Seeder;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $widgets;
    protected $menus;

    public function __construct(
        WidgetRepositoryInterface $widgets,
        MenuRepositoryInterface $menus
    )
    {
        $this->widgets = $widgets;
        $this->menus = $menus;
    }

    public function run()
    {
        //Footer Link
        LinkModel::query()->forceDelete();
        $repository = new EntryRepository();
        $repository->setModel(new UrlLinkTypeModel());
        $menu = $this->menus->findBySlug('footer');


        $openclassify = $repository->create(
            [
                'en'  => [
                    'title' => 'OpenClassify.com',
                ],
                'url' => 'https://openclassify.com/',
            ]
        );
        $visiosoft = $repository->create(
            [
                'en'  => [
                    'title' => 'Visiosoft Inc.',
                ],
                'url' => 'https://visiosoft.com.tr/',
            ]
        );

        LinkModel::query()->create(
            [
                'menu'   => $menu,
                'target' => '_blank',
                'entry'  => $openclassify,
                'type'   => 'anomaly.extension.url_link_type',
            ]
        );
        LinkModel::query()->create(
            [
                'menu'   => $menu,
                'target' => '_blank',
                'entry'  => $visiosoft,
                'type'   => 'anomaly.extension.url_link_type',
            ]
        );
        /* Settings Start */
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/settings.sql'));
        Model::reguard();
        /* Settings Stop*/

        $this->call(widgetSeeder::class);
    }
}