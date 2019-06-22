<?php

use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Model\Settings\SettingsSettingsEntryModel;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;
use Illuminate\Database\Seeder;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Dashboard\Contract\DashboardRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $pages;
    protected $types;
    protected $widgets;
    protected $dashboards;
    protected $configuration;
    protected $menus;

    public function __construct(
        PageRepositoryInterface $pages,
        TypeRepositoryInterface $types,
        WidgetRepositoryInterface $widgets,
        DashboardRepositoryInterface $dashboards,
        ConfigurationRepositoryInterface $configuration,
        MenuRepositoryInterface $menus
    )
    {
        $this->pages = $pages;
        $this->types = $types;
        $this->widgets = $widgets;
        $this->dashboards = $dashboards;
        $this->configuration = $configuration;
        $this->menus = $menus;
    }

    public function run()
    {
        \Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryModel::query()->forceDelete();
        \Anomaly\Streams\Platform\Model\Pages\PagesDefaultPagesEntryModel::query()->forceDelete();
        $type = $this->types->findBySlug('default');

        $this->pages->create(
            [
                'sort_order' => 1,
                'en' => [
                    'title' => 'OpenClassify',
                ],
                'tr' => [
                    'title' => 'OpenClassify',
                ],
                'slug' => 'welcome',
                'entry' => $type->getEntryModel()->create(
                    [
                        'en' => [
                            'content' => '<h3>The extensible and most advanced open source classified app build with Laravel.</h3>',
                        ],
                        'tr' => [
                            'content' => '<h3>Laravel tabanlı Mödüler yapıya sahip En Gelişmiş İlan Platformu.</h3>',
                        ],
                    ]
                ),
                'type' => $type,
                'enabled' => true,
                'home' => true,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Contact',
                ],
                'tr' => [
                    'title' => 'Bize Ulaşın',
                ],
                'slug' => 'contact',
                'entry' => $type->getEntryModel()->create(
                    [
                        'en' => [
                            'content' => '<p>Drop us a line! We\'d love to hear from you!</p><p><br></p>
<p>{{ form(\'contact\').to(\'example@domain.com\')|raw }}</p>',
                        ],
                    ]
                ),
                'type' => $type,
                'enabled' => true,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);


        //Diğer Sayfalar

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Secure e-Trade Tips',
                ],
                'tr' => [
                    'title' => 'Güvenli Alışverişin İpuçları',
                ],
                'slug' => 'secure_e-trade_tips',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Agreements and Rules',
                ],
                'tr' => [
                    'title' => 'Sözleşmeler ve Kurallar',
                ],
                'slug' => 'agreements_and_rules',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Membership Agreement',
                ],
                'tr' => [
                    'title' => 'Üyelik Sözleşmesi',
                ],
                'slug' => 'membership_agreement',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Terms of Use',
                ],
                'tr' => [
                    'title' => 'Kullanım Koşulları',
                ],
                'slug' => 'terms_of_use',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Site Map',
                ],
                'tr' => [
                    'title' => 'Site Haritası',
                ],
                'slug' => 'site_map',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Personal Data Protection',
                ],
                'tr' => [
                    'title' => 'Kişisel Verilerin Korunması',
                ],
                'slug' => 'personal_data_protection',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);

        $this->pages->create(
            [
                'en' => [
                    'title' => 'Help and Operation Guide',
                ],
                'tr' => [
                    'title' => 'Yardım ve İşlem Rehberi',
                ],
                'slug' => 'help_and_operation_guide',
                'type' => $type,
                'enabled' => false,
                'visible' => 0,
                'theme_layout' => 'theme::layouts/default.twig',
            ]
        )->allowedRoles()->sync([]);


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
        $this->call(widgetSeeder::class);
    }
}