<?php namespace Visiosoft\AdvsModule\OptionConfiguration;

use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class OptionConfigurationRepository extends EntryRepository implements OptionConfigurationRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var OptionConfigurationModel
     */
    protected $model;

    /**
     * Create a new OptionConfigurationRepository instance.
     *
     * @param OptionConfigurationModel $model
     */
    public function __construct(OptionConfigurationModel $model)
    {
        $this->model = $model;
    }

    public function createConfigration($ad_id,$price,$currency,$stock,$option_json)
    {
    	return $this->create([
    		'parent_adv_id' => $ad_id,
    		'price' => $price,
    		'currency' => $currency,
    		'stock' => $stock,
    		'option_json' => $option_json,
	    ]);
    }
}
