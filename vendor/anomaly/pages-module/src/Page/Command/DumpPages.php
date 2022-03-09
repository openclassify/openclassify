<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\Streams\Platform\Routing\Command\CacheRoutes;

/**
 * Class DumpPages
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DumpPages
{

    /**
     * Handle the command.
     *
     * @param PageRepositoryInterface $pages
     */
    public function handle(PageRepositoryInterface $pages)
    {
        $file = app_storage_path('pages/routes.php');

        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        $content = join(
            "\n\n",
            $pages
                ->routable()
                ->map(
                    function (PageInterface $page) {
                        return $page
                            ->getHandler()
                            ->route($page);
                    }
                )->all()
        );

        file_put_contents($file, "<?php\n\n" . $content);

        dispatch_now(new CacheRoutes());
    }
}
