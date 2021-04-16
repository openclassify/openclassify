<?php
namespace Database\Seeders;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use WidgetSeeder;
use ZipArchive;

class DatabaseSeeder extends Seeder
{
    protected $widgets;
    protected $menus;
    protected $users;
    protected $roles;
    protected $activator;
    protected $disks;
    protected $folders;
    protected $command;

    public function __construct(
        WidgetRepositoryInterface $widgets,
        MenuRepositoryInterface $menus,
        UserRepositoryInterface $users,
        DiskRepositoryInterface $disks,
        FolderRepositoryInterface $folders,
        RoleRepositoryInterface $roles,
        UserActivator $activator,
        Command $command
    )
    {
        $this->widgets = $widgets;
        $this->menus = $menus;
        $this->users = $users;
        $this->roles = $roles;
        $this->activator = $activator;
        $this->disks = $disks;
        $this->folders = $folders;
        $this->command = $command;
    }

    public function run()
    {


        $admin = $this->roles->findBySlug('admin');

        $this->users->unguard();
        $this->users->newQuery()->where('email', "info@openclassify.com")->forceDelete();
        $visiosoft_administrator = $this->users->create(
            [
                'first_name' => 'Dev',
                'last_name' => 'Openclassify',
                'display_name' => 'openclassify',
                'email' => "info@openclassify.com",
                'username' => "openclassify",
                'password' => "openclassify",
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

        $repository = "https://raw.githubusercontent.com/openclassify/Openclassify-Demo-Data/master/";
        file_put_contents(storage_path('advs.sql'), fopen($repository . "advs.sql", 'r'));
        file_put_contents(storage_path('settings.sql'), fopen($repository . "settings.sql", 'r'));
        file_put_contents(storage_path('categories.sql'), fopen($repository . "categories.sql", 'r'));
        file_put_contents(storage_path('images.zip'), fopen($repository . "images.zip", "r"));
        file_put_contents(storage_path('cats.zip'), fopen($repository . "cats.zip", "r"));

        Model::unguard();
        DB::unprepared(file_get_contents(storage_path('advs.sql')));
        DB::unprepared(file_get_contents(storage_path('categories.sql')));
        DB::unprepared(file_get_contents(storage_path('settings.sql')));
        Model::reguard();


        $zip = new \ZipArchive();
        $zip->open(storage_path('images.zip'), ZipArchive::CREATE);
        $zip->extractTo(storage_path('streams/default/files-module/local/images/'));
        $zip->open(storage_path('cats.zip'), ZipArchive::CREATE);
        $zip->extractTo(storage_path('streams/default/files-module/local/category_icon/'));
        $zip->close();

        //Sync Files
        $this->command->call('files:sync');

        $this->call(WidgetSeeder::class);


        //Create Store Icon Folder
        if (!$this->folders->findBySlug('ads_excel')) {
            $disk = $this->disks->findBySlug('local');

            $this->folders->create([
                'en' => [
                    'name' => 'Ads Excel',
                    'description' => 'A folder for Ads Excel.',
                ],
                'slug' => 'ads_excel',
                'disk' => $disk
            ]);
        };

        if ($images_folder = $this->folders->findBySlug('images')) {
            $images_folder->update([
                'allowed_types' => [
                    'jpg', 'jpeg', 'png'
                ],
            ]);
        }


        //Favicon Folder
        if (is_null($this->folders->findBy('slug', 'favicon'))) {
            $disk = $this->disks->findBySlug('local');

            $this->folders->create([
                'en' => [
                    'name' => 'Favicon',
                    'description' => 'A folder for Favicon.',
                ],
                'slug' => 'favicon',
                'disk' => $disk,
                'allowed_types' => [
                    'ico', 'png',
                ],
            ]);
        };


        //Create Ads Documents Folder
        if (!$this->folders->findBySlug('ads_documents')) {
            $disk = $this->disks->findBySlug('local');

            $this->folders->create([
                'en' => [
                    'name' => 'Ads Documents',
                    'description' => 'A folder for Ads Documents.',
                ],
                'slug' => 'ads_documents',
                'disk' => $disk,
                'allowed_types' => [
                    'pdf', 'doc', 'docx', 'xls', 'xlsx',
                ],
            ]);
        };


        //Create Category Icon Folder
        if (!$this->folders->findBySlug('category_icon')) {
            $disk = $this->disks->findBySlug('local');

            $this->folders->create([
                'en' => [
                    'name' => 'Category Icon',
                    'description' => 'A folder for Category Icon.',
                ],
                'slug' => 'category_icon',
                'disk' => $disk
            ]);
        };

        //Demodata Seeder
        if(is_module_installed('visiosoft.module.demodata'))
        {
            $this->call(\Visiosoft\DemodataModule\Demodata\DemodataSeeder::class);
        }

        Artisan::call('assets:clear');
    }
}
