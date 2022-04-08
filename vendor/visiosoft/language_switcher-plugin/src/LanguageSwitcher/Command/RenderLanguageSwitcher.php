<?php namespace Visiosoft\LanguageSwitcherPlugin\LanguageSwitcher\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

/**
 * Class RenderLanguageSwitcher
 * @package Visiosoft\LanguageSwitcherPlugin\LanguageSwitcher\Command
 */
class RenderLanguageSwitcher
{
    use DispatchesJobs;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var array
     */
    public $options;

    /**
     * RenderLanguageSwitcher constructor.
     * @param string $type
     * @param array $options
     */
    public function __construct(string $type, array $options)
    {
        // Set type and filesystem
        $this->type = $type;
        $this->filesystem         = new Filesystem;

        // Get all options. Assign default values to options which are not passed.
        $this->options = [
            'container_class'   => $options['container_class'] ?? 'dropdown',
            'toggle_class'      => $options['toggle_class']    ?? ($type == 'li' ? 'dropdown' : 'btn btn-primary dropdown-toggle'),
            'toggle_title'      => $options['toggle_title']    ?? false,
            'ul_class'          => $options['ul_class']        ?? 'dropdown-menu',
            'li_class'          => $options['li_class']        ?? '',
            'a_class'           => $options['a_class']         ?? '',
            'pecl'              => $options['pecl']            ?? true
        ];
    }


    /**
     * Checks three locations for a views folder or throws an exception
     * @return string
     * @throws Exception
     */
    protected function findViewFolder()
    {
        $composer_folder   = base_path() . '/vendor/visiosoft/language_switcher-plugin/resources/views'; // The location of the views if the user installed the plugin using composer
        $manual_folder     = base_path() . '/addons/' . env('APPLICATION_REFERENCE') . '/visiosoft/language_switcher-plugin/resources/views'; // The location of the views if the user installed the plugin manually
        $published_folder  = base_path() . '/resources' . env('APPLICATION_REFERENCE') . 'addons/visiosoft/language_switcher-plugin/views'; // The locations of the views if the user published the views

        $targets = [$composer_folder, $manual_folder, $published_folder];


        // Loop trough targets and see if the folder exists
        foreach ($targets as $target) {
            if ($this->filesystem->exists($target)) {
                return (string) $target;
            };
        }

        // If we can't find it throw a new exception
        throw new Exception("[language_switcher-plugin] Couldn't find view folder.");
    }


    /**
     * @param SettingRepositoryInterface $settings
     * @param Request $request
     * @param Repository $config
     * @return mixed
     */
    public function handle(
        SettingRepositoryInterface $settings,
        Request $request,
        Repository $config
    ) {
        $locales          = $settings->value('streams::enabled_locales'); // Get an array of all currently enables locales.
        $current_path     = $request->path(); // Get the current request path. For example /pages/some-page-title
        $current_locale   = $config->get('app.locale'); // Get the current request locale.
        $prefered_locale  = $request->server('HTTP_ACCEPT_LANGUAGE'); // Extract http_accept_lang from the request
        $prefered_locale  = strtolower(substr($prefered_locale, 0, strpos($prefered_locale, ','))); // Get the first prefered lang out of the string
        $prefered_enabled = in_array($prefered_locale, $locales); // Check if the prefered locale is enabled in pyro
        $prefered_url     = url()->locale($current_path,$prefered_locale); // Get the current url with the prefered locale
        $toggle_title     = $this->options['toggle_title'] ? $this->options['toggle_title'] : $current_locale . " <span class='caret'></span>"; // If the user has passed a button title set it, else default to the currently enabled locale.
        $custom_title     = $this->options['toggle_title'] != false; // Check if the user has set a custom title. Used in building the ul of locales

        // Loopps trough the views
        foreach ($this->filesystem->allFiles($this->findViewFolder()) as $file) {
            // Use the names of the views as networks
            $types[] = $file->getBaseName('.' . $file->getExtension());
        }

        if (($key = array_search($current_locale, $locales)) !== false && !$custom_title) {
            // If the user has not set a button title we're going to use the currently enabled locale as title
            // here we unset it to prevent the locale from showing up both as a list item and title
            unset($locales[$key]);
        }


        foreach ($locales as $key => $locale) {
            $locale_url = url()->locale($current_path,$locale); // Generate a url to the current page with the new locale
            $locales[$key] = [
                'url'  => $locale_url,
                'name' => $locale
            ];
        }

        $data = [
            'container' => [ 'class' => $this->options['container_class'] ],
            'toggle'    => [ 'class' => $this->options['toggle_class'], 'title' => $toggle_title ],
            'ul'        => [ 'class' => $this->options['ul_class'] ],
            'li'        => [ 'class' => $this->options['li_class'] ],
            'a'         => [ 'class' => $this->options['a_class'] ],
            'custom'    => [ 'title' => $custom_title],
            'locales'   => $locales,
            'current'   => [
                'locale'   => $current_locale
            ],
            'prefered' => [
                'locale'   => $prefered_locale,
                'enabled'  => $prefered_enabled,
                'url'      => $prefered_url
            ]
        ];

        if ($this->options['pecl']) {
            $data['current']['country'] = locale_get_display_region("-$current_locale");
            $data['current']['language'] = locale_get_display_language("$current_locale");
            $data['prefered']['country']  = locale_get_display_region("-$prefered_locale");
            $data['prefered']['language'] = locale_get_display_language("$prefered_locale");
        }

        return view("visiosoft.plugin.language_switcher::$this->type", $data);
    }
}

?>
