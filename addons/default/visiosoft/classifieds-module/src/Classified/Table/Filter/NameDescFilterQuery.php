<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class NameDescFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $appLocale = config('app.locale');
        $defaultLocale = setting_value('streams::default_locale');

        $query->join('classifieds_classifieds_translations', 'classifieds_classifieds.id', '=', 'classifieds_classifieds_translations.entry_id');

        $query->where('name', 'LIKE', '%' . $filter->getValue() . '%');
        $query->orWhere('classifieds_desc', 'LIKE', '%' . $filter->getValue() . '%');
        $query->orderByRaw("FIELD(locale, '$defaultLocale', '$appLocale') DESC");
    }
}
