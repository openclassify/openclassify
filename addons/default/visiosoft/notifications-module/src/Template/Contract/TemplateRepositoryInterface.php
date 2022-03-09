<?php namespace Visiosoft\NotificationsModule\Template\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface TemplateRepositoryInterface extends EntryRepositoryInterface
{
    public function findBySlug($slug);

    public function checkSetting();
}
