<?php namespace Anomaly\Streams\Platform\Http\Command;

use Illuminate\Http\Request;

/**
 * Class ConfigureRequest
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureRequest
{

    /**
     * Handle the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        if (config('streams::system.force_ssl')) {
            $request->server->set('HTTPS', true);
        }
    }
}
