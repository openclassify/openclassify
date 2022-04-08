<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Support\Markdown;
use Anomaly\Streams\Platform\Support\Template;

/**
 * Class EditorFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EditorFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated field type.
     * This is for IDE hinting.
     *
     * @var EditorFieldType
     */
    protected $object;

    /**
     * The template parser.
     *
     * @var Template
     */
    protected $template;

    /**
     * Create a new EditorFieldTypePresenter instance.
     *
     * @param Template $template
     * @param          $object
     */
    public function __construct(Template $template, $object)
    {
        $this->template = $template;

        parent::__construct($object);
    }

    /**
     * Return the applicable path.
     *
     * @return null|string
     */
    public function path()
    {
        if (in_array($this->object->extension(), ['html', 'twig', 'md'])) {
            return $this->object->getViewPath();
        } else {
            return $this->object->getAssetPath();
        }
    }

    /**
     * Return the rendered content.
     *
     * @param  array $payload
     * @return string
     */
    public function render(array $payload = [])
    {
        return (string)$this->template->render($this->parse(), $payload);
    }

    /**
     * Return the parsed content.
     *
     * @param  array $payload
     * @return string
     */
    public function parse()
    {
        if ($this->object->extension() == 'md') {
            return (new Markdown())->parse($this->object->getValue());
        }

        return $this->object->getValue();
    }

    /**
     * Return the content.
     *
     * @return string
     */
    public function content()
    {
        return $this->object->getValue();
    }

    /**
     * Return the parsed content.
     *
     * @return string
     */
    public function __toString()
    {        
        if (in_array($this->object->extension(), ['html', 'twig', 'md'])) {
            return $this->render();
        } else {
            return $this->content();
        }
    }
}
