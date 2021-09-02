<?php namespace Visiosoft\ClassifiedsModule\Support\Command;

class GetBuyables
{
    public function handle()
    {
        return [
            'balances' => [
                'name' => trans('visiosoft.module.classifieds::field.balances'),
                'entry_type' => 'Visiosoft\BalancesModule\Balance\BalanceModel'
            ],
            'packages' => [
                'name' => trans('visiosoft.module.classifieds::field.packages'),
                'entry_type' => 'Visiosoft\PackagesModule\Package\PackageModel'
            ],
            'dopings' => [
                'name' => trans('visiosoft.module.classifieds::field.dopings'),
                'entry_type' => 'Anomaly\Streams\Platform\Model\Dopings\DopingsDopingsEntryModel'
            ],
            'classifieds' => [
                'name' => trans('visiosoft.module.classifieds::field.classifieds'),
                'entry_type' => 'Visiosoft\ClassifiedsModule\Classified\ClassifiedModel'
            ],
            'site' => [
                'name' => trans('visiosoft.module.classifieds::field.site'),
                'entry_type' => 'Visiosoft\SiteModule\Addon\AddonModel'
            ],
            'subscriptions' => [
                'name' => trans('visiosoft.module.classifieds::field.subscriptions'),
                'entry_type' => 'Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel'
            ],
        ];
    }
}
