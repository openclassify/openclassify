<?php namespace Visiosoft\ProfileModule\Adress\Form;

class AdressFormFields
{
    public function handle(AdressFormBuilder $builder)
    {
        $builder->setFields(
            [
                'adress_name' => [
                    'required' => true,
                ],
                'adress_gsm_phone' => [
                    'required' => true,
                ],
                'adress_first_name' => [
                    'required' => true,
                ],
                'adress_last_name' => [
                    'required' => true,
                ],
                'country' => [
                    'required' => true,
                ],
                'city' => [
                    'required' => false,
                ],
                'district' => [
                    'required' => setting_value( 'visiosoft.module.profile::required_district'),
                ],
                'adress_content' => [
                    'required' => true,
                ],
            ]
        );
    }
}
