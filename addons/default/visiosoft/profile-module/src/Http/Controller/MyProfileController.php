<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Visiosoft\PackagesModule\Http\Controller\PackageFEController;
use Visiosoft\MessagesModule\Message\MessageModel;
use Visiosoft\PackagesModule\Package\PackageModel;
use Visiosoft\ProfileModule\Adress\AdressModel;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Education\EducationModel;
use Visiosoft\ProfileModule\EducationPart\EducationPartModel;
use Visiosoft\ProfileModule\Profile\Form\ProfileFormBuilder;
use Illuminate\Contracts\Events\Dispatcher;

class MyProfileController extends PublicController
{
    private $adressRepository;
    private $userRepository;

    public function __construct(
        AdressRepositoryInterface $adressRepository,
        UserRepositoryInterface   $userRepository
    )
    {
        parent::__construct();

        $this->adressRepository = $adressRepository;
        $this->userRepository = $userRepository;
    }

    protected $user;

    public function home(ProfileFormBuilder $form)
    {
        $advs_count = new AdvModel();
        $advs_count = $advs_count->myAdvsByUser()->count();

        $user = $this->userRepository->find(Auth::id());

        $country = CountryModel::all();

        return $this->view->make('visiosoft.module.profile::profile.profile',
            compact('user', 'country', 'form', 'advs_count'));
    }

    public function detail(ProfileFormBuilder $form)
    {
        $user = $this->userRepository->find(Auth::id());
        $country = CountryModel::all();
        return $this->view->make('visiosoft.module.profile::profile.detail', compact('user', 'country', 'form'));
    }

    public function password()
    {
        return $this->view->make('visiosoft.module.profile::profile.password');
    }

