<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Purifier
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Purifier extends \HTMLPurifier
{

    /**
     * Create a new Purifier instance.
     *
     * @param null $config
     */
    public function __construct($config = null)
    {
        parent::__construct($config);

        $cache = app_storage_path('support/purifier');

        if (!is_dir($cache)) {
            mkdir($cache, 0777, true);
        }

        $this->config->set('Cache.SerializerPath', $cache);
    }

    /**
     * Return purified HTML.
     *
     * @param string $html
     * @param null   $config
     * @return string
     */
    public function purify($html, $config = null)
    {
        /**
         * Replace <pre> and <code> blocks
         * that are complete with placeholders.
         */
        preg_match_all(
            '/\<(pre|code).*?\>(.+?)\<\/\1\>/si',
            $html,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $id => $match) {
            str_replace(
                array_get($match, 0),
                strtoupper(array_get($match, 1)) . '_PLACEHOLDER_' . $id,
                $html
            );
        }

        // Purify!
        $html = parent::purify($html, $config);

        /**
         * Replace the placeholders with the
         * complete <pre> and <code> blocks.
         */
        foreach ($matches as $id => $match) {
            str_replace(
                strtoupper(array_get($match, 1)) . '_PLACEHOLDER_' . $id,
                array_get($match, 0),
                $html
            );
        }

        return $html;
    }

}
