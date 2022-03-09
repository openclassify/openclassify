<?php namespace Anomaly\Streams\Platform\Support;

use Illuminate\Support\Arr;
use VStelmakh\UrlHighlight\Encoder\HtmlSpecialcharsEncoder;
use VStelmakh\UrlHighlight\Highlighter\HtmlHighlighter;
use VStelmakh\UrlHighlight\UrlHighlight;

/**
 * Class Str
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Str extends \Illuminate\Support\Str
{

    /**
     * Return a humanized string.
     *
     * @param         $value
     * @param  string $separator
     * @return string
     */
    public function humanize($value, $separator = '_')
    {
        return preg_replace('/[' . $separator . ']+/', ' ', strtolower(trim($value)));
    }

    /**
     * Limit the number of characters in a string
     * while preserving words.
     *
     * https://github.com/laravel/framework/pull/3547/files
     *
     * @param  string $value
     * @param  int    $limit
     * @param  string $end
     * @return string
     */
    public function truncate($value, $limit = 100, $end = '...')
    {
        if (strlen($value) <= $limit) {
            return $value;
        }

        $parts = preg_split('/([\s\n\r]+)/', $value, null, PREG_SPLIT_DELIM_CAPTURE);
        $count = count($parts);

        $last   = 0;
        $length = 0;

        for (; $last < $count; ++$last) {
            $length += strlen($parts[$last]);

            if ($length > $limit) {
                break;
            }
        }

        return trim(implode(array_slice($parts, 0, $last))) . $end;
    }

    /**
     * Linkify the provided text.
     *
     * @param       $text
     * @param array $options
     * @return string
     */
    public function linkify($text, array $options = [])
    {
        $encoder = new HtmlSpecialcharsEncoder();
        $highlighter = new HtmlHighlighter('http', Arr::get($options, 'attr', []));
        $urlHighlight = new UrlHighlight(null, $highlighter, $encoder);
        return $urlHighlight->highlightUrls($text);
    }

    /**
     * Return purified HTML.
     *
     * @param $html
     * @return string
     */
    public function purify($html)
    {
        return app(Purifier::class)->purify($html);
    }
}
