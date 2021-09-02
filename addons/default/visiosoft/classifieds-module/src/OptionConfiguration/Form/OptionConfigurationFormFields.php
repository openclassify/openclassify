<?php namespace Visiosoft\ClassifiedsModule\OptionConfiguration\Form;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\ClassifiedsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class OptionConfigurationFormFields
{
    public function handle(
        OptionConfigurationFormBuilder $builder,
        ClassifiedRepositoryInterface $classifiedRepository,
        ProductoptionRepositoryInterface $productOptionRepository,
        ProductoptionsValueRepositoryInterface $productoptionsValueRepository
    )
    {
        if(request()->has('classified') || $builder->getEntry())
        {
            $classified = $classifiedRepository->find(request('classified') ?? $builder->getEntry());

            $options_fields = array();

            if($classified)
            {
                $options = $productOptionRepository->getWithCategoryId($classified->cat1);

                foreach ($options as $option)
                {
                    if($optionValue = $productoptionsValueRepository->getWithOptionsId([$option->id]))
                    {
                        $options_fields['option-'.$option->getId()] = [
                            'type' => 'anomaly.field_type.select',
                            'label' => $option->getName(),
                            'required' => true,
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
