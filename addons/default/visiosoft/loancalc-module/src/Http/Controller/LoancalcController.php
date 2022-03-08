<?php namespace Visiosoft\LoancalcModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\SendLoanApplicationMail;
use Visiosoft\NotificationsModule\Notify\NotifyModel;

class LoancalcController extends PublicController {

    private $userModel;
    private $notifyModel;
    private $notification;
    private $advRepository;
    private $cityRepository;

    public function __construct(
        UserModel $userModel,
        NotifyModel $notifyModel,
        Notification $notification,
        AdvRepositoryInterface $advRepository,
        CityRepositoryInterface $cityRepository
    )
    {
        parent::__construct();

        $this->userModel = $userModel;
        $this->notifyModel = $notifyModel;
        $this->notification = $notification;
        $this->advRepository = $advRepository;
        $this->cityRepository = $cityRepository;
    }

    public function sendLoanApplication(Request $request)
    {
        $request = $request->all();
        $request = $this->roundPrices($request);
        $request = $this->addTitleLink($request);
        $request = $this->addCityName($request);

        $this->notification
            ->route('mail', setting_value('streams::email'))
            ->notify(new SendLoanApplicationMail($request));
        return response()->json(['success' => true]);
    }

    public function roundPrices($request) {
        $request['firstPayment'] = round($request['firstPayment']);
        $request['monthlyPayment'] = round($request['monthlyPayment']);
        $request['totalPayment'] = round($request['totalPayment']);

        return $request;
    }

    public function addTitleLink($request) {
        $ad = $this->advRepository->find($request['applicationAdId']);
        $request['adName'] = $ad->name;
        $request['adLink'] = route('adv_detail_seo', [$ad->slug, $ad->id]);

        return $request;
    }

    public function addCityName($request)
    {
        $city = $this->cityRepository->find($request['userProvince']);
        $request['userProvince'] = $city->name;

        return $request;
    }
}
