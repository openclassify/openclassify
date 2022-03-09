<?php namespace Anomaly\Streams\Platform\Http;

use Anomaly\Streams\Platform\Http\Command\ClearHttpCache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\TerminableInterface;

/**
 * Class HttpCache
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HttpCache extends \Symfony\Component\HttpKernel\HttpCache\HttpCache implements TerminableInterface
{

    use DispatchesJobs;

    /**
     * Purge a path from cache.
     *
     * @param $path
     */
    public function purge($path)
    {
        $this
            ->getStore()
            ->purge($path);

        foreach (config('streams::locales.enabled') as $locale) {
            $this
                ->getStore()
                ->purge("/{$locale}" . $path);
        }
    }

    /**
     * Clear httpcache cache.
     */
    public function clear()
    {
        $this->dispatchNow(new ClearHttpCache());
    }

    /**
     * Terminate the request.
     *
     * @param Request $request
     * @param Response $response
     */
    public function terminate(Request $request, Response $response)
    {
        $this->getKernel()->terminate($request, $response);
    }

}
