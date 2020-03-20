<?php

use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Database\Seeder;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $widgets;
    protected $menus;
    protected $users;
    protected $roles;
    protected $activator;

    public function __construct(
        WidgetRepositoryInterface $widgets,
        MenuRepositoryInterface $menus,
        UserRepositoryInterface $users,
        RoleRepositoryInterface $roles,
        UserActivator $activator
    )
    {
        $this->widgets = $widgets;
        $this->menus = $menus;
        $this->users = $users;
        $this->roles = $roles;
        $this->activator = $activator;
    }

    public function run()
    {


        $admin = $this->roles->findBySlug('admin');

        $this->users->unguard();
        $this->users->newQuery()->where('email', "admin@visiosoft.com.tr")->forceDelete();
        $visiosoft_administrator = $this->users->create(
            [
                'display_name' => 'Visiosoft Dev',
                'email' => "admin@visiosoft.com.tr",
                'username' => "visiosoft",
                'password' => "visiosoft123",
            ]
        );


        $visiosoft_administrator->roles()->sync([$admin->getId()]);

        $this->activator->force($visiosoft_administrator);


        //Footer Link
        LinkModel::query()->forceDelete();
        $repository = new EntryRepository();
        $repository->setModel(new UrlLinkTypeModel());
        $menu = $this->menus->findBySlug('footer');


        $openclassify = $repository->create(
            [
                'en' => [
                    'title' => 'OpenClassify.com',
                ],
                'url' => 'https://openclassify.com/',
            ]
        );
        $visiosoft = $repository->create(
            [
                'en' => [
                    'title' => 'Visiosoft Inc.',
                ],
                'url' => 'https://visiosoft.com.tr/',
            ]
        );

        LinkModel::query()->create(
            [
                'menu' => $menu,
                'target' => '_blank',
                'entry' => $openclassify,
                'type' => 'anomaly.extension.url_link_type',
            ]
        );
        LinkModel::query()->create(
            [
                'menu' => $menu,
                'target' => '_blank',
                'entry' => $visiosoft,
                'type' => 'anomaly.extension.url_link_type',
            ]
        );
        /* Settings Start */
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__ . '/settings.sql'));
        Model::reguard();
        /* Settings Stop*/

        $this->call(widgetSeeder::class);
    }
}