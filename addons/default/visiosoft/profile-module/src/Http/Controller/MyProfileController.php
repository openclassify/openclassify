<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Password\Command\StartPasswordReset;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Rinvex\Subscriptions\Models\Plan;
use Rinvex\Subscriptions\Models\PlanSubscription;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Event\ChangeStatusAd;
use Visiosoft\AdvsModule\AdvsModule;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\AdvsModule\Http\Controller\AdvsController;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Visiosoft\FavsModule\Favorite\Contract\FavoriteRepositoryInterface;
use Visiosoft\FavsModule\Favorite\FavoriteModel;
use Visiosoft\FavsModule\Http\Controller\FavsController;
use Visiosoft\CloudsiteModule\CloudsiteModule;
use Visiosoft\CloudsiteModule\Site\SiteModel;
use Visiosoft\OrdersModule\Order\OrderModel;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainPuchaseOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainPurchaseOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainSaleOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\ReportOrder;
use Visiosoft\OrdersModule\Orderdetail\OrderdetailModel;
use Visiosoft\OrdersModule\Orderdetail\OrderdetailRepository;
use Visiosoft\OrdersModule\Orderpayment\OrderpaymentModel;
use Visiosoft\PackagesModule\Http\Controller\PackageFEController;
use Visiosoft\MessagesModule\Message\MessageModel;
use Visiosoft\PackagesModule\Package\PackageModel;
use Visiosoft\PackagesModule\User\UserModel;
use Visiosoft\ProfileModule\Adress\AdressModel;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;
use Visiosoft\ProfileModule\Profile\Form\ProfileFormBuilder;
use Visiosoft\ProfileModule\Profile\ProfileModel;
use Illuminate\Contracts\Events\Dispatcher;


class MyProfileController extends PublicController
{

    public function __construct()
    {
        parent::__construct();
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
    }

    protected $user;

    public function home(ProfileFormBuilder $form, AdvRepositoryInterface $advRepository)
    {
        //clear empty ads
        $advRepository->delete_empty_advs();

        $menu_fields = array();

        $isActive = new AdvModel();
        $isActiveMessages = $isActive->is_enabled('messages');
        $isActiveOrders = $isActive->is_enabled('orders');
        $isBalanceActive = $isActive->is_enabled('balances');
        $isActiveFavs = $isActive->is_enabled('favs');
        $isActivePackages = $isActive->is_enabled('packages');


        if ($isBalanceActive) {
            $balanceController = app(\Visiosoft\BalancesModule\Http\Controller\BalancesFrontController::class);
            $balanceModel = new \Visiosoft\BalancesModule\Package\PackageModel();
            $balancespackage = $balanceModel->listPackage();
            $userbalance = $balanceController->index(auth()->user()->id);
            $menu_balance = array();
            $menu_balance['href'] = "balance";
            $menu_balance['aria-controls'] = "balance";
            $menu_balance['title'] = trans('visiosoft.module.balances::field.menu_balance.name');
            $menu_fields[] = $menu_balance;
        } else {
            $userbalance = '';
        }
        if ($isActiveMessages) {

            $myMessages = new MessageModel();
            $myMessages = $myMessages->listMessages();
            $message_count = count($myMessages);

            $menu_messages = array();
            $menu_messages['href'] = "msg";
            $menu_messages['aria-controls'] = "msg";
            $menu_messages['title'] = trans('visiosoft.module.profile::field.menu_messages.name');
            $menu_fields[] = $menu_messages;
        }

        if ($isActiveOrders) {
            $advModel = new AdvModel();
            $OrderModel = new OrderModel();
            $OrderDetailModel = new OrderdetailModel();
            $myPurchase = $OrderModel->listMyOrders();
            $mySales = $OrderDetailModel->listMySales();
            foreach ($mySales as $index => $mySale)
            {
                if($mySale->item_type == 'adv')
                {
                    $mySales[$index]->detail_url = $advModel->getAdvDetailLinkByAdId($mySale->item_id);
                }
                $mySales[$index]->detail_url = "#";
            }
        }

        $advs_count = new AdvModel();
        $advs_count = count($advs_count->myAdvsByUser()->get());


        if ($isActivePackages) {
            $packageModel = new PackageModel();
            $my_packages = $packageModel->getPackageByLoggedInUser();
            $menu_packages = array();
            $menu_packages['href'] = "packages";
            $menu_packages['aria-controls'] = "packages";
            $menu_packages['title'] = trans('visiosoft.module.profile::field.menu_packages.name');
            $menu_fields[] = $menu_packages;
        }

        if ($isActiveFavs) {
            $fav = new FavoriteModel();
            $favs = $fav->getFavsByProfile();
            $fav_count = count($favs);
            $menuFavorites = array();
            $menuFavorites['href'] = "favs";
            $menuFavorites['aria-controls'] = "favs";
            $menuFavorites['title'] = trans('visiosoft.module.profile::field.favorites');
            $menu_fields[] = $menuFavorites;

            $id = Auth::id();
            $fav_advs = $fav->getItems($id, 'adv');
            $fav_sellers = $fav->getItems($id, 'seller');
            $fav_searches = $fav->getItems($id, 'search');
        }

        $profileModel = new ProfileModel();
        $adressModel = new AdressModel();

        $My_adress = $adressModel->getUserAdress();
        $users = UsersUsersEntryModel::find(Auth::id());
        $profiles = $profileModel->getProfile(Auth::id())->orderBy("id")->first();

        if ($profiles == null) {
            $newProfile = [];
            $newProfile ['user_no_id'] = Auth::id();

            $profileModel->getProfile()->create($newProfile);

            $profiles = $profileModel->getProfile(Auth::id())->orderBy("id")->first();
        }

        $country = CountryModel::all();
        return $this->view->make('visiosoft.module.profile::profile.profile', compact('users', 'profiles',
            'country', 'form', 'My_adress', 'my_packages', 'menu_fields', 'myMessages', 'message_count', 'myPurchase',
            'mySales', 'advs_count', 'fav_count', 'userbalance', 'fav_advs', 'fav_sellers', 'fav_searches',
            'balancespackage'));
    }

