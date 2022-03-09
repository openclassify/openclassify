<?php namespace Anomaly\UrlFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Collective\Html\HtmlBuilder;

/**
 * Class UrlFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UrlFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The HTML builder.
     *
     * @var HtmlBuilder
     */
    protected $html;

    /**
     * The decorated object.
     *
     * @var UrlFieldType
     */
    protected $object;

    /**
     * Create a new UrlFieldTypePresenter instance.
     *
     * @param HtmlBuilder $html
     * @param             $object
     */
    public function __construct(HtmlBuilder $html, $object)
    {
        $this->html = $html;

        parent::__construct($object);
    }


    /**
     * Return the parsed query string.
     *
     * @param  null $key
     * @return null|mixed
     */
    public function query($key = null)
    {
        if (!$parsed = $this->parsed()) {
            return null;
        }

        parse_str(array_get($parsed, 'query'), $query);

        if ($key) {
            return array_get($query, $key);
        }

        return $query;
    }

    /**
     * Return the parsed URL.
     *
     * @param  null $key
     * @return array|null
     */
    public function parsed($key = null)
    {
        if ($url = $this->object->normalize()) {

            $parsed = parse_url($url);

            if ($key) {
                return array_get($parsed, $key);
            }

            return $parsed;
        }

        return null;
    }

    /**
     * Return a link.
     *
     * @param  null $text
     * @return bool
     */
    public function link($title = null, $attributes = [])
    {
        if (!$url = $this->object->normalize()) {
            return null;
        }

        if (!$title) {
            $title = $this->object->normalize();
        }

        return $this->html->link($url, $title, $attributes);
    }

    /**
     * Return the URL to the provided path.
     *
     * @param  null $path
     * @return null|string
     */
    public function to($path = null)
    {
        if (!$this->object->getValue()) {
            return null;
        }

        $scheme = $this->parsed('scheme');
        $host   = $this->parsed('host');
        $port   = $this->parsed('port');

        $port = $port ? ':' . $port : null;
        $path = $path ? '/' . $path : null;

        return "{$scheme}://{$host}{$port}{$path}";
    }

    /**
     * Normalize the URL by default.
     *
     * @return bool|string
     */
    public function __toString()
    {
        return (string)$this->object->normalize() ?: '';
    }

}
