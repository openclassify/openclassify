<?php namespace Visiosoft\AdvsModule\Adv\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class NameDescFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $appLocale = config('app.locale');
        $defaultLocale = setting_value('streams::default_locale');

        $query->join('advs_advs_translations', 'advs_advs.id', '=', 'advs_advs_translations.entry_id');

        $query->where('name', 'LIKE', '%' . $filter->getValue() . '%');
        $query->orWhere('advs_desc', 'LIKE', '%' . $filter->getValue() . '%');
        $query->orderByRaw("FIELD(locale, '$defaultLocale', '$appLocale') DESC");
    }
}
