<?php namespace Visiosoft\NotificationsModule\Template\Command;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;

class CreateTemplate
{
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function handle()
    {
        $template_repo = app(TemplateRepositoryInterface::class);

        if (!$template_repo->findBySlug($this->params['slug'])) {
            $template_repo->create($this->params);
        }
    }
}
