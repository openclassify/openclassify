<?php namespace Visiosoft\AdvsModule\OptionConfiguration;

use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class OptionConfigurationRepository extends EntryRepository implements OptionConfigurationRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var OptionConfigurationModel
     */
    protected $model;
    protected $advRepository;
    protected $productOptionsValueRepository;

    /**
     * Create a new OptionConfigurationRepository instance.
     *
     * @param OptionConfigurationModel $model
     */
    public function __construct(
        OptionConfigurationModel $model,
        AdvRepositoryInterface $advRepository,
        ProductoptionsValueRepositoryInterface $productoptionsValueRepository
    )
    {
        $this->model = $model;
        $this->advRepository = $advRepository;
        $this->productOptionsValueRepository = $productoptionsValueRepository;
    }

    public function createConfigration($ad_id, $price, $currency, $stock, $option_json)
    {
        return $this->create([
            'parent_adv_id' => $ad_id,
            'price' => $price,
            'currency' => $currency,
            'stock' => $stock,
            'option_json' => $option_json,
        ]);
    }

    public function getConf($ad_id)
    {
        $adv = $this->advRepository->find($ad_id);
        $configurations = array();

        $product_configurations = $this->model->where('stock', '>', '0')
            ->where('parent_adv_id', $ad_id)
            ->orderBy('created_at', 'ASC')
            ->get();

        foreach ($product_configurations as $product_configuration) {
            $configurations_item = json_decode($product_configuration->option_json, true);
            $option_group_value = "";
            foreach ($configurations_item as $option_id => $value) {
                $value_entry = $this->productOptionsValueRepository->find($value);
                $option_group_value .= " " . $value_entry->getName();
            }
            $option_group_value .= " " . $product_configuration->custom_option;

            $configurations[$product_configuration->getId()] = [
                'name' => $option_group_value,
                'price' => $product_configuration->price,
                'currency' => $product_configuration->currency,
                'stock' => $product_configuration->stock,
                'adv' => $adv->name . ' (' . trim($option_group_value, ' ') . ')',
            ];
        }

        return $configurations;
    }

    public function getUnusedConfigs()
    {
        return $this->newQuery()
            ->leftJoin('advs_advs as ads', 'advs_option_configuration.parent_adv_id', 'ads.id')
            ->whereNull('ads.id')
            ->orWhereNotNull('deleted_at')
            ->pluck('parent_adv_id')
            ->all();
    }

    public function deleteUnusedConfigs($adsIDs)
    {
        return $this->newQuery()->whereIn('parent_adv_id', $adsIDs)->delete();
    }

    public function deleteAdsConfigs($adID)
    {
        return $this->newQuery()->where('parent_adv_id', $adID)->delete();
    }

    public function deleteConfig($id)
    {
        if ($conf = ($this->newQuery()->find($id))) {
            if ($conf->created_by_id === Auth::user()->getAuthIdentifier()) {
                return $conf->delete();
            }
            return response()->json(['status' => 'error'], 403);
        }
        return response()->json(['status' => 'error'], 404);
    }
}
