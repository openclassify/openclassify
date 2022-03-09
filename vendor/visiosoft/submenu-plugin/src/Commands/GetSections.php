<?php namespace Visiosoft\SubmenuPlugin\Commands;

use Illuminate\Routing\UrlGenerator;
use Visiosoft\SubmenuPlugin\SubmenuCollection;

class GetSections
{
    protected $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public function handle()
    {
        $module = app('addon.collection')->get($this->namespace);

        $links = new SubmenuCollection();

        $sections = $this->buildSection($module);

        foreach ($sections as $section) {
            $links->add([
                'title' => $section['title'],
                'slug' => $section['slug'],
                'href' => $section['attributes']['href'],
            ]);
        }

        return $links;
    }

    public function buildSection($module)
    {
        $sections = $module->getSections();

        foreach ($sections as $slug => &$section) {
            if (isset($section['sections'])) {
                foreach ($section['sections'] as $key => $child) {

                    /**
                     * It's a slug only!
                     */
                    if (is_string($child)) {

                        $key = $child;

                        $child = ['slug' => $child];
                    }

                    $child['parent'] = array_get($section, 'slug', $slug);
                    $child['slug'] = array_get($child, 'slug', $key);

                    $sections[$key] = $child;
                }
            }
        }

        /*
         * Loop over each section and make sense of the input
         * provided for the given module.
         */
        foreach ($sections as $slug => &$section) {

            /*
             * If the slug is not valid and the section
             * is a string then use the section as the slug.
             */
            if (is_numeric($slug) && is_string($section)) {
                $section = [
                    'slug' => $section,
                ];
            }

            /*
             * If the slug is a string and the title is not
             * set then use the slug as the slug.
             */
            if (is_string($slug) && !isset($section['slug'])) {
                $section['slug'] = $slug;
            }

            /*
             * Make sure we have attributes.
             */
            $section['attributes'] = array_get($section, 'attributes', []);

            /*
             * Move the HREF into attributes.
             */
            if (isset($section['href'])) {
                $section['attributes']['href'] = array_pull($section, 'href');
            }

            /*
             * Move all data-* keys
             * to attributes.
             */
            foreach ($section as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($section, 'attributes.' . $attribute, array_pull($section, $attribute));
                }
            }

            /*
             * Move the data-href into the permalink.
             *
             * @deprecated as of v3.2
             */
            if (!isset($section['permalink']) && isset($section['attributes']['data-href'])) {
                $section['permalink'] = array_pull($section, 'attributes.data-href');
            }

            /*
             * Make sure the HREF and permalink are absolute.
             */
            if (
                isset($section['attributes']['href']) &&
                is_string($section['attributes']['href']) &&
                !starts_with($section['attributes']['href'], 'http')
            ) {
                $section['attributes']['href'] = url($section['attributes']['href']);
            }

            if (
                isset($section['permalink']) &&
                is_string($section['permalink']) &&
                !starts_with($section['permalink'], 'http')
            ) {
                $section['permalink'] = url($section['permalink']);
            }
        }

        $sections = $this->guessHref($module, $sections);
        $sections = $this->guessTitle($module, $sections);

        return $sections;
    }

    public function guessHref($module, $sections)
    {
        $url = app(UrlGenerator::class);

        foreach ($sections as $index => &$section) {

            // If HREF is set then skip it.
            if (isset($section['attributes']['href'])) {
                continue;
            }

            $href = $url->to('admin/' . $module->getSlug());

            if ($index !== 0 && $module->getSlug() !== $section['slug']) {
                $href .= '/' . $section['slug'];
            }

            $section['attributes']['href'] = $href;
        }

        return $sections;
    }

    public function guessTitle($module, $sections)
    {
        foreach ($sections as &$section) {

            // If title is set then skip it.
            if (isset($section['title'])) {
                continue;
            }

            $title = $module->getNamespace('section.' . $section['slug'] . '.title');

            if (!isset($section['title']) && trans()->has($title)) {
                $section['title'] = $title;
            }

            $title = $module->getNamespace('addon.section.' . $section['slug']);

            if (!isset($section['title']) && trans()->has($title)) {
                $section['title'] = $title;
            }

            if (!isset($section['title']) && config('streams::system.lazy_translations')) {
                $section['title'] = ucwords(humanize($section['slug']));
            }

            if (!isset($section['title'])) {
                $section['title'] = $title;
            }
        }

        return $sections;
    }
}
