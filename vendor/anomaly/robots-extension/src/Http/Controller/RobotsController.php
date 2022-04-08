<?php namespace Anomaly\RobotsExtension\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Template;

/**
 * Class RobotsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RobotsExtension\Http\Controller
 */
class RobotsController extends PublicController
{

    /**
     * Return the robots.txt file.
     *
     * @param SettingRepositoryInterface $settings
     * @param Template                   $template
     * @return \Illuminate\Http\Response|mixed
     */
    public function view(SettingRepositoryInterface $settings, Template $template)
    {
        /* @var SettingInterface $content */
        if ($content = $settings->get('anomaly.extension.robots::content')) {
            $content = $template->render($content->getValue());
        }

        if (!$content) {
            $content = $this->view->make('anomaly.extension.robots::robots')->render();
        }

        return $this->response->make($content)->header('Content-Type', 'text/plain');
    }
}
