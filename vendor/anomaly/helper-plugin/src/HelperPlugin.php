<?php

namespace Anomaly\HelperPlugin;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class HelperPlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class HelperPlugin extends Plugin
{

    /**
     * Available helper functions.
     *
     * @var array
     */
    protected $functions = [
        'addslashes'              => [],
        'array_dot'               => [],
        'array_filter'            => [],
        'array_diff'              => [],
        'array_diff_key'          => [],
        'array_merge'             => [],
        'array_merge_recursive'   => [],
        'array_search'            => [],
        'base_path'               => [],
        'base64_encode'           => [],
        'base64_decode'           => [],
        'ceil'                    => [],
        'count'                   => [],
        'dump'                    => [
            'is_safe' => ['html'],
        ],
        'dd'                      => [
            'is_safe' => ['html'],
        ],
        'empty'                   => [],
        'explode'                 => [],
        'floor'                   => [],
        'get_class'               => [],
        'html_entity_decode'      => [],
        'htmlentities'            => [],
        'htmlspecialchars'        => [],
        'htmlspecialchars_decode' => [],
        'http_build_str'          => [],
        'http_build_query'        => [],
        'implode'                 => [],
        'is_array'                => [],
        'is_int'                  => [],
        'is_integer'              => [],
        'is_string'               => [],
        'json_encode'             => [],
        'json_decode'             => [],
        'ltrim'                   => [],
        'md5'                     => [],
        'memory_get_usage'        => [],
        'mix'                     => [],
        'mt_rand'                 => [],
        'nl2br'                   => [],
        'parse_url'               => [],
        'pathinfo'                => [],
        'preg_match'              => [],
        'preg_replace'            => [],
        'print_r'                 => [],
        'round'                   => [],
        'rtrim'                   => [],
        'serialize'               => [],
        'sprintf'                 => [],
        'str_pad'                 => [],
        'strtok'                  => [],
        'str_replace'             => [],
        'str_word_count'          => [],
        'strip_tags'              => [],
        'strpos'                  => [],
        'strtolower'              => [],
        'strtoupper'              => [],
        'substr'                  => [],
        'trim'                    => [],
        'ucfirst'                 => [],
        'ucwords'                 => [],
        'unserialize'             => [],
        'urlencode'               => [],
        'urldecode'               => [],
        'var_export'              => [],
        'var_dump'                => [],
        'vsprintf'                => [],
    ];

    /**
     * Return plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        array_walk(
            $this->functions,
            function (&$value, $key) {
                $value = new \Twig_SimpleFunction($key, $key, $value);
            }
        );

        $this->functions[] = new \Twig_SimpleFunction(
            'parse_str',
            function ($string) {

                $array = [];

                parse_str($string, $array);

                return $array;
            }
        );

        $this->functions[] = new \Twig_SimpleFunction(
            'abort',
            function ($code, $message = '') {
                abort($code, $message);
            }
        );

        $this->functions[] = new \Twig_SimpleFunction(
            'die',
            function ($message = null) {
                die($message);
            }
        );

        return $this->functions;
    }
}
