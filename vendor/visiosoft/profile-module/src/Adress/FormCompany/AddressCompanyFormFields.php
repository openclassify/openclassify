<?php namespace Visiosoft\ProfileModule\Adress\FormCompany;

class AddressCompanyFormFields
{
    public function handle(AddressCompanyFormBuilder $builder)
    {
        $builder->setFields(
            [
                'company' => [
                    'required' => true,
                ],
                'tax_number' => [
                    'required' => true,
                ],
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
                'district',
                'adress_content' => [
                    'required' => true,
                ],
            ]
        );

        if (setting_value('visiosoft.module.profile::show_tax_office')) {
            $builder->addField('tax_office', [
                'required' => true,
            ]);
        }
    }
}
