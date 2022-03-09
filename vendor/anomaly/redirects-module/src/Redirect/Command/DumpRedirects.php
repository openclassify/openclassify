<?php namespace Anomaly\RedirectsModule\Redirect\Command;

use Anomaly\RedirectsModule\Redirect\Contract\RedirectInterface;
use Anomaly\RedirectsModule\Redirect\Contract\RedirectRepositoryInterface;
use Anomaly\Streams\Platform\Routing\Command\CacheRoutes;

/**
 * Class DumpRedirects
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DumpRedirects
{

    /**
     * Handle the command.
     *
     * @param RedirectRepositoryInterface $redirects
     */
    public function handle(RedirectRepositoryInterface $redirects)
    {
        $file = app_storage_path('redirects/routes.php');

        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        $content = join(
            "\n\n",
            $redirects
                ->sorted()
                ->map(
                    function (RedirectInterface $redirect) {
                        return "Route::any('{$redirect->getFrom()}', [
    'uses'     => 'Anomaly\\RedirectsModule\\Http\\Controller\\RedirectsController@handle',
    'redirect' => {$redirect->getId()},
])->where([
    'any'  => '(.*)',
    'path' => '(.*)',
]);";
                    }
                )->all()
        );

        file_put_contents($file, "<?php\n\n" . $content);

        dispatch_now(new CacheRoutes());
    }
}
