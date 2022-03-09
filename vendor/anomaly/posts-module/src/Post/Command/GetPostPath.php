<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Support\Value;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GetPostPath
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetPostPath
{

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    protected $post;

    /**
     * Return the path for a post.
     *
     * @param PostInterface $post
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command.
     *
     * @param  Repository $config
     * @param  Resolver   $resolver
     * @param  Evaluator  $evaluator
     * @param  Value      $value
     * @return string
     */
    public function handle(Repository $config, Resolver $resolver, Evaluator $evaluator, Value $value)
    {
        $base = '/' . $config->get('anomaly.module.posts::paths.module');

        if (!$this->post->isLive()) {
            return $base . '/preview/' . $this->post->getStrId();
        }

        return $base . '/' . $value->make(
            $evaluator->evaluate(
                $resolver->resolve(
                    $config->get('anomaly.module.posts::paths.permalink'),
                    ['post' => $this->post]
                ),
                ['post' => $this->post]
            ),
            $this->post
        );
    }
}
