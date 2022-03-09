<?php namespace Anomaly\ThrottleSecurityCheckExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;

/**
 * Class MakeResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MakeResponse
{

    /**
     * Handle the command.
     *
     * @param  SettingRepositoryInterface                 $settings
     * @param  ResponseFactory                            $response
     * @param  Factory                                    $view
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(SettingRepositoryInterface $settings, ResponseFactory $response, Factory $view)
    {
        $lockoutInterval = $settings->value('anomaly.extension.throttle_security_check::lockout_interval', 1);

        return $response->make($view->make('streams::errors/429', []), 429)->setTtl($lockoutInterval * 1);
    }
}
