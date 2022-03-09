<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use Visiosoft\DemandModule\Demand\Events\CreateDemand;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\SendDemandMail;
use Visiosoft\NotificationsModule\Notify\Notification\SendDemandMailAdmin;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;

class CreateDemandMail
{

    private $templateRepository;
    private $roleRepository;
    private $cityRepository;
    private $districtRepository;
    private $neighborhoodRepository;

    public function __construct(
        TemplateRepositoryInterface $templateRepository,
        RoleRepositoryInterface $roleRepository,
        CityRepositoryInterface $cityRepository,
        DistrictRepositoryInterface $districtRepository,
        NeighborhoodRepositoryInterface $neighborhoodRepository
    )
    {
        $this->templateRepository = $templateRepository;
        $this->roleRepository = $roleRepository;
        $this->cityRepository = $cityRepository;
        $this->districtRepository = $districtRepository;
        $this->neighborhoodRepository = $neighborhoodRepository;
    }

    public function handle(CreateDemand $event)
    {
        $adminRole = $this->roleRepository->findBySlug('admin');
        $admins = $adminRole->getUsers();
        $user = $event->user();
        $demand = $event->demand();
        $locale = config('app.locale');

        $url = url('/');

        if ($adminTemplate = $this->templateRepository->findBySlug('create_demand_admin')) {
            $content = $adminTemplate->message;
            $content = str_replace('{emlak24_url}', url('/'), $content);
            $content = str_replace('{name}', $user->name(), $content);
            $content = str_replace('{request_id}', $demand['demand']['id'], $content);

            $city = $demand['demand']['city'];
            if ($city) {
                $city = $this->cityRepository->find($demand['demand']['city'])->name;
                $district = $demand['demand']['district'] ?
                    $this->districtRepository->find($demand['demand']['district'])->name : '';
                $neighborhood = $demand['demand']['neighborhood'] ?
                    $this->neighborhoodRepository->find($demand['demand']['neighborhood'])->name : '';

                $content = str_replace('{city}', $city, $content);
                $content = str_replace('{district}', $district, $content);
                $content = str_replace('{neighborhood}', $neighborhood, $content);
            } else {
                $content = str_replace('{city}', '', $content);
                $content = str_replace('{district}', '', $content);
                $content = str_replace('{neighborhood}', '', $content);
            }

            $demandLink = $demand['type'] === 'service' ?
                url('admin/demand/services/edit/' . $demand['demand']['id']) :
                url('admin/demand/edit/' . $demand['demand']['id']);
            $content = str_replace('{demand_link}', $demandLink, $content);
            $content = str_replace('{user_email}', $demand['demand']->user->email, $content);
            $content = str_replace('{user_phone}', $demand['demand']->user->gsm_phone, $content);

            dispatch(function () use ($admins, $content, $adminTemplate, $url, $locale) {
                Notification::send($admins, new SendDemandMailAdmin($content, $adminTemplate['subject'], $url, $locale));
            });
        }

        dispatch(function () use ($user, $url, $demand, $locale) {
            $user->notify(new SendDemandMail($url, $user, $demand['demand']['id'], $locale));
        });
    }
}
