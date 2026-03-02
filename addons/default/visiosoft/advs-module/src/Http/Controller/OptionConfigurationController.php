<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;
use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\CartsModule\Cart\CartRepository;
use Visiosoft\CartsModule\Cart\Command\GetCart;

class OptionConfigurationController extends PublicController
{
    private $adv_model;
    private $optionConfigurationRepository;
    private $cartRepository;
    private $productoptionRepository;
    private $productoptionsValueRepository;

    public function __construct(
        AdvModel $advModel,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository,
        CartRepository $cartRepository,
        ProductoptionRepositoryInterface $productoptionRepository,
        ProductoptionsValueRepositoryInterface $productoptionsValueRepository
    )
    {
        $this->adv_model = $advModel;
        $this->optionConfigurationRepository = $optionConfigurationRepository;
        $this->cartRepository = $cartRepository;
        $this->productoptionRepository = $productoptionRepository;
        $this->productoptionsValueRepository = $productoptionsValueRepository;
        parent::__construct();
    }

    public function create(OptionConfigurationFormBuilder $form)
    {
        $form->setOption('redirect', route('advs_preview', [request('ad')]));
        return $form->render();
    }

    public function ajaxCreate(OptionConfigurationRepositoryInterface $optionConfigurationRepository){
        $parameters = $this->request->all();
        $option_json = array();
        foreach ($parameters as $key => $parameter_value) {
            if ((strpos($key, "option-") === 0)) {
                if ($parameter_value !== '') {
                    $option_id = substr($key, 7);
                    $option_json[$option_id] = $parameter_value;
                }
                unset($parameters[$key]);
            }
        }
        $option_json = ['option_json' => json_encode($option_json)];
        $configration = array_merge($parameters, $option_json);
        $entry = $optionConfigurationRepository->create($configration);
        $entry['currency_price'] = app(Currency::class)->format($entry->price, $entry->currency);

        return $this->response->json($entry);
    }

    public function ajaxDelete(OptionConfigurationRepositoryInterface $optionConfigurationRepository){
        return $optionConfigurationRepository->deleteConfig($this->request->id);
    }

    public function confAddCart()
    {
        if ($conf = $this->optionConfigurationRepository->find($this->request->configuration)) {

            $parent_adv = $conf->parent_adv;

            if ($parent_adv->getStatus() == "approved") {
                $conf->name = $conf->getName();

                if ($conf->stock < $this->request->quantity) {
                    return redirect()->back()->with('warning', [trans('visiosoft.module.carts::message.error1in2')]);
                } else {
                    $cart = $this->dispatchSync(new GetCart());
                    $cart->add($conf, $this->request->quantity);
                    $this->messages->success(trans('visiosoft.module.carts::message.success'));
                    return $this->redirect->to($parent_adv->detail_url);
                }
            }
            $this->messages->info(trans('visiosoft.module.advs::message.error_added_cart'));
            return back();
        }
    }

    public function ajaxGetOptions() {
        $option = $this->productoptionRepository->find($this->request->option);
        return $this->productoptionsValueRepository->searchByOption($option->id, $this->request->q);
    }

    public function ajaxCreateOptions()
    {
        $option = $this->productoptionRepository->find($this->request->option);

        return $this->productoptionsValueRepository->create([
            'product_option' => $option,
            'name' => $this->request->name
        ]);
    }

    public function ajaxConfAddCart()
    {
        if ($conf = $this->optionConfigurationRepository->find($this->request->configuration ?? $this->request->data['conf'])) {
            $conf->name = $conf->getName();

            if ($conf->stock < $this->request->quantity) {
                return $this->response->json(['status' => 'error', 'msg' => trans('visiosoft.module.carts::message.error1in2')]);
            }

            $cart = $this->dispatchSync(new GetCart());
            $cart->add($conf, ($this->request->quantity ?? $this->request->data['quantity']) ?? 1);

            $cart_item = $cart->getItems();
            $count = $cart_item->count;
            $cart = $this->cartRepository->find($cart_item[0]->cart_id);
            return $this->response->json(['status' => 'success', 'count' => $count, 'cart' => $cart, 'cart_item' => $cart_item]);
        }
        return $this->response->json(['status' => 'error', 'msg' => trans('visiosoft.module.carts::message.error2')]);
    }
}