    public function update(ProfileFormBuilder $form, Request $request, UserPassword $userPassword, ProfileRepositoryInterface $profileRepository)
    {
        $id = Auth::id();
        $all = $request->all();
        //updateUserFields && remove added fields
        $all = $profileRepository->updateUserField($all);
        if (isset($all['confirm_password_input']) and $all['confirm_password_input'] == "on") {
            $all = $profileRepository->changePassword($all, $userPassword);
        } else {
            unset($all['new_password'], $all['re_new_password'], $all['confirm_password_input']);
        }
        if (isset($all['error'])) {
            return redirect('/profile')->with('error', $all['error']);
        }
        
        unset($all['_token'], $all['action']);
        $all['file_id'] = $all['file'];
        if(isset($all['adv_listing_banner']))
        {
            $all['adv_listing_banner_id'] = $all['adv_listing_banner'];
            unset($all['adv_listing_banner']);
        }
        unset($all['file']);

        $profileModel = new ProfileModel();
        $profileModel->getProfile($id)->update($all);

        $message = [];
        $message[] = trans('visiosoft.module.profile::message.success_update');
        return redirect('/profile')->with('success', $message);
    }

    public function extendAds($id, $type, SettingRepositoryInterface $settings)
    {
        $isActivePackages = new AdvModel();
        $isActivePackages = $isActivePackages->is_enabled('packages');

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

    public function statusAds($id, $type, SettingRepositoryInterface $settings, Dispatcher $events, AdvModel $advModel)
    {
        $ad = $advModel->getAdv($id);
        $auto_approved = $settings->value('visiosoft.module.advs::auto_approve');
        $default_published_time = $settings->value('visiosoft.module.advs::default_published_time');

        if ($auto_approved == true AND $type == 'pending_admin') {
            $type = "approved";
        }

        if ($type == "approved") {
            $advModel->publish_at_Ads($id);
            if ($ad->finish_at == NULL AND $type == "approved") {
                if ($advModel->is_enabled('packages')) {
                    $packageModel = new PackageModel();
                    $published_time = $packageModel->reduceTimeLimit($ad->cat1);
                    if($published_time != null)
                    {
                        $default_published_time = $published_time;
                    }
                }
                $advModel->finish_at_Ads($id, $default_published_time);
            }
        }
        $isActiveAlgolia = new AdvModel();
        $isActiveAlgolia = $isActiveAlgolia->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type, $settings);
        }
        $status = $advModel->statusAds($id, $type);
        $events->dispatch(new ChangeStatusAd($id, $settings));//Create Notify