    public function extendAds($id, $type, SettingRepositoryInterface $settings)
    {
        $isActivePackages = is_module_installed('visiosoft.module.packages');

        if ($isActivePackages) {
            //Search Last Time Packages By User
            $TimePackages = new PackageFEController();
            $LastTimePackages = $TimePackages->getPackagesByUser('lasttime');

            //no packages by user
            if ($LastTimePackages == false) {
                return response()->json(['success' => false, 'msg' => trans('visiosoft.module.profile::message.no_extend_package')]);
            }

            //Search Time packages By id
            $TimePackages = $TimePackages->getTimePackages($LastTimePackages['package_id']);
            $adv = new AdvModel();
            $adv->finish_at_Ads($id, $TimePackages['time']);

            // auto approved find
            $auto_approved = $settings->value('visiosoft.module.advs::auto_approve');
            if ($auto_approved == true) {
                $type = "approved";
            }
            $adv->statusAds($id, $type);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'msg' => trans('visiosoft.module.profile::message.no_packages_module')]);
        }
    }

    public function statusAds($id, $type, AdvModel $advModel)
    {
        $ad = $advModel->getAdv($id);
        $auto_approved = setting_value('visiosoft.module.advs::auto_approve');
        $default_published_time = setting_value('visiosoft.module.advs::default_published_time');

        if ($auto_approved == true and $type == 'pending_admin') {
            $type = "approved";
        }

        if ($type == "approved") {
            $advModel->publish_at_Ads($id);
            if ($ad->finish_at == NULL and $type == "approved") {
                if (is_module_installed('visiosoft.module.packages')) {
                    $packageModel = new PackageModel();
                    $published_time = $packageModel->reduceTimeLimit($ad->cat1);
                    if ($published_time != null) {
                        $default_published_time = $published_time;
                    }
                }
                $advModel->finish_at_Ads($id, $default_published_time);
            }
        }
        $isActiveAlgolia = is_module_installed('visiosoft.module.algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type);
        }

        $status = $advModel->statusAds($id, $type);

        return response()->json(['status' => $status]);
    }


    public function adressAjaxCreate(AdressFormBuilder $form, Request $request)
    {
        $message = [];

        $error_district = false;
        if (setting_value('visiosoft.module.profile::required_district') and (!$this->request->district or $this->request->district == "")) {
            $error_district = true;
        }

        $error = $form->build()->validate()->getFormErrors()->getMessages();

        if (!empty($error) or $error_district) {
            $this->messages->flush();
            $message['status'] = "error";
            $message['msg'] = trans('visiosoft.module.profile::message.required_all');
            return $message;
        }
        $new_adress = $request->request->all();
        unset($new_adress['_token']);
        $new_adress['user_id'] = Auth::id();

        $adressModel = new AdressModel();
        $address = $adressModel->getAdress()->create($new_adress);

        $message['status'] = "success";
        $message['data'] = $address;
        return $message;
    }

    public function adressAjaxUpdate(AdressFormBuilder $form, $id)
    {
        $address = $this->adressRepository->find($id);
        if (isset($id) and $address != null and $address->user_id == Auth::id()) {
            $message = [];
            $error = $form->build()->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                $message['status'] = "error";
                $message['msg'] = trans('visiosoft.module.profile::message.required_all');
                return $message;
            }
            $new_adress = $this->request->all();
            unset($new_adress['_token']);

            $address->update($new_adress);

            $message['status'] = "updated";
            $message['data'] = $address;
            return $message;

        }
        $message['status'] = "error";
        $message['msg'] = trans('visiosoft.module.profile::message.ajax_address_error');
        return $message;
    }

    public function adressAjaxDetail()
    {
        $address = $this->adressRepository->find($this->request->id);
        if (isset($this->request->id) and $address != null and $address->user_id == Auth::id()) {
            $message['status'] = "success";
            $message['data'] = $address;
            return $message;
        }
        $message['status'] = "error";
        $message['msg'] = trans('visiosoft.module.profile::message.ajax_address_error');
        return $message;
    }


    public function showMessage($id)
    {
        $message = new MessageModel();
        $message = $message->showMessage($id);
        $messageInfo = $message[0];
        $messageDetail = $message[1];

        if ($message[0]->adv_user_id == auth()->id()) {
            return $this->view->make('visiosoft.module.profile::profile.message-detail', compact('messageInfo', 'messageDetail'));
        } else {
            abort(403);
        }
    }

    public function disableAccount()
    {

        UsersUsersEntryModel::query()->find(Auth::id())->update(['enabled' => 0]);
        Auth::logout();
        return redirect('/');
    }

    public function notification(Request $request)
    {
        $all = $request->all();
        unset($all['_']);
        $status = $this->userRepository->newQuery()->where('id', Auth::id())->update($all);
        return response()->json($status);

    }

    public function myAds(StatusRepositoryInterface $statusRepository)
    {
        $userStatus = $statusRepository->getUserAccessibleStatuses()->pluck('name', 'id')->toJson();
        $changeStatusUrl = route('visiosoft.module.advs::ad.change.status', [':adID', ':statusID']);
        return $this->view->make(
            'visiosoft.module.profile::profile/ads',
            compact('userStatus', 'changeStatusUrl')
        );
    }

    public function updateAjaxProfile(UserRepositoryInterface $user)
    {
        $profile = $user->find(Auth::id());
        if (isset($this->request->action) and $this->request->action == "update") {
            $profile->update([
                'first_name' => $this->request->first_name,
                'last_name' => $this->request->last_name,
                'gsm_phone' => $this->request->gsm_phone,
                'office_phone' => $this->request->office_phone,
                'land_phone' => $this->request->land_phone,
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $profile]);
    }

    public function getEducation(Request $request)
    {
        $user = $this->userRepository->find(auth()->id());
        $education = EducationModel::all();
        $educationPart = EducationPartModel::query()->where('education_id', $user->education)->get();
        return response()->json(['user' => $user, 'education' => $education, 'education-part' => $educationPart], 200);
    }

    public function changeEducation(Request $request)
    {
        if ($request->info == 'education') {
            $education = EducationPartModel::query()->where('education_id', $request->education)->get()->sortBy('name');
        }
        return response()->json(['data' => $education], 200);
    }

    public function getIPLocation()
    {
        $ip = $this->request->ip();
        $location = file_get_contents("https://ipinfo.io/$ip/json");
        $location = json_decode($location, true);

        return $this->response->json([
            'success' => true,
            'data'=> [
                'country' => trans('streams::country.'.$location['country']),
                'language' => trans('streams::locale.'.strtolower($location['country']).'.name')
            ]
        ]);
    }
}
