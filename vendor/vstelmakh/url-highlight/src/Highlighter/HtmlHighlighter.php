<?php

namespace VStelmakh\UrlHighlight\Highlighter;

use InvalidArgumentException;
use VStelmakh\UrlHighlight\Matcher\UrlMatch;
use VStelmakh\UrlHighlight\Util\LinkHelper;

class HtmlHighlighter implements HighlighterInterface
{
    /**
     * @var string
     */
    private $defaultScheme;

    /**
     * @var string $attributes
     */
    private $attributes;

    /**
     * @param string $defaultScheme Used to build href for urls matched without scheme
     * @param array&string[] $attributes Key/value map of tag attributes
     */
    public function __construct(string $defaultScheme, array $attributes = [])
    {
        $this->defaultScheme = $defaultScheme;
        $this->attributes = $this->buildAttributes($attributes);
    }

    /**
     * Return html link highlight
     * Example: <a href="http://example.com">http://example.com</a>
     *
     * @param UrlMatch $match
     * @return string
     */
    public function getHighlight(UrlMatch $match): string
    {
        $link = LinkHelper::getLink($match, $this->defaultScheme);
        $linkSafeQuotes = str_replace('"', '%22', $link);
        return sprintf('<a href="%s"%s>%s</a>', $linkSafeQuotes, $this->attributes, $match->getFullMatch());
    }

    /**
     * Filter highlight in tag attributes, e.g href, src... and in <a> tags text
     *
     * @param string $string
     * @return string
     */
    public function filterOverhighlight(string $string): string
    {
        $string = $this->filterHighlightInTagAttributes($string);
        $string = $this->filterHighlightInLinks($string);
        return $string;
    }

    /**
     * Convert attributes array to attributes string
     *
     * @param array&string[] $attributes
     * @return string
     */
    private function buildAttributes(array $attributes): string
    {
        $result = [];
        foreach ($attributes as $key => $value) {
            // According to html5 parser spec: https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
            $isValidAttributeName = !preg_match_all('/[\t\n\f \/>"\'=]/', $key, $matches);
            if (!$isValidAttributeName) {
                $invalidChars = array_unique($matches[0]);
                throw new InvalidArgumentException(sprintf(
                    'Attribute name %s contains invalid characters: %s',
                    json_encode($key),
                    json_encode(implode(', ', $invalidChars))
                ));
            }

            $valueSafeQuotes = str_replace('"', '&quot;', $value);
            $result[] = sprintf('%s="%s"', $key, $valueSafeQuotes);
        }
        return empty($result) ? '' : ' ' . implode(' ', $result);
    }

    /**
     * Filter a tags in html attributes
     * Example: <a href="<a href="http://example.com">http://example.com</a>">http://example.com</a>
     * Result: <a href="http://example.com">http://example.com</a>
     *
     * @param string $string
     * @return string
     */
    private function filterHighlightInTagAttributes(string $string): string
    {
        $regex = '/
            (
                <\w+\s[^>]+                              # tag start: "<tag"
                \w\s?=\s?[\'"]                           # attribute start: "href=""
            )
            <a\s[^>]*href=[\'"].*[\'"][^>]*>([^<]*)<\/a> # html link: "<a href="#"><\/a>"
            (
                [\'"]                                    # attribute end: """
                [^>]*>                                   # tag end: ">"
            )
        /ixuU';

        return preg_replace($regex, '$1$2$3', $string) ?? $string;
    }

    /**
     * Filter a tags in a tags
     * Example: <a href="#"><a href="http://example.com">http://example.com</a></a>
     * Result: <a href="#"http://example.com">http://example.com</a>
     *
     * @param string $string
     * @return string
     */
    private function filterHighlightInLinks(string $string): string
    {
        $regex = '/
            (<a[^>]*>)                 # parent tag start "<a"
            <a[^>]*>([^<]*)<\s*\/\s*a> # child tag "<a><\/a>"
            (<\s*\/\s*a>)              # parent tag end "<\/a>"
        /ixuU';

        return preg_replace($regex, '$1$2$3', $string) ?? $string;
    }
}
