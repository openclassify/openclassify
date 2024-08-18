<?php namespace Visiosoft\SahibindenTheme;

use Anomaly\NavigationModule\Link\LinkRepository;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface as PageTypeRepositoryInterface;
use Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PostsModule\Type\TypeRepository as PostTypeRepository;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Model\Posts\PostsDefaultPostsEntryModel;
use Anomaly\Streams\Platform\Model\Repeater\RepeaterFaqRepeaterEntryModel;
use Anomaly\Streams\Platform\Model\Repeater\RepeaterFeaturesRepeaterEntryModel;
use Anomaly\Streams\Platform\Model\UrlLinkType\UrlLinkTypeUrlsEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Anomaly\NavigationModule\Menu\MenuRepository;
use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\ArgvInput;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\SahibindenTheme\seed\SahibindenFooterSeeder;
use Visiosoft\SahibindenTheme\seed\SahibindenRepeaterSeeder;

class SahibindenThemeSeeder extends Seeder
{
    private $settingRepository;
    private $streamRepository;
    private $fieldRepository;
    private $assignmentRepository;
    protected $fields;
    protected $assignments;
    protected $linkRepository;
    private $linkTypeUrlsEntryModel;
    protected $postType;
    protected $postsRepository;
    protected $types;
    protected $categories;
    protected $advRepository;
    protected $pages;
    protected $pageTypes;

    public function __construct(SettingRepositoryInterface    $settingRepository,
                                StreamRepositoryInterface     $streamRepository,
                                FieldRepositoryInterface      $fieldRepository,
                                AssignmentRepositoryInterface $assignmentRepository,
                                PageTypeRepositoryInterface   $pageTypes,
                                PageRepositoryInterface       $pages,
                                FieldRepositoryInterface      $fields,
                                AssignmentRepositoryInterface $assignments,
                                LinkRepository                $linkRepository,
                                UrlLinkTypeUrlsEntryModel     $linkTypeUrlsEntryModel,
                                PostTypeRepository            $postType,
                                PostRepositoryInterface       $postsRepository,
                                TypeRepositoryInterface       $types,
                                CategoryRepositoryInterface   $categories,
                                AdvRepositoryInterface        $advRepository,
    )
    {
        parent::__construct();
        $this->settingRepository = $settingRepository;
        $this->streamRepository = $streamRepository;
        $this->fieldRepository = $fieldRepository;
        $this->assignmentRepository = $assignmentRepository;
        $this->pages = $pages;
        $this->fields = $fields;
        $this->assignments = $assignments;
        $this->linkRepository = $linkRepository;
        $this->linkTypeUrlsEntryModel = $linkTypeUrlsEntryModel;
        $this->postType = $postType;
        $this->postsRepository = $postsRepository;
        $this->types = $types;
        $this->categories = $categories;
        $this->advRepository = $advRepository;
        $this->pageTypes = $pageTypes;
    }

    public function run()
    {
        // Activate
        $this->settingRepository->set('streams::standard_theme', 'visiosoft.theme.sahibinden');

        $banners = [
            'visiosoft.theme.sahibinden::home_bottom' => '<p><img alt="Banner2" src="/files/images/banner2.png"></p>',
            'visiosoft.theme.sahibinden::home_top_latestAds' => '<p><img alt="Banner1" src="/files/images/banner1.png"></p>',
            'visiosoft.theme.sahibinden::home_bottom_latestAds' => '<p><img alt="Banner3" src="/files/images/banner3.png"></p>',
            'visiosoft.theme.sahibinden::home_bottom_left_categories' => '<p><img alt="Group 41701" src="/files/images/Group_41701.png"></p>',
            'visiosoft.theme.sahibinden::banner_web' => '1295',
            'visiosoft.theme.sahibinden::detail_bottom' => '<p><img alt="Banner4" src="/files/images/banner_gif.gif"></p>',
            'visiosoft.theme.sahibinden::detail_bottom_mobile' => '<p><img alt="Banner4" src="/files/images/detail_banner_mobile.png"></p>'
        ];

//        If the banner content is not empty, it is being checked not to change the contents.
        foreach ($banners as $key => $value) {
            $setting = $this->settingRepository->get($key);
            if (empty($setting['value'])) {
                $this->settingRepository->set($key, $value);
            }
        }

        $menus = [[
            'en' => [
                'name' => 'Customer Service'
            ],
            'slug' => 'customer_service',
        ], [
            'en' => [
                'name' => 'About Us',
            ],
            'slug' => 'about_us',
        ], [
            'en' => [
                'name' => 'Buy And Sell',
            ],
            'slug' => 'buy_and_sell',
        ]];

        $menuRepository = app(MenuRepository::class);
        foreach ($menus as $menu) {
            if (!$menuRepository->findBySlug($menu['slug'])) {
                $menuRepository->create($menu);
            }
        }

        $links = [[
            'entry' => [
                'en' => [
                    'title' => 'OpenClassify.com',
                ],
                'url' => 'https://openclassify.com/',
            ],
            'menu' => 'customer_service'
        ], [
            'entry' => [
                'en' => [
                    'title' => 'Ocify.co',
                ],
                'url' => 'https://ocify.co/',
            ],
            'menu' => 'about_us'
        ], [
            'entry' => [
                'en' => [
                    'title' => 'Visiosoft Inc.',
                ],
                'url' => 'https://visiosoft.com.tr/',
            ],
            'menu' => 'buy_and_sell'
        ]];

        $linkModel = new LinkModel();
        foreach ($links as $link) {
            $menu = $menuRepository->findBySlug($link['menu']);
            $url = new UrlLinkTypeModel();

            $entry = $url->newQuery()->create($link['entry']);

            $linkModel->newQuery()->create([
                'menu' => $menu,
                'target' => '_blank',
                'entry' => $entry,
                'type' => 'anomaly.extension.url_link_type',
            ]);
        }


        // Variables Seed
        if (!$stream = $this->streamRepository->findBySlugAndNamespace('sahibinden_theme', 'variables')) {
            $stream = $this->streamRepository->newQuery()
                ->create([
                    'name' => 'sahibinden-theme',
                    'namespace' => 'variables',
                    'slug' => 'sahibinden_theme',
                    'prefix' => 'variables_',
                    'translatable' => true,
                ]);
        }

        $fields = [
            [
                'name' => 'sahibinden footer text',
                'namespace' => 'variables',
                'slug' => 'sahibinden_footer_text',
                'type' => 'anomaly.field_type.textarea',
                'config' => 'a:6:{s:4:"rows";s:1:"6";s:3:"min";N;s:3:"max";N;s:12:"show_counter";b:0;s:8:"autogrow";b:1;s:13:"default_value";s:330:"The ad creator is solely responsible for the content, correctness, accuracy and legal obligation of all posted ads, entries, ideas and information. openclassify.com is not in any way responsible for the quality or legality of content created and posted by its users. You should contact the ad creator directly with your questions.";}',
                'locked' => false,
            ],
            [
                'name' => 'sahibinden whatsapp text',
                'namespace' => 'variables',
                'slug' => 'sahibinden_wp_text',
                'type' => 'anomaly.field_type.textarea',
                'config' => 'a:6:{s:4:"rows";s:1:"6";s:3:"min";N;s:3:"max";N;s:12:"show_counter";b:0;s:8:"autogrow";b:1;s:13:"default_value";s:330:"Hey look what i found in openclassify ";}',
                'locked' => false,
            ],
            [
                'name' => 'sahibinden security text',
                'namespace' => 'variables',
                'slug' => 'sahibinden_security_text',
                'type' => 'anomaly.field_type.textarea',
                'config' => 'a:6:{s:4:"rows";s:1:"6";s:3:"min";N;s:3:"max";N;s:12:"show_counter";b:0;s:8:"autogrow";b:1;s:13:"default_value";s:330:"Do not make down-payment or send money before seeing the real-estate you want to buy.";}',
                'locked' => false,
            ]
        ];

        foreach ($fields as $field) {

            if (!$this->fieldRepository->findBySlugAndNamespace($field['slug'], 'variables')) {
                $item = $this->fieldRepository->newQuery()
                    ->create([
                        'name' => $field['name'],
                        'namespace' => $field['namespace'],
                        'slug' => $field['slug'],
                        'type' => $field['type'],
                        'config' => $field['config'],
                        'locked' => $field['locked'],
                    ]);

            }

            if (isset($item) && !$this->assignmentRepository->findByStreamAndField($stream, $item)) {
                $this->assignmentRepository->newQuery()
                    ->create([
                        'stream_id' => $stream->id,
                        'field_id' => $item->id,
                        'translatable' => true,
                    ]);
            }
        }

        $this->call(SahibindenFooterSeeder::class);
        $this->call(SahibindenRepeaterSeeder::class);
        $this->adsDemo();
        $zip = new \ZipArchive();
        $zip->open(realpath(dirname(__DIR__)) . '/src/seed/data/images.zip', \ZipArchive::CREATE);
        $zip->extractTo(storage_path('streams/' . app(Application::class)->getReference() . '/files-module/local/images/'));
        $zip->close();

        $application_reference = (new ArgvInput())->getParameterOption('--app', env('APPLICATION_REFERENCE', 'default'));
        $banner = str_replace('{application_reference}', $application_reference, file_get_contents(realpath(dirname(__DIR__)) . '/src/seed/data/banner.sql'));


        Artisan::call('assets:clear');
        Artisan::call('files:sync');

    }

