<?php namespace Anomaly\WysiwygFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Support\Str;
use Anomaly\Streams\Platform\Support\Template;
use Illuminate\View\Factory;

/**
 * Class WysiwygFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WysiwygFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The string utility.
     *
     * @var Str
     */
    protected $str;

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

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
     * @var WysiwygFieldType
     */
    protected $object;

    /**
     * Create a new EditorFieldTypePresenter instance.
     *
     * @param Str $str
     * @param Factory $view
     * @param Template $template
     * @param          $object
     */
    public function __construct(Str $str, Factory $view, Template $template, $object)
    {
        $this->str      = $str;
        $this->view     = $view;
        $this->template = $template;

        parent::__construct($object);
    }

    /**
     * Return the namespaced path.
     *
     * @return null|string
     */
    public function path()
    {
        return $this->object->getViewPath();
    }

    /**
     * Return the rendered content.
     *
     * @param  array $payload
     * @return string
     */
    public function render(array $payload = [])
    {
        try {
            return $this->template->render($this->object->getValue(), $payload)->render();
        } catch (\Exception $e) {
            return $this->object->getValue();
        }
    }

    /**
     * Return the parsed content.
     *
     * @param  array $payload
     * @return string
     */
    public function parse(array $payload = [])
    {
        return $this->render($payload);
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
