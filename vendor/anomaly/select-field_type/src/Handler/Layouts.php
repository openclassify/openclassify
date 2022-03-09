<?php namespace Anomaly\SelectFieldType\Handler;

use Anomaly\SelectFieldType\Event\SetLayoutOptions;
use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Support\Str;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Layouts
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Layouts
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param ThemeCollection $themes
     * @param Repository      $config
     * @param Filesystem      $files
     * @param Str             $str
     */
    public function handle(
        SelectFieldType $fieldType,
        ThemeCollection $themes,
        Repository $config,
        Filesystem $files,
        Str $str
    ) {

        /**
         * If for some reason we don't
         * have a theme specified or
         * if it can't be found..
         */
        if (!$theme = $themes->get($config->get('streams::themes.standard'))) {
            return;
        }

        /**
         * If the layouts folder
         * doesn't exist then skip
         * all the noise below.
         */
        if (!$files->isDirectory($directory = $theme->getPath('resources/views/layouts'))) {

            $fieldType->setOptions([]);

            event(new SetLayoutOptions($fieldType));

            return;
        }

        $layouts = $files->allFiles($directory = $theme->getPath('resources/views/layouts'));

        $prefix = $theme->getPath('resources/views');

        $options = array_combine(
            array_map(
                function ($path) use ($prefix) {

                    $path = str_replace($prefix, '', $path);
                    $path = trim($path, '/\\');
                    $path = str_replace(basename($path), basename(pathinfo($path, PATHINFO_FILENAME), '.blade'), $path);
                    $path = str_replace(DIRECTORY_SEPARATOR, '.', $path);

                    return 'theme::' . $path;
                },
                $layouts
            ),
            array_map(
                function ($path) use ($directory, $prefix, $str) {

                    $path = str_replace($prefix, '', $path);
                    $path = trim($path, '/\\');
                    $path = str_replace(basename($path), basename(pathinfo($path, PATHINFO_FILENAME), '.blade'), $path);
                    $path = str_replace(DIRECTORY_SEPARATOR, '/', $path);

                    return 'theme::' . $path;
                },
                $layouts
            )
        );

        $fieldType->setOptions(['streams::addon.theme' => $options]);

        event(new SetLayoutOptions($fieldType));
    }

}
