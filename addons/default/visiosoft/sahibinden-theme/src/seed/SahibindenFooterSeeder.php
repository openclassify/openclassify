<?php namespace Visiosoft\SahibindenTheme\seed;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Model\UrlLinkType\UrlLinkTypeUrlsEntryModel;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class SahibindenFooterSeeder extends Seeder
{
    private $menuRepository;
    private $linkTypeUrlsEntryModel;
    private $linkRepository;
    private $cityRepository;

    public function __construct(
        MenuRepositoryInterface   $menuRepository,
        UrlLinkTypeUrlsEntryModel $linkTypeUrlsEntryModel,
        LinkRepositoryInterface   $linkRepository,
        CityRepositoryInterface   $cityRepository
    )
    {
        $this->menuRepository = $menuRepository;
        $this->linkTypeUrlsEntryModel = $linkTypeUrlsEntryModel;
        $this->linkRepository = $linkRepository;
        $this->cityRepository = $cityRepository;
    }

    public function run()
    {
        // Navigations
        if (!$footerTab = $this->menuRepository->findBySlug('footer_tabs_area')) {
            $footerTab = $this->menuRepository->create([
                'slug' => 'footer_tabs_area',
                'en' => [
                    'name' => 'Footer tab area',
                ],
            ]);
        }

        $links = ['Satılık', 'Kiralık', 'İş Yeri', 'Yazlık', 'Villa', 'Daire'];
        $cities = $this->cityRepository->getCitiesByCountryId(212);

        foreach ($links as $link) {
            $url = $this->linkTypeUrlsEntryModel->create([
                'title' => $link,
                'url' => '#',
            ]);

            $parent = $this->linkRepository->create([
                'menu' => $footerTab->id,
                'type' => 'anomaly.extension.url_link_type',
                'entry' => $url,
                'target' => '_self',
            ]);

            for ($i = 0; $i < 24; $i++) {
                $url = $this->linkTypeUrlsEntryModel->create([
                    'title' => $cities[random_int(0, count($cities) - 1)]->name . ' ' . $link,
                    'url' => '#',
                ]);

                $this->linkRepository->create([
                    'menu' => $footerTab->id,
                    'type' => 'anomaly.extension.url_link_type',
                    'entry' => $url,
                    'target' => '_self',
                    'parent' => $parent
                ]);
            }
        }
    }
}