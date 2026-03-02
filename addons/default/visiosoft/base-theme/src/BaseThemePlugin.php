<?php namespace Visiosoft\BaseTheme;
    use Anomaly\PagesModule\Page\Command\GetPage;
    use Anomaly\PagesModule\Page\Command\RenderNavigation;
    use Anomaly\PagesModule\Page\PageModel;
    use Anomaly\PagesModule\PagesModuleCriteria;
    use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
    use Anomaly\Streams\Platform\Support\Collection;
    use Anomaly\Streams\Platform\Support\Decorator;
    use Illuminate\Support\Facades\DB;
    use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;

    class BaseThemePlugin extends Plugin{

        public function getFunctions()
        {
            return [
                new \Twig_SimpleFunction(
                    'searchPost',
                    function ($keyword) {

                        $post_repository = app(PostRepositoryInterface::class);

                        $post_ids =  DB::table('posts_posts_translations')
                            ->where('posts_posts_translations.locale', config('app.locale'))
                            ->where('posts_posts_translations.title', 'LIKE', '%'. $keyword. '%')
                            ->pluck('entry_id')
                            ->toArray();

                        return $post_repository->newQuery()
                            ->whereIn('posts_posts.id', $post_ids);
                    }
                ),
            ];
        }
    }