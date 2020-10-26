<?php namespace Visiosoft\AdvsModule\OptionConfiguration\Form;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;

class OptionConfigurationFormFields
{
	public function handle(
		OptionConfigurationFormBuilder $builder,
		AdvRepositoryInterface $advRepository,
		ProductoptionRepositoryInterface $productOptionRepository)
	{
		if(request()->has('ad'))
		{
			$ad = $advRepository->find(request('ad'));

			$options = $ad->getProductOptionsValues()->groupBy('product_option_id');

			$options_fields = array();

			foreach ($options as $option_id => $option_values)
			{
				if($option = $productOptionRepository->find($option_id))
				{
					$options_fields['option-'.$option->getId()] = [
						'type' => 'anomaly.field_type.select',
						'label' => $option->getName(),
						'required' => true,
						'config' => [
							'options' => $option_values->pluck('name','id')->all(),
						]
					];
				}
			}
			$fields = array_merge($options_fields, ['price', 'currency', 'stock']);

			$builder->setFields($fields);
		}
	}
}
