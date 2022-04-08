<?php namespace Anomaly\EmailFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Collective\Html\HtmlBuilder;

/**
 * Class EmailFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EmailFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The HTML builder.
     *
     * @var HtmlBuilder
     */
    protected $html;

    /**
     * Create a new EmailFieldTypePresenter instance.
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
     * Return an HTML mailto link.
     *
     * @param  null|string $text
     * @param array $attributes
     * @return null|string
     */
    public function mailto($text = null, array $attributes = [])
    {
        if (!$email = $this->object->getValue()) {
            return null;
        }

        return $this->html->mailto($email, $text, $attributes);
    }

    /**
     * Return the obfuscated email.
     *
     * @return null|string
     */
    public function obfuscated()
    {
        if (!$email = $this->object->getValue()) {
            return null;
        }

        return $this->html->obfuscate($email);
    }
}
