<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Carbon\Carbon;
use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Config\Repository;

/**
 * Class PostPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostPresenter extends EntryPresenter
{

    /**
     * The HTML builder.
     *
     * @var HtmlBuilder
     */
    protected $html;

    /**
     * The decorated post.
     *
     * @var PostInterface
     */
    protected $object;

    /**
     * The config repository.
     *
     * @var Repository
     */
    private $config;

    /**
     * Create a new PostPresenter instance.
     *
     * @param HtmlBuilder $html
     * @param Repository  $config
     * @param             $object
     */
    public function __construct(HtmlBuilder $html, Repository $config, $object)
    {
        $this->html   = $html;
        $this->config = $config;

        parent::__construct($object);
    }

    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function date()
    {
        return $this->object->getPublishAt();
    }

    /**
     * Return the tag links.
     *
     * @param  array  $attributes
     * @return string
     */
    public function tagLinks(array $attributes = [])
    {
        array_set($attributes, 'class', array_get($attributes, 'class', 'label label-default'));

        return array_map(
            function ($label) use ($attributes) {
                return $this->html->link(
                    implode(
                        '/',
                        [
                            $this->config->get('anomaly.module.posts::paths.module'),
                            $this->config->get('anomaly.module.posts::paths.tag'),
                            $label,
                        ]
                    )
                    ,
                    $label,
                    $attributes
                );
            },
            (array)$this->object->getTags()
        );
    }

    /**
     * Return the user's status as a label.
     *
     * @param  string      $size
     * @return null|string
     */
    public function statusLabel($size = 'sm')
    {
        $color  = 'default';
        $status = $this->status();

        switch ($status) {
            case 'scheduled':
                $color = 'info';
                break;

            case 'draft':
                $color = 'default';
                break;

            case 'live':
                $color = 'success';
                break;
        }

        return '<span class="tag tag-' . $size . ' tag-' . $color . '">' . trans(
            'anomaly.module.posts::field.status.option.' . $status
        ) . '</span>';
    }

    /**
     * Return the status key.
     *
     * @return null|string
     */
    public function status()
    {
        if (!$this->object->isEnabled()) {
            return 'draft';
        }

        if ($this->object->isEnabled() && !$this->object->isLive()) {
            return 'scheduled';
        }

        if ($this->object->isEnabled() && $this->object->isLive()) {
            return 'live';
        }

        return null;
    }

    /**
     * Catch calls to fields on
     * the page's related entry.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return parent::__get($key);
    }
}
