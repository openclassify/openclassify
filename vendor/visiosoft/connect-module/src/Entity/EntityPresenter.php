<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Support\Presenter;
use Collective\Html\EntityBuilder as Html;
use Illuminate\View\Factory;
use Illuminate\View\View;

/**
 * Class EntityPresenter
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityPresenter extends Presenter
{

    /**
     * The entity HTML builder.
     *
     * @var Html
     */
    protected $html;

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var Entity
     */
    protected $object;

    /**
     * Create a new EntityPresenter instance.
     *
     * @param Html    $entity
     * @param Factory $view
     * @param         $object
     */
    public function __construct(Html $entity, Factory $view, $object)
    {
        $this->html = $entity;
        $this->view = $view;

        parent::__construct($object);
    }

    /**
     * Return the opening entity tag.
     *
     * @param array $options
     * @return string
     */
    public function open(array $options = [])
    {
        if ($url = $this->object->getOption('url')) {
            $options['url'] = $url;
        }

        return $this->html->open($options);
    }

    /**
     * Return the closing entity tag.
     *
     * @return string
     */
    public function close()
    {
        return $this->html->close();
    }

    /**
     * Return the entity layout.
     *
     * @param null $view
     * @return string
     */
    public function renderFields($view = null)
    {
        return $this->view
            ->make($view ?: 'streams::entity/partials/fields', ['entity' => $this->object])
            ->render();
    }

    /**
     * Return the action buttons.
     *
     * @param null $view
     * @return string
     */
    public function renderActions($view = null)
    {
        return $this->view
            ->make($view ?: 'streams::buttons/buttons', ['buttons' => $this->object->getActions()])
            ->render();
    }

    /**
     * Display the entity content.
     *
     * @return string
     */
    function __toString()
    {
        $content = $this->object->getContent();

        if ($content instanceof View) {
            return $content->render();
        }

        return '';
    }
}
