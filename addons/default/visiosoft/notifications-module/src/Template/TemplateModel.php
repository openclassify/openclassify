<?php namespace Visiosoft\NotificationsModule\Template;

use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\NotificationsModule\Template\Contract\TemplateInterface;
use Anomaly\Streams\Platform\Model\Notifications\NotificationsTemplateEntryModel;

class TemplateModel extends NotificationsTemplateEntryModel implements TemplateInterface
{
    public function getTemplate($ad)
    {
        if (!is_null($this)) {
            $template = $this->toArray();
            $template['message'] = str_replace('{url}', $this->createAdLink($ad), $template['message']);
            $template['message'] = str_replace('{name}', $ad->name, $template['message']);
            $template['message'] = str_replace('{id}', $ad->id, $template['message']);

            $template['subject'] = str_replace('{url}', $this->createAdLink($ad), $template['subject']);
            $template['subject'] = str_replace('{name}', $ad->name, $template['subject']);
            $template['subject'] = str_replace('{id}', $ad->id, $template['subject']);

            return $template;
        }
        return null;
    }

    public function translateTemplate()
    {
        $template = $this->toArray();
        $template['message'] = preg_replace_callback(
            '/{{ trans\([\'"]([^}]*)[\'"]\) }}/i',
            function ($matches) {
                return trans($matches[1]);
            },
            $template['message']
        );

        $template['subject'] = preg_replace_callback(
            '/{{ trans\([\'"]([^}]*)[\'"]\) }}/i',
            function ($matches) {
                return trans($matches[1]);
            },
            $template['subject']
        );

        return $template;
    }

    public function createAdLink($ad)
    {
        $adModel = new AdvModel();
        return $adModel->getAdvDetailLinkByModel($ad, 'list');
    }

    public function getTemplateForArray(array $array = [])
    {
        $template = $this->toArray();
        foreach ($template as $key => $item) {
            $variables = $this->getInbetweenStrings('{', '}', $template[$key]);

            foreach ($variables as $variable) {
                if (isset($array[$variable])) {
                    $template[$key] = str_replace('{' . $variable . '}', $array[$variable], $template[$key]);
                }
            }
        }

        return $template;
    }

    public function getInbetweenStrings($start, $end, $str)
    {
        $matches = array();
        $regex = "/$start([a-zA-Z0-9_]*)$end/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }
}
