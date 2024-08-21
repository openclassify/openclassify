<?php

namespace Visiosoft\RestateTheme\Http\Controller;

use \Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Traits\ApiReturnResponseTrait;

class ThemeController extends PublicController
{
    use ApiReturnResponseTrait;

    protected $advRepository;

    public function __construct(AdvRepositoryInterface $advRepository)
    {
        $this->advRepository = $advRepository;
        parent::__construct();
    }

    public function contactUsPage()
    {
        $this->template->set('meta_title', trans("visiosoft.theme.restate::field.contact_us_page"));
        return $this->view->make('visiosoft.theme.restate::pages.contact-us');
    }

    public function printAdDetailView(AdvRepositoryInterface $advRepository,$id)
    {
        $adv = $advRepository->find($id);
        return $this->view->make('visiosoft.theme.restate::partials.print-profile-ad',compact('adv'));
    }
}