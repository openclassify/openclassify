<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Blocks\BlocksAreasEntryModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksBlocksEntryModel;
use Anomaly\Streams\Platform\Model\HtmlBlock\HtmlBlockBlocksEntryModel;
use Illuminate\Support\Facades\DB;

class AdvSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        DB::table('blocks_blocks')->truncate();
        DB::table('blocks_areas')->truncate();
        DB::table('html_block_blocks')->truncate();
        DB::table('blocks_areas')->where('slug', 'advs_default_theme_post_adv_right')
        ->orWhere('slug', 'advs_default_theme_post_adv_bottom')
        ->orWhere('slug', 'middle-home-banner-area')
        ->orWhere('slug', 'right-home-banner-area')
        ->orWhere('slug', 'left-home-banner-area')
        ->orWhere('slug', 'advs_default_theme_home_bottom')
        ->orWhere('slug', 'advs_default_theme_home_mobile')
        ->delete();
        // right side
        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Advs Default Theme Post Adv Right Side',
            ],
            'tr' => [
                'name' => 'Advs Varsayılan Tema İlan Ver Sağ Bölüm',
            ],
            'slug' => 'advs_default_theme_post_adv_right',
        ]);

        // bottom part
        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Advs Default Theme Post Adv Bottom',
            ],
            'tr' => [
                'name' => 'Advs Varsayılan Tema İlan Ver Alt',
            ],
            'slug' => 'advs_default_theme_post_adv_bottom',
        ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => 'By clicking Post, you agree to our Terms of Use and Privacy Policy acknowledge that you are the rightful owner of this item.',
            ],
            'tr' => [
                'html' => 'Yayınla\'yı tıkladığınızda, Kullanım Koşulları ve Gizlilik Politikasını kabul etmiş olursunuz, bu öğenin hak sahibi olduğunuzu kabul edersiniz.',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);

        // homepage bottom info

        $block_area = BlocksAreasEntryModel::create([
                'en' => [
                    'name' => 'Advs Default Theme Homepage Bottom Info',
                ],
                'tr' => [
                    'name' => 'Advs Varsayılan Tema Anasayfa Alt Bilgi',
                ],
                'slug' => 'advs_default_theme_home_bottom',
            ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => '<div class="section cta text-center">
                <div class="row">
                    <!-- single-cta -->
                    <div class="col-sm-4">
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-secure">
                                <img src="{{ img(\'theme::images/icon/13.png\').url }}" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>Secure Trading</h4>
                            <p>Duis autem vel eum iriure dolor in hendrerit in</p>
                        </div>
                    </div><!-- single-cta -->

                    <!-- single-cta -->
                    <div class="col-sm-4">
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-support">
                                <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>24/7 Support</h4>
                            <p>Duis autem vel eum iriure dolor in hendrerit in</p>
                        </div>
                    </div><!-- single-cta -->

                    <!-- single-cta -->
                    <div class="col-sm-4">
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-trading">
                                <img src="{{ img(\'theme::images/icon/15.png\').url }}" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>Easy Trading</h4>
                            <p>Duis autem vel eum iriure dolor in hendrerit in</p>
                        </div>
                    </div><!-- single-cta -->
                </div><!-- row -->
            </div>',
            ],
            'tr' => [
                'html' => '<div class="section cta text-center">
                <div class="row">
                    <!-- single-cta -->
                    <div class="col-sm-4">
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-secure">
                                <img src="{{ img(\'theme::images/icon/13.png\').url }}" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>Guvenli Alisveris</h4>
                            <p>Duis autem vel eum iriure dolor in hendrerit in</p>
                        </div>
                    </div><!-- single-cta -->

                    <!-- single-cta -->
                    <div class="col-sm-4">
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-support">
                                <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>7/24 Destek</h4>
                            <p>Duis autem vel eum iriure dolor in hendrerit in</p>
                        </div>
                    </div><!-- single-cta -->

                    <!-- single-cta -->
                    <div class="col-sm-4">
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-trading">
                                <img src="{{ img(\'theme::images/icon/15.png\').url }}" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>Kolay Ticaret</h4>
                            <p>Duis autem vel eum iriure dolor in hendrerit in</p>
                        </div>
                    </div><!-- single-cta -->
                </div><!-- row -->
            </div>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);

        // homepage mobile app part
        $block_area = BlocksAreasEntryModel::create([
                'en' => [
                    'name' => 'Advs Default Theme Homepage Mobile App',
                ],
                'tr' => [
                    'name' => 'Advs Varsayılan Tema Anasayfa Mobil Uygulama',
                ],
                'slug' => 'advs_default_theme_home_mobile',
            ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => '<section id="download" class="clearfix parallax-section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- download-app -->
                        <!-- download-app -->
                        <div class="col-sm-2">
                        </div><!-- download-app -->
                        <div class="col-sm-4">
                            <a href="#" class="download-app">
                                <img src="{{ img(\'theme::images/icon/16.png\').url }}" alt="Image" class="img-responsive">
                                <span class="pull-left">
                                    <span>{{ trans(\'visiosoft.theme.default::addon.advs_default_theme_homepage_mobile_app_available_on\') }}</span>
                                    <strong>Google Play</strong>
                                </span>
                            </a>
                        </div><!-- download-app -->
                        <div class="col-sm-4">
                            <a href="#" class="download-app">
                                <img src="{{ img(\'theme::images/icon/17.png\').url }}" alt="Image" class="img-responsive">
                                <span class="pull-left">
                                    <span>{{ trans(\'visiosoft.theme.default::addon.advs_default_theme_homepage_mobile_app_available_on\') }}</span>
                                    <strong>App Store</strong>
                                </span>
                            </a>
                        </div><!-- download-app -->
                        
                    </div><!-- row -->
                </div><!-- contaioner -->
            </section>',
            ],
            'tr' => [
                'html' => '<section id="download" class="clearfix parallax-section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                    <!-- download-app -->
                        <div class="col-sm-2">
                        </div><!-- download-app -->
                        <!-- download-app -->
                        <div class="col-sm-4">
                            <a href="#" class="download-app">
                                <img src="{{ img(\'theme::images/icon/16.png\').url }}" alt="Image" class="img-responsive">
                                <span class="pull-left">
                                    <span>{{ trans(\'visiosoft.theme.default::addon.advs_default_theme_homepage_mobile_app_available_on\') }}</span>
                                    <strong>Google Play</strong>
                                </span>
                            </a>
                        </div><!-- download-app -->
        
                        <!-- download-app -->
                        <div class="col-sm-4">
                            <a href="#" class="download-app">
                                <img src="{{ img(\'theme::images/icon/17.png\').url }}" alt="Image" class="img-responsive">
                                <span class="pull-left">
                                    <span>{{ trans(\'visiosoft.theme.default::addon.advs_default_theme_homepage_mobile_app_available_on\') }}</span>
                                    <strong>App Store</strong>
                                </span>
                            </a>
                        </div><!-- download-app -->

                    </div><!-- row -->
                </div><!-- contaioner -->
            </section>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);




        // left Home Banner Area

        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Left Home Banner Area',
            ],
            'tr' => [
                'name' => 'Anasayfa Sol reklam alanı',
            ],
            'slug' => 'left-home-banner-area',
        ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => ' <div class="advertisement">
                            <a href="#"><img src="{{ img(\'theme::images/ads/2.jpg\').url }}" alt="Images" class="img-responsive"></a>
                        </div>',
            ],
            'tr' => [
                'html' => ' <div class="advertisement">
                            <a href="#"><img src="{{ img(\'theme::images/ads/2.jpg\').url }}" alt="Images" class="img-responsive"></a>
                        </div>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);


        // middle Home Banner Area

        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Middle Home Banner Area',
            ],
            'tr' => [
                'name' => 'Anasayfa Orta reklam alanı',
            ],
            'slug' => 'middle-home-banner-area',
        ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => ' <div class="ad-section text-center">
                            <a href="#"><img src="{{ img(\'theme::images/ads/3.jpg\').url }}" alt="Image" class="img-responsive"></a>
                        </div>',
            ],
            'tr' => [
                'html' => ' <div class="ad-section text-center">
                            <a href="#"><img src="{{ img(\'theme::images/ads/3.jpg\').url }}" alt="Image" class="img-responsive"></a>
                        </div>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);



        // right Home Banner Area

        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Right Home Banner Area',
            ],
            'tr' => [
                'name' => 'Anasayfa Sağ reklam alanı',
            ],
            'slug' => 'right-home-banner-area',
        ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => ' <div class="advertisement text-center">
                            <a href="#"><img src="{{ img(\'theme::images/ads/1.jpg\').url }}" alt="Images" class="img-responsive"></a>
                        </div>',
            ],
            'tr' => [
                'html' => ' <div class="advertisement text-center">
                            <a href="#"><img src="{{ img(\'theme::images/ads/1.jpg\').url }}" alt="Images" class="img-responsive"></a>
                        </div>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);




        // List item Right Sidebar

        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'List item Right Sidebar',
            ],
            'tr' => [
                'name' => 'ilan Detay Sağ Alan',
            ],
            'slug' => 'list-item-right-sidebar',
        ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => '  <div class="cta">
                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-secure">
                                        <img src="{{ img(\'theme::images/icon/13.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Secure Trading</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-support">
                                        <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>24/7 Support</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                </div><!-- single-cta -->


                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-trading">
                                        <img src="{{ img(\'theme::images/icon/15.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Easy Trading</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                    <h5>Need help?</h5>
                                    <p><span>Give a call on</span><a
                                                href="tellto:08048100000"> 08048100000</a></p>
                                </div><!-- single-cta -->
                            </div>',
            ],
            'tr' => [
                'html' => '  <div class="cta">
                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-secure">
                                        <img src="{{ img(\'theme::images/icon/13.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Güvenli Ticaret</h4>
                                    <p>Kolay, Güvenli ve Avantajlı Alışveriş için</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-support">
                                        <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>7/24 Saat Destek</h4>
                                    <p>Hızlı ve Kolay çözüm imkanı</p>
                                </div><!-- single-cta -->


                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-trading">
                                        <img src="{{ img(\'theme::images/icon/15.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Kolay Alışveriş</h4>
                                    <p>Çoklu dil desteği ve Çoklu Para Birimi</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                <!-- cta-icon -->
                                    <div class="cta-icon icon-trading">
                                        <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->
                                    <h5>Yardıma mı ihtiyacınız var?</h5>
                                    <p><span>Hemen Arayın</span><a
                                                href="tellto:08048100000"> 08048100000</a></p>
                                </div><!-- single-cta -->
                            </div>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);



        // Profile Right Sidebar

        $block_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Profile Right Sidebar',
            ],
            'tr' => [
                'name' => 'Profil Sağ Alan',
            ],
            'slug' => 'profile-right-sidebar',
        ]);

        $blockhtml = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => '  <div class="cta">
                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-secure">
                                        <img src="{{ img(\'theme::images/icon/13.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Secure Trading</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-support">
                                        <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>24/7 Support</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                </div><!-- single-cta -->


                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-trading">
                                        <img src="{{ img(\'theme::images/icon/15.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Easy Trading</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                    <h5>Need help?</h5>
                                    <p><span>Give a call on</span><a
                                                href="tellto:08048100000"> 08048100000</a></p>
                                </div><!-- single-cta -->
                            </div>',
            ],
            'tr' => [
                'html' => '  <div class="cta">
                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-secure">
                                        <img src="{{ img(\'theme::images/icon/13.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Güvenli Ticaret</h4>
                                    <p>Kolay, Güvenli ve Avantajlı Alışveriş için</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-support">
                                        <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>7/24 Saat Destek</h4>
                                    <p>Hızlı ve Kolay çözüm imkanı</p>
                                </div><!-- single-cta -->


                                <!-- single-cta -->
                                <div class="single-cta">
                                    <!-- cta-icon -->
                                    <div class="cta-icon icon-trading">
                                        <img src="{{ img(\'theme::images/icon/15.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->

                                    <h4>Kolay Alışveriş</h4>
                                    <p>Çoklu dil desteği ve Çoklu Para Birimi</p>
                                </div><!-- single-cta -->

                                <!-- single-cta -->
                                <div class="single-cta">
                                <!-- cta-icon -->
                                    <div class="cta-icon icon-trading">
                                        <img src="{{ img(\'theme::images/icon/14.png\').url }}" alt="Icon"
                                             class="img-responsive">
                                    </div><!-- cta-icon -->
                                    <h5>Yardıma mı ihtiyacınız var?</h5>
                                    <p><span>Hemen Arayın</span><a
                                                href="tellto:08048100000"> 08048100000</a></p>
                                </div><!-- single-cta -->
                            </div>',
            ],
        ]);
        $block_block = BlocksBlocksEntryModel::create([
            'area_id' => $block_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $blockhtml->id,
        ]);
    }
}
