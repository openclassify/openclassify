<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Configuration\ConfigurationConfigurationEntryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\AdvsModule\OptionConfiguration\OptionConfigurationModel;
use Visiosoft\CartsModule\Cart\CartModel;
use Visiosoft\CartsModule\Cart\CartRepository;
use Visiosoft\CartsModule\Cart\Command\GetCart;

class OptionConfigurationController extends PublicController
{
	private $advRepository;
	private $adv_model;
	private $optionConfigurationModel;
	private $optionConfigurationRepository;

	public function __construct(
		AdvRepositoryInterface $advRepository,
		AdvModel $advModel,
		OptionConfigurationModel $optionConfigurationModel,
		OptionConfigurationRepositoryInterface $optionConfigurationRepository
	)
	{
		$this->advRepository = $advRepository;
		$this->adv_model = $advModel;
		$this->optionConfigurationModel = $optionConfigurationModel;
		$this->optionConfigurationRepository = $optionConfigurationRepository;
		parent::__construct();
	}

	public function create(OptionConfigurationFormBuilder $form)
	{
		$form->setOption('redirect', route('advs_preview', [request('ad')]));
		return $form->render();
	}

	public function confAddCart()
	{
		if($conf = $this->optionConfigurationRepository->find($this->request->configuration))
		{
		    if($conf->parent_adv->getStatus() == "approved")
            {
                $conf->name = $conf->getName();

                if ($conf->stock < $this->request->quantity){
                    return redirect()->back()->with('warning', [trans('visiosoft.module.carts::message.error1in2')]);
                }else{
                    $cart = $this->dispatch(new GetCart());
                    $cart->add($conf, $this->request->quantity);
                    return $this->redirect->to(route('visiosoft.module.carts::cart'));
                }
            }
		    $this->messages->info(trans('visiosoft.module.advs::message.error_added_cart'));
		    return back();
		}
	}

	public function ajaxConfAddCart()
	{
		if (\auth()->check()) {
			if($conf = $this->optionConfigurationRepository->find($this->request->configuration))
			{
				$conf->name = $conf->getName();

				$this->adv_model->authControl();

				if ($conf->stock < $this->request->quantity){
					return $this->response->json(['status' => 'error', 'msg' => trans('visiosoft.module.carts::message.error1in2')]);
				}else{
					$cart = $this->dispatch(new GetCart());
					$cart->add($conf, $this->request->quantity);

					$count = $cart->getItems()->count;
					return $this->response->json(['status'=> 'success', 'count' => $count]);
				}
			}
			return $this->response->json(['status' => 'error', 'msg' => trans('visiosoft.module.carts::message.error2')]);
		}
		return $this->response->json(['status' => 'guest']);
	}
}
