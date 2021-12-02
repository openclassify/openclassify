<?php namespace Visiosoft\AdvsModule\OptionConfiguration\Form;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class OptionConfigurationFormFields
{
    public function handle(
        OptionConfigurationFormBuilder $builder,
        AdvRepositoryInterface $advRepository,
        ProductoptionRepositoryInterface $productOptionRepository,
        ProductoptionsValueRepositoryInterface $productoptionsValueRepository
    )
    {
        if(request()->has('ad') || $builder->getEntry())
        {
            $ad = $advRepository->find(request('ad') ?? $builder->getEntry());

            $options_fields = array();

            if($ad)
            {
                $options = $productOptionRepository->getWithCategoryId($ad->cat1);

                foreach ($options as $option)
                {
                    if($optionValue = $productoptionsValueRepository->getWithOptionsId([$option->id]))
                    {
                        $options_fields['option-'.$option->getId()] = [
                            'type' => 'anomaly.field_type.select',
                            'class' => 'form-control product-options-fields',
                            'label' => $option->getName(),
                            'required' => true,
                            'attributes' => [
                                'data-id' => $option->getId(),
                            ],
                            'config' => [
                                'options' => $optionValue->pluck('title','id')->all(),
                            ]
                        ];
                    }
                }
            }

            $fields = array_merge($options_fields, ['price', 'currency', 'stock']);

            $builder->setFields($fields);
        }
    }
}
