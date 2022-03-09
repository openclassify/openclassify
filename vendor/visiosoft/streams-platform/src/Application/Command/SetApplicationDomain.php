<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;

/**
 * Class SetApplicationDomain
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetApplicationDomain
{

    /**
     * Handle the command.
     *
     * @param UrlGenerator $url
     * @param Repository $config
     * @param Request $request
     */
    public function handle(UrlGenerator $url, Repository $config, Request $request)
    {
        if (PHP_SAPI == 'cli') {

            $force = $config->get('streams::system.force_ssl', false);

            $protocol = 'http';

            if ($request->isSecure() || $force) {
                $protocol = 'https';
            }

            $config->set('app.url', $root = $protocol . '://' . $config->get('streams::system.domain'));

            $url->forceRootUrl($root);
        }
    }
}