        return response()->json(['status' => $status]);

    }

    public function adressEdit($id)
    {
        $adressModel = new AdressModel();
        $adress = $adressModel->getAdressFirst($id);
        if ($adress->getAttribute('user_no_id') == Auth::id()) {
            $country = CountryModel::all();
            return $this->view->make('visiosoft.module.profile::profile.adress_edit', compact('adress', 'country'));
        }
    }

    public function adressUpdate(AdressFormBuilder $form, Request $request, $id)
    {
        $error = $form->build()->validate()->getFormErrors()->getMessages();
        if (!empty($error)) {
            return $this->redirect->back();
        }

        $adressModel = new AdressModel();
        $adress = $adressModel->getAdressFirst($id);

        if ($adress->getAttribute('user_no_id') == Auth::id()) {

            $New_value = $request->all();
            $New_value['country_id'] = $New_value['country'];
            unset($New_value['_token'], $New_value['action'], $New_value['country']);
            $adressModel->getAdress($id)->update($New_value);

            $message = [];
            $message[] = trans('visiosoft.module.profile::message.adress_success_update');
            return redirect('/profile')->with('success', $message);
        }
    }

    public function adressCreate(AdressFormBuilder $form, Request $request)
    {
        if (isset($request->request->all()['action']) == "save") {
            $error = $form->build()->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                return $this->redirect->back();
            }
            $new_adress = $request->request->all();
            unset($new_adress['action'], $new_adress['_to*ken']);
            $new_adress['user_no_id'] = Auth::id();

            $adressModel = new AdressModel();
            $adressModel->getAdress()->create($new_adress);

            $message = [];
            $message[] = trans('visiosoft.module.profile::message.adress_success_create');
            return redirect('/profile#adress')->with('success', $message);
        }
        $country = CountryModel::all();
        return $this->view->make('visiosoft.module.profile::profile.adress_create', compact('country'));
    }

    public function adressAjaxCreate(AdressFormBuilder $form, Request $request)
    {
        $message = [];

        $error = $form->build()->validate()->getFormErrors()->getMessages();
        if (!empty($error)) {
            $message['status'] = "error";
            $message['msg'] = trans('visiosoft.module.profile::message.required_all');
            return $message;
        }
        $new_adress = $request->request->all();
        unset($new_adress['action'], $new_adress['_token']);
        $new_adress['user_no_id'] = Auth::id();

        $adressModel = new AdressModel();
        $address = $adressModel->getAdress()->create($new_adress);

        $message['status'] = "success";
        $message['data'] = $address;
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
        return redirect('/');
    }

    public function orderDetail($id)
    {
        $advModel = new AdvModel();
        $orderDetailModel = new OrderdetailModel();
        $details = $orderDetailModel->getDetail($id);
        foreach ($details as $index => $detail)
        {
            if($detail->item_type == "adv")
            {
                $details[$index]->detail_url = $advModel->getAdvDetailLinkByAdId($detail->item_id);
            } else {
                $details[$index]->detail_url = "#";
            }
        }
        return $this->view->make('visiosoft.module.profile::profile.show-order', compact('details'));
    }

    public function saleDetail($id)
    {
        $advModel = new AdvModel();
        $orderDetailModel = new OrderdetailModel();
        $details = $orderDetailModel->getOrder($id);
        if($details->item_type == "adv")
        {
            $details->detail_url = $advModel->getAdvDetailLinkByAdId($details->item_id);
        } else {
            $details->detail_url = "#";
        }
        return $this->view->make('visiosoft.module.profile::profile.show-my-sale', compact('details'));
    }

    public function addTrackingNumber(Request $request, OrderdetailRepository $orderdetailRepository)
    {
        $orderdetailRepository->addTransportnumber($request->id, $request->transportNumber, $request->transportDays);
        return back()->with('success', ['Success']);
    }

    public function orderDelivered($id)
    {
        $orderDetailModel = new OrderdetailModel();
        $details = $orderDetailModel->status($id, 'paid_buyer');
        $orderPaymentModel = new OrderpaymentModel();
        $orderPaymentModel->addSalesPayment($id);
        return back()->with('success', [trans('visiosoft.module.profile::message.success')]);
    }

    public function orderNotDelivered($id)
    {
        $orderDetailModel = new OrderdetailModel();
        $details = $orderDetailModel->status($id, 'error_buyer');
        return back()->with('success', [trans('visiosoft.module.profile::message.success')]);
    }

    public function reportSales(Request $request, OrderdetailRepository $orderdetailRepository, Dispatcher $events)
    {
        if ($request->status == 'sendAgain') {
            $seller = Auth::user();
            $buyer = $orderdetailRepository->getOrderUser($request->id);
            $orderdetailRepository->report($request->id, $request->reportContent, 'awaiting_tracking_number');

            $events->dispatch(new AgainPurchaseOrder($request->reportContent, $buyer));
            $events->dispatch(new AgainSaleOrder($request->reportContent, $seller));

//                $buyer->notify(new AgainPuchaseOrder($request->reportContent, $buyer['display_name']));/*notify*/
//                $seller->notify(new AgainSaleOrder($request->reportContent, $seller['display_name']));/*notify*/

        } else {
            $orderdetailRepository->report($request->id, $request->reportContent);
            $user = $orderdetailRepository->getOrderUser($request->id);
            $orderPaymentModel = new OrderpaymentModel();
            $orderPaymentModel->addCancelPayment($request->id, $request->reportContent);

            $events->dispatch(new ReportOrder($request->reportContent, $user));
//                $user->notify(new ReportOrder($request->reportContent, $user['display_name']));/*notify*/

        }
        return back()->with('success', [trans('visiosoft.module.profile::message.success')]);
    }

    public function notification(Request $request)
    {
        $all = $request->all();
        unset($all['_']);
        $profileModel = new ProfileModel();
        $status = $profileModel->getProfile(Auth::id())->update($all);
        return response()->json($status);

    }

}
