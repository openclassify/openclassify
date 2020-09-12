<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Profile\Form\ProfileFormBuilder;

class MyProfileController extends PublicController
{
    private $adressRepository;
    private $userRepository;
    private $advRepository;
    private $countryRepository;

    public function __construct(
        AdressRepositoryInterface $adressRepository,
        UserRepositoryInterface $userRepository,
        AdvRepositoryInterface $advRepository,
        CountryRepositoryInterface $countryRepository
    )
    {
        parent::__construct();
        $this->adressRepository = $adressRepository;
        $this->userRepository = $userRepository;
        $this->advRepository = $advRepository;
        $this->countryRepository = $countryRepository;
    }

    public function home(ProfileFormBuilder $form)
    {
        $adsCount = count($this->advRepository->myAdvsByUser()->get());
        $user = $this->userRepository->find(\auth()->id());
        $country = $this->countryRepository->all();

        return $this->view->make(
            'visiosoft.module.profile::profile.detail',
            compact('user', 'country', 'form', 'adsCount')
        );
    }

    public function addressAjaxCreate(AdressFormBuilder $form)
    {
        try {
            $error = $form->build()->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                throw new \Exception(trans('visiosoft.module.profile::message.required_all'));
            }

            $new_address = \request()->all();
            $new_address['user_id'] = \auth()->id();
            unset($new_address['_token']);

            $address = $this->adressRepository->create($new_address);

            return [
                'status' => 'success',
                'data' => $address
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'msg' => $e->getMessage()
            ];
        }
    }

    public function addressAjaxUpdate(AdressFormBuilder $form, $id)
    {
        try {
            $address = $this->adressRepository->find($id);
            if ($address && $address->user_id == \auth()->id()) {
                $error = $form->build()->validate()->getFormErrors()->getMessages();
                if (!empty($error)) {
                    throw new \Exception(trans('visiosoft.module.profile::message.required_all'));
                }

                $new_adress = \request()->all();
                unset($new_adress['_token']);

                $address->update($new_adress);

                return [
                    'status' => 'update',
                    'data' => $address,
                ];
            }

            throw new \Exception(trans('visiosoft.module.profile::message.ajax_address_error'));
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'msg' => $e->getMessage(),
            ];
        }
    }

    public function addressAjaxDetail()
    {
        try {
            $address = $this->adressRepository->find(\request()->id);
            if ($address && $address->user_id == \auth()->id()) {
                return [
                    'status' => 'success',
                    'data' => $address,
                ];
            } else {
                throw new \Exception(trans('visiosoft.module.profile::message.ajax_address_error'));
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'msg' => $e->getMessage(),
            ];
        }
    }

    public function disableAccount()
    {
        $this->userRepository->find(Auth::id())->update(['enabled' => 0]);
        \auth()->logout();
        return redirect('/');
    }

    public function notification()
    {
        $all = \request()->all();
        unset($all['_']);
        $user = $this->userRepository->find(\auth()->id())->update($all);
        return response()->json($user);

    }

    public function myAds()
    {
        return $this->view->make('visiosoft.module.profile::profile/ads');
    }

    public function updateAjaxProfile()
    {
        $profile = $this->userRepository->find(\auth()->id());
        if (isset(\request()->action) && \request()->action == "update") {
            $profile->update([
                'first_name' => \request()->first_name,
                'last_name' => \request()->last_name,
                'gsm_phone' => \request()->gsm_phone,
                'office_phone' => \request()->office_phone,
                'land_phone' => \request()->land_phone,
            ]);
        }
        return ['status' => 'success', 'data' => $profile];
    }

    public function checkUser()
    {
        return \auth()->check() ? ['success' => true] : ['success' => false];
    }

}
