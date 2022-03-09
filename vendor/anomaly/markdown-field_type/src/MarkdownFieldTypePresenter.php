<?php namespace Anomaly\MarkdownFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Markdown;
use Anomaly\Streams\Platform\Support\Str;
use Anomaly\Streams\Platform\Support\Template;

/**
 * Class MarkdownFieldTypePresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MarkdownFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The string utility.
     *
     * @var Str
     */
    protected $str;

    /**
     * The template parser.
     *
     * @var Template
     */
    protected $template;

    /**
     * The decorated field type.
     * This is for IDE hinting.
     *
     * @var MarkdownFieldType
     */
    protected $object;

    /**
     * Create a new MarkdownFieldTypePresenter instance.
     *
     * @param Str $str
     * @param Template $template
     * @param          $object
     */
    public function __construct(Str $str, Template $template, $object)
    {
        $this->template = $template;
        $this->str      = $str;

        parent::__construct($object);
    }

    /**
     * Return the applicable path.
     *
     * @return null|string
     */
    public function path()
    {
        return $this->object->getAssetPath();
    }

    /**
     * Return the rendered content.
     *
     * @return string
     */
    public function render(array $payload = [])
    {
        return (string)$this->template->render($this->parse(), (new Decorator())->decorate($payload));
    }

    /**
     * Return the parsed content.
     *
     * @param  array $payload
     * @return string
     */
    public function parse()
    {
        return (new Markdown())->parse($this->object->getValue());
    }

    /**
     * Return the file contents.
     *
     * @return string
     */
    public function content()
    {
        return $this->object->getValue();
    }

    /**
     * Return an excerpt of the text.
     *
     * @param  int $length
     * @param  string $ending
     * @return string
     */
    public function excerpt($length = 100, $ending = '...')
    {
        return $this->str->truncate($this->text(), $length, $ending);
    }

    /**
     * Return the text from the content.
     *
     * @param  null $allowed
     * @return string
     */
    public function text($allowed = null)
    {
        return strip_tags($this->content(), $allowed);
    }

    /**
     * Return the parsed content.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
