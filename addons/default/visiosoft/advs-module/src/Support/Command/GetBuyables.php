<?php namespace Visiosoft\AdvsModule\Support\Command;

class GetBuyables
{
    public function handle()
    {
        return [
            'balances' => [
                'name' => trans('visiosoft.module.advs::field.balances'),
                'entry_type' => 'Visiosoft\BalancesModule\Balance\BalanceModel'
            ],
            'packages' => [
                'name' => trans('visiosoft.module.advs::field.packages'),
                'entry_type' => 'Visiosoft\PackagesModule\Package\PackageModel'
            ],
            'dopings' => [
                'name' => trans('visiosoft.module.advs::field.dopings'),
                'entry_type' => 'Anomaly\Streams\Platform\Model\Dopings\DopingsDopingsEntryModel'
            ],
            'advs' => [
                'name' => trans('visiosoft.module.advs::field.advs'),
                'entry_type' => 'Visiosoft\AdvsModule\Adv\AdvModel'
            ],
            'site' => [
                'name' => trans('visiosoft.module.advs::field.site'),
                'entry_type' => 'Visiosoft\SiteModule\Addon\AddonModel'
            ],
            'subscriptions' => [
                'name' => trans('visiosoft.module.advs::field.subscriptions'),
                'entry_type' => 'Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel'
            ],
        ];
    }
}
