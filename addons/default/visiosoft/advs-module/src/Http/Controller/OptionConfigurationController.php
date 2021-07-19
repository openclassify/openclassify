<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\CartsModule\Cart\CartRepository;
use Visiosoft\CartsModule\Cart\Command\GetCart;

class OptionConfigurationController extends PublicController
{
    private $adv_model;
    private $optionConfigurationRepository;
    private $cartRepository;

    public function __construct(
        AdvModel $advModel,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository,
        CartRepository $cartRepository
    )
    {
        $this->adv_model = $advModel;
        $this->optionConfigurationRepository = $optionConfigurationRepository;
        $this->cartRepository = $cartRepository;
        parent::__construct();
    }

    public function create(OptionConfigurationFormBuilder $form)
    {
        $form->setOption('redirect', route('advs_preview', [request('ad')]));
        return $form->render();
    }

    public function confAddCart()
    {
        if ($conf = $this->optionConfigurationRepository->find($this->request->configuration)) {
            if ($conf->parent_adv->getStatus() == "approved") {
                $conf->name = $conf->getName();

                if ($conf->stock < $this->request->quantity) {
                    return redirect()->back()->with('warning', [trans('visiosoft.module.carts::message.error1in2')]);
                } else {
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
        if ($conf = $this->optionConfigurationRepository->find($this->request->configuration ?? $this->request->data['conf'])) {
            $conf->name = $conf->getName();

            if ($conf->stock < $this->request->quantity) {
                return $this->response->json(['status' => 'error', 'msg' => trans('visiosoft.module.carts::message.error1in2')]);
            }

            $cart = $this->dispatch(new GetCart());
            $cart->add($conf, ($this->request->quantity ?? $this->request->data['quantity']) ?? 1);

            $cart_item = $cart->getItems();
            $count = $cart_item->count;
            $cart = $this->cartRepository->find($cart_item[0]->cart_id);
            return $this->response->json(['status' => 'success', 'count' => $count, 'cart' => $cart, 'cart_item' => $cart_item]);
        }
        return $this->response->json(['status' => 'error', 'msg' => trans('visiosoft.module.carts::message.error2')]);
    }
}