    public function adsDemo()
    {
        $this->settingRepository->set('streams::standard_theme', 'visiosoft.theme.sahibinden');

        $app = app(Application::class)->getReference();
        $application_reference = (new ArgvInput())->getParameterOption('--app', env('APPLICATION_REFERENCE', 'default'));
        $menus = str_replace('{application_reference}', $app, file_get_contents(realpath(dirname(__DIR__)) . '/src/seed/footer.sql'));
        Model::unguard();
        DB::unprepared($menus);
        Model::reguard();
        Artisan::call('assets:clear');


        $repeaters = [
            'faq_repeater' => [
                'content' => [
                    'name' => 'Faq Repeater',
                    'namespace' => 'repeater',
                    'slug' => 'faq_repeater',
                    'prefix' => 'repeater_',
                    'translatable' => true
                ],
                'fields' => [
                    'title', 'description'
                ]
            ],
            'features_repeater' => [
                'content' => [
                    'name' => 'Features Repeater',
                    'namespace' => 'repeater',
                    'slug' => 'features_repeater',
                    'prefix' => 'repeater_',
                    'translatable' => true
                ],
                'fields' => [
                    'file', 'description',
                ]
            ],

        ];

        foreach ($repeaters as $slug => $item) {
            if (!$repeater = $this->streamRepository->findBySlugAndNamespace($slug, 'repeater')) {
                $repeater = $this->streamRepository->create($item['content']);
            }

            $fields_repeater = [
                'file' => [
                    'field_attributes' => [
                        'name' => 'File',
                        'namespace' => 'repeater',
                        'slug' => 'file',
                        'type' => 'anomaly.field_type.file',
                        'locked' => 0,
                        "config" => [
                            "folders" => ['images'],
                            "mode" => 'upload',
                        ],
                    ],
                    'assignment_attributes' => [
                        'required' => false,
                        'translatable' => false,
                    ]
                ],
                'title' => [
                    'field_attributes' => [
                        'name' => 'Title',
                        'namespace' => 'repeater',
                        'slug' => 'title',
                        'type' => 'anomaly.field_type.text',
                        'locked' => 0,
                    ],
                    'assignment_attributes' => [
                        'required' => true,
                        'translatable' => true,
                    ]
                ],
                'description' => [
                    'field_attributes' => [
                        'name' => 'Description',
                        'namespace' => 'repeater',
                        'slug' => 'description',
                        'type' => 'anomaly.field_type.textarea',
                        'locked' => 0,
                    ],
                    'assignment_attributes' => [
                        'required' => true,
                        'translatable' => true,
                    ]
                ],

            ];

            foreach ($fields_repeater as $field_slug => $field_repeater) {
                if (!$field = $this->fields->findBySlugAndNamespace($field_slug, 'repeater')) {
                    $field = $this->fields->create($field_repeater['field_attributes']);
                }

                if (in_array($field->getSlug(), $item['fields'])) {
                    if (!$this->assignments->findByStreamAndField($repeater, $field)) {
                        // File Field Assignment
                        $this->assignments->create(
                            array_merge([
                                'stream' => $repeater,
                                'field' => $field,
                            ], $field_repeater['assignment_attributes'])
                        );
                    }
                }
            }
        }

        $fields = [
            'faq_repeater_fields' => [
                'name' => 'FAQ Repeater Fields',
                'namespace' => 'pages',
                'slug' => 'faq_repeater_fields',
                'type' => 'anomaly.field_type.repeater',
                'locked' => 0,
                'config' => [
                    'related' => RepeaterFaqRepeaterEntryModel::class,
                    'translatable' => true
                ]
            ],
            'about_img_1' => [
                'name' => 'About Page Img 1',
                'namespace' => 'pages',
                'slug' => 'about_img_1',
                'type' => 'anomaly.field_type.file',
                'locked' => 0
            ],
            'about_img_2' => [
                'name' => 'About Page Img 2',
                'namespace' => 'pages',
                'slug' => 'about_img_2',
                'type' => 'anomaly.field_type.file',
                'locked' => 0
            ],
            'about_img_3' => [
                'name' => 'About Page Img 3',
                'namespace' => 'pages',
                'slug' => 'about_img_3',
                'type' => 'anomaly.field_type.file',
                'locked' => 0
            ],
            'features_repeater' => [
                'name' => 'Features Repeater',
                'namespace' => 'pages',
                'slug' => 'features_repeater',
                'type' => 'anomaly.field_type.repeater',
                'locked' => 0,
                'config' => [
                    'related' => RepeaterFeaturesRepeaterEntryModel::class,
                    'translatable' => true
                ]
            ],
            'editor' => [
                'name' => 'Editor',
                'namespace' => 'pages',
                'slug' => 'editor',
                'type' => 'anomaly.field_type.editor',
                'locked' => 0,
                'config' => [
                    'translatable' => true,
                ]
            ],
        ];

        $pageTypes = [
            'faq_page' => [
                'content' => [
                    'en' => [
                        'name' => 'FAQ Page',
                    ],
                    'slug' => 'faq_page',
                    'handler' => 'anomaly.extension.default_page_handler',
                    'theme_layout' => 'theme::layouts/no-container.twig',
                    'layout' => '{{ page.editor|raw }}',
                ],
                'fields' => [
                    'faq_repeater_fields', 'editor'
                ]
            ],
            'about_us' => [
                'content' => [
                    'en' => [
                        'name' => 'About Us Page',
                    ],
                    'slug' => 'about_us',
                    'handler' => 'anomaly.extension.default_page_handler',
                    'theme_layout' => 'theme::layouts/no-container.twig',
                    'layout' => '{{ page.editor|raw }}',
                ],
                'fields' => [
                    'title', 'description', 'about_img_1', 'about_img_2', 'about_img_3', 'features_repeater', 'editor'
                ]
            ]
        ];


        foreach ($fields as $slug => $item) {
            if (!$field = $this->fields->findBySlugAndNamespace($slug, 'pages')) {
                $field = $this->fields->create($item);
            }
        }

        foreach ($pageTypes as $type_slug => $type_content) {
            if (!$type = $this->pageTypes->findBySlug($type_slug)) {
                $type = $this->pageTypes->create($type_content['content']);

                $stream = $type->getEntryStream();

                foreach ($type_content['fields'] as $field) {
                    $this->assignments->create([
                        'stream' => $stream,
                        'field' => $this->fields->findBySlugAndNamespace($field, 'pages')
                    ]);
                }
            }
        }

        $pages = [
            'faq-page' => [
                'content' => [
                    'en' => [
                        'title' => 'FAQ Page',
                    ],
                    'slug' => 'faq-page',
                    'enabled' => 'true',
                    'home' => false,
                    'theme_layout' => 'theme::layouts/no-container.twig',
                ],
                'entry_content' => [
                    'en' => [
                        'editor' =>
                            '
                                {% set page = page(pagesFindBySlug(\'faq-page\')) %}
                                    <section class="faq">
                                        <div class="container">
                                            <h2 class="faq-title">{{ trans(\'theme::field.faq\')|raw }}</h2>
                                            <div class="row">
                                                <div class="col-12">
                                    
                                                    <div class="accordion" id="faq">
                                    
                                                        {% for key,faq in page.entry.faq_repeater_fields %}
                                                        <div class="faq-section">
                                                            <div class="faq-header" id="faqhead{{ key+1 }}">
                                                                <div  class="faq-question {{key != 0 ? \'collapsed\' : \'x\' }}" data-toggle="collapse" data-target="#faq{{ key+1 }}"
                                                                      aria-expanded="true" aria-controls="faq{{ key+1 }}">
                                                                    {{faq.title|raw}}
                                                                </div>
                                                            </div>
                                    
                                                            <div id="faq{{ key+1 }}" class="collapse {{ key == 0 ? \'show\' : \'x\' }}" aria-labelledby="faqhead{{ key+1 }}" data-parent="#faq">
                                                                <div class="faq-body">
                                                                    {{faq.description|raw}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                            {% endfor %}
                                    
                                                    </div>
                                                </div>
                                            </div>
                                    </section>

                            ',
                    ],
                ],
                'type' => 'faq_page',
                'children' => [],
            ],
            'about-us' => [
                'content' => [
                    'en' => [
                        'title' => 'About Us Page',
                    ],
                    'slug' => 'about-us',
                    'enabled' => 'true',
                    'home' => false,
                    'theme_layout' => 'theme::layouts/no-container.twig',
                ],
                'entry_content' => [
                    'en' => [
                        'editor' =>
                            '
                                {% set page = page(pagesFindBySlug(\'about-us\')) %}
                                    <div class="about-us">
                                        <div class="container">
                                            <section class="about_us">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-5">
                                                            <h2 class="about-head mt-4"> {{page.entry.title}}  </h2>
                                                            <div>
                                                                <p class="about-desc mb-4">
																	{{page.entry.description}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-7">
                                                            <div class="about-images mt-3 mt-lg-0">
                                                                <div class="position-relative d-flex justify-content-center">
                                                                        {{ img(file(page.entry.about_img_1_id).make.url).class(\'about_image_1\')|raw }}
                                                                        {{ img(file(page.entry.about_img_2_id).make.url).class(\'about_image_2\')|raw }}
                                                                </div>
                                                                <div class="position-relative d-flex justify-content-center align-items-center">
                                                                    {{ img(file(page.entry.about_img_3_id).make.url).class(\'about_image_3\')|raw }}
                                                                </div>
                                
                                                            </div>
                                                        </div>
                                                    </div>
                                            </section>
                                            <section class="about_services">
                                                <div class="services_head">
                                                    <h2 class="services_title">
                                                        Why Chose Us
                                                    </h2>
                                                    <p class="services_desc">
                                                        We provide full service at every step.
                                                    </p>
                                                </div>
                                                <div class="services_content">
                                                    <div class="row">
                                                    {% for feature in page.entry.features_repeater %}
                                                        <div class="col-md-4 mb-5 mb-lg-0">
															
                                                        {{ img(file(feature.file.id).make.url)|raw }}
                                                            <div class="services_desc">
                                                                {{feature.description|raw}}
                                                            </div>
                                                        </div>
                                                    {% endfor %}
                                                    </div>
                                                </div>
                                
                                            </section>
                                        </div>
                                    </div>
                            ',
                    ],
                ],
                'type' => 'about_us',
                'children' => [],
            ]
        ];

        foreach ($pages as $page) {
            if (!$this->pages->findBySlug($page['content']['slug'])) {
                $type = $this->pageTypes->findBySlug($page['type']);
                $selected_type = [];
                foreach ($page['entry_content'] as $content) {
                    $selected_type = [
                        'type' => $type,
                        'entry' => $type->getEntryModel()->newQuery()->create($content)
                    ];
                }
                $new_page = array_merge($page['content'], $selected_type);
                $this->pages->create($new_page);
            }
        }



        $blockFields = [
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'namespace' => 'blocks',
                'streams' => ['homepage_banners'],
                'type' => 'anomaly.field_type.editor',
                'translatable' => true,
                'config' => [],
            ], [
                'name' => 'Image',
                'slug' => 'image',
                'namespace' => 'blocks',
                'streams' => ['homepage_banners', 'cities'],
                'type' => 'anomaly.field_type.file',
                'translatable' => true,
                'config' => [
                    'folders' => ['banner_images'],
                    'mode' => 'upload',
                ],
            ], [
                'name' => 'City',
                'slug' => 'city',
                'namespace' => 'blocks',
                'streams' => ['cities'],
                'type' => 'anomaly.field_type.relationship',
                'translatable' => false,
                'config' => [
                    'related' => CityModel::class,
                    "default_value" => 0,
                ],
            ], [
                'name' => 'URL',
                'slug' => 'url',
                'namespace' => 'blocks',
                'streams' => ['cities', 'popular_search'],
                'type' => 'anomaly.field_type.url',
                'translatable' => false,
                'config' => []
            ], [
                'name' => 'SearchText',
                'slug' => 'searchtext',
                'namespace' => 'blocks',
                'streams' => ['popular_search'],
                'translatable' => false,
                'type' => 'anomaly.field_type.text',
                'config' => [],
            ]
        ];

        foreach ($blockFields as $blockField) {
            $field = $this->fields->findBySlugAndNamespace($blockField['slug'], 'blocks');
            if (!$field) {
                $field = $this->fields->create([
                    'name' => $blockField['name'],
                    'slug' => $blockField['slug'],
                    'namespace' => $blockField['namespace'],
                    'type' => $blockField['type'],
                    'locked' => 0,
                    'config' => $blockField['config'],
                ]);
            }

            foreach ($blockField['streams'] as $stream) {
                $typeStream = $this->streamRepository->findBySlugAndNamespace($stream . '_blocks', 'blocks');

                if ($typeStream && !$this->assignments->findByStreamAndField($typeStream, $field)) {
                    $this->assignments->create([
                        'stream_id' => $typeStream->getId(),
                        'field_id' => $field->getId(),
                        'translatable' => $blockField['translatable'],
                    ]);
                }
            }
        }

        // Post Fields
        if (!$field = $this->fields->findBySlugAndNamespace('images', 'posts')) {
            $field = $this->fields->create([
                'name' => 'Image',
                'namespace' => 'posts',
                'slug' => 'images',
                'type' => 'anomaly.field_type.file',
                'config' => [
                    'folders' => ['images'],
                ],
                'locked' => 0
            ]);
        }

        if ($type = $this->postType->findBySlug('default')) {
            $stream = $type->getEntryStream();
            if (!$this->assignments->findByStreamAndField($stream, $field)) {
                $this->assignments->create([
                    'translatable' => false,
                    'stream' => $stream,
                    'field' => $field,
                ]);
            }
        }

        // Post
        $repository = new EntryRepository();
        $repository->setModel(new PostsDefaultPostsEntryModel());
        $type = $this->types->findBySlug('default');
        $category = $this->categories->findBySlug('news');

        $posts = [
            [
                'title' => 'İpotekli Evimi Nasıl Satarım?',
                'desc' => 'Yasal olarak borç verme hakkına sahip bankalar veya alacaklı durumdaki kişiler, alacaklarını tahsil etmek adına kimi yollar izlemektedirler ipotekli ev de bunlardan biridir. İpotek yöntemi bu yolların başında gelmektedir. Peki ipotek nedir? İpotek, ‘bir taşınmazın alacağa karşılık güvence olarak tutulması’ anlamına gelmektedir. Yani ödenmesi beklenen borcun karşılığında taşınmazların üzerine konulan şerhtir. Borçlu kişinin yükümlülüğünü yerine getirmemesi halinde, alacaklı taraf taşınmazı satılığa çıkarma yöntemiyle alacağını tahsil edebilme hakkına sahip olabilmektedir. Bu tanımlamadan sonra akla gelen bir diğer soru ipotekli ev satışı için nasıl yollar izlenebileceğidir. Öncelikle bu prosedürün en baştan nasıl işlediği hakkında bilgi vermekte fayda var.  Kredi çekerek ev sahibi olmayı amaçlayan alıcılar, bankalar aracılığıyla konut kredisine başvurabilmektedir. Bu süreçte banka, kredi borcu ödenene kadar mevzubahis evi ipotek eder. Tanımda da bahsedildiği gibi borcun tahsil edilmediği durumda ise bu evi satma hakkına sahip olur. Borç ödendiği zaman da bu ipotek kaldırılır ve kredisini çeken kişi evin sahibi olmuş olur. Peki konut kredisini çeken kişi evini satmak isterse ne gibi bir yol izlemelidir? İpotekli ev nasıl satılır? Bu tarz bir satış iki şekilde gerçekleşebilmektedir.',
                'filename' => '1.jpg',
            ],
            [
                'title' => 'Hayata Açılan Renkli Kapı: Büyükyalı',
                'desc' => 'Yasal olarak borç verme hakkına sahip bankalar veya alacaklı durumdaki kişiler, alacaklarını tahsil etmek adına kimi yollar izlemektedirler ipotekli ev de bunlardan biridir. İpotek yöntemi bu yolların başında gelmektedir. Peki ipotek nedir? İpotek, ‘bir taşınmazın alacağa karşılık güvence olarak tutulması’ anlamına gelmektedir. Yani ödenmesi beklenen borcun karşılığında taşınmazların üzerine konulan şerhtir. Borçlu kişinin yükümlülüğünü yerine getirmemesi halinde, alacaklı taraf taşınmazı satılığa çıkarma yöntemiyle alacağını tahsil edebilme hakkına sahip olabilmektedir. Bu tanımlamadan sonra akla gelen bir diğer soru ipotekli ev satışı için nasıl yollar izlenebileceğidir. Öncelikle bu prosedürün en baştan nasıl işlediği hakkında bilgi vermekte fayda var.  Kredi çekerek ev sahibi olmayı amaçlayan alıcılar, bankalar aracılığıyla konut kredisine başvurabilmektedir. Bu süreçte banka, kredi borcu ödenene kadar mevzubahis evi ipotek eder. Tanımda da bahsedildiği gibi borcun tahsil edilmediği durumda ise bu evi satma hakkına sahip olur. Borç ödendiği zaman da bu ipotek kaldırılır ve kredisini çeken kişi evin sahibi olmuş olur. Peki konut kredisini çeken kişi evini satmak isterse ne gibi bir yol izlemelidir? İpotekli ev nasıl satılır? Bu tarz bir satış iki şekilde gerçekleşebilmektedir.',
                'filename' => '2.jpg',
            ],
            [
                'title' => 'İş Ortağımız Evergreen ile Kıbrıs Emlak Piyasasını Konuştuk',
                'desc' => 'Yasal olarak borç verme hakkına sahip bankalar veya alacaklı durumdaki kişiler, alacaklarını tahsil etmek adına kimi yollar izlemektedirler ipotekli ev de bunlardan biridir. İpotek yöntemi bu yolların başında gelmektedir. Peki ipotek nedir? İpotek, ‘bir taşınmazın alacağa karşılık güvence olarak tutulması’ anlamına gelmektedir. Yani ödenmesi beklenen borcun karşılığında taşınmazların üzerine konulan şerhtir. Borçlu kişinin yükümlülüğünü yerine getirmemesi halinde, alacaklı taraf taşınmazı satılığa çıkarma yöntemiyle alacağını tahsil edebilme hakkına sahip olabilmektedir. Bu tanımlamadan sonra akla gelen bir diğer soru ipotekli ev satışı için nasıl yollar izlenebileceğidir. Öncelikle bu prosedürün en baştan nasıl işlediği hakkında bilgi vermekte fayda var.  Kredi çekerek ev sahibi olmayı amaçlayan alıcılar, bankalar aracılığıyla konut kredisine başvurabilmektedir. Bu süreçte banka, kredi borcu ödenene kadar mevzubahis evi ipotek eder. Tanımda da bahsedildiği gibi borcun tahsil edilmediği durumda ise bu evi satma hakkına sahip olur. Borç ödendiği zaman da bu ipotek kaldırılır ve kredisini çeken kişi evin sahibi olmuş olur. Peki konut kredisini çeken kişi evini satmak isterse ne gibi bir yol izlemelidir? İpotekli ev nasıl satılır? Bu tarz bir satış iki şekilde gerçekleşebilmektedir.',
                'filename' => '3.jpg',
            ],
            [
                'title' => 'Yaşam Alanınızı Ferah Gösterecek Öneriler',
                'desc' => 'Yasal olarak borç verme hakkına sahip bankalar veya alacaklı durumdaki kişiler, alacaklarını tahsil etmek adına kimi yollar izlemektedirler ipotekli ev de bunlardan biridir. İpotek yöntemi bu yolların başında gelmektedir. Peki ipotek nedir? İpotek, ‘bir taşınmazın alacağa karşılık güvence olarak tutulması’ anlamına gelmektedir. Yani ödenmesi beklenen borcun karşılığında taşınmazların üzerine konulan şerhtir. Borçlu kişinin yükümlülüğünü yerine getirmemesi halinde, alacaklı taraf taşınmazı satılığa çıkarma yöntemiyle alacağını tahsil edebilme hakkına sahip olabilmektedir. Bu tanımlamadan sonra akla gelen bir diğer soru ipotekli ev satışı için nasıl yollar izlenebileceğidir. Öncelikle bu prosedürün en baştan nasıl işlediği hakkında bilgi vermekte fayda var.  Kredi çekerek ev sahibi olmayı amaçlayan alıcılar, bankalar aracılığıyla konut kredisine başvurabilmektedir. Bu süreçte banka, kredi borcu ödenene kadar mevzubahis evi ipotek eder. Tanımda da bahsedildiği gibi borcun tahsil edilmediği durumda ise bu evi satma hakkına sahip olur. Borç ödendiği zaman da bu ipotek kaldırılır ve kredisini çeken kişi evin sahibi olmuş olur. Peki konut kredisini çeken kişi evini satmak isterse ne gibi bir yol izlemelidir? İpotekli ev nasıl satılır? Bu tarz bir satış iki şekilde gerçekleşebilmektedir.',
                'filename' => '4.jpg',
            ],
        ];

        foreach ($posts as $post) {

            $entry = (new PostsDefaultPostsEntryModel())->create(
                [
                    'en' => [
                        'content' => $post['desc'],
                    ],
                    'images_id' => $this->setFile($post['filename']),
                ]
            );

            $this->postsRepository->create(
                [
                    'en' => [
                        'title' => $post['title'],
                        'summary' => 'This is an example post to demonstrate the posts module.',
                    ],
                    'slug' => str_slug($post['title']),
                    'publish_at' => time(),
                    'enabled' => true,
                    'type' => $type,
                    'entry' => $entry,
                    'category' => $category,
                    'author' => 1,
                ]
            );
        }


        $advs = [
            [
                'en' => [
                    'name' => 'OSTİM LÜKS YAPILI 2 ADET BİTİŞİK AYRI PARSEL FABRİKA',
                ],
                'slug' => 'ostim',
                'price' => 9830,
                'currency' => 'USD',
                'country_id' => 212,
                'city' => 26,
                'status' => 'approved',
                'cat1' => 3613,
                'publish_at' => now(),
                'finish_at' => '2025-12-10 13:01:22.000000',
            ],
            [
                'en' => [
                    'name' => 'KAMPANYA 1+0 140 tl 1+1 jakuzuli 200 tl PAŞA KONAĞI',
                ],
                'slug' => 'kampanya',
                'price' => 4650,
                'currency' => 'USD',
                'country_id' => 212,
                'city' => 26,
                'status' => 'approved',
                'cat1' => 3613,
                'publish_at' => now(),
                'finish_at' => '2025-12-10 13:01:22.000000',
            ],
            [
                'en' => [
                    'name' => 'BORSEM DİKMEN\'DEN Ç.EMEÇ ÖSYM YAKINI SİTEDE PARK MANZARALI 4+1+KİLER',
                ],
                'slug' => 'borsem',
                'price' => 2138,
                'currency' => 'USD',
                'country_id' => 212,
                'city' => 26,
                'status' => 'approved',
                'cat1' => 3613,
                'publish_at' => now(),
                'finish_at' => '2025-12-10 13:01:22.000000',
            ],
            [
                'en' => [
                    'name' => 'SÖĞÜTÖZÜ VIA TWINS PLAZA YÜKSEK KAT MANZARALI KULLANIŞLI 84 M2 OFİS FIRSATI',
                ],
                'slug' => 'sogutozu',
                'price' => 3000,
                'currency' => 'USD',
                'country_id' => 212,
                'city' => 26,
                'status' => 'approved',
                'cat1' => 3613,
                'publish_at' => now(),
                'finish_at' => '2025-12-10 13:01:22.000000',
            ],
        ];

        foreach ($advs as $key => $adv) {

            $filename = 'restate' . ($key + 1) . '.jpg';
            $this->setFile($filename);
            $adv['cover_photo'] = 'files/images/' . $filename;
            $this->advRepository->create($adv)->getId();
        }
        echo 'Installed!';
    }

    public function setFile($filename)
    {
//        $uploader = app(FileUploader::class);
//
//        $file_path = __DIR__ . '/seed/img/' . $filename;
//        $image = Image::make($file_path);
//
//        $file = new UploadedFile($file_path,
//            $image->basename,
//            $image->mime);
//
//        $folders = app(FolderRepositoryInterface::class);
//        if (($folder = $folders->findBySlug('images')) && $file = $uploader->upload($file, $folder)) {
//            return $file->id;
//        }
    }
}