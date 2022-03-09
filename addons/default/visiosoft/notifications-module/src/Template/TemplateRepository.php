<?php namespace Visiosoft\NotificationsModule\Template;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class TemplateRepository extends EntryRepository implements TemplateRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var TemplateModel
     */
    protected $model;

    /**
     * Create a new TemplateRepository instance.
     *
     * @param TemplateModel $model
     */
    public function __construct(TemplateModel $model)
    {
        $this->model = $model;
    }

    public function findBySlug($slug)
    {
        return $this->newQuery()
            ->where('slug', $slug)
            ->where('enabled', true)
            ->first();
    }

    public function checkSetting()
    {
        if (setting_value('streams::mail_host') != null
            and setting_value('streams::mail_port') != 0
            and setting_value('streams::mail_username') != null
            and setting_value('streams::mail_password') != null) {
            return true;
        }
        return null;
    }
}
