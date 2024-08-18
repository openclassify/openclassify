<?php
namespace Visiosoft\AdvsModule\Adv;

use Anomaly\UsersModule\User\UserModel;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdvsExport implements WithMapping, FromCollection, WithHeadings
{
	/**
	 * @return AdvModel[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
	 */
	public function collection()
	{
		$adv = new AdvModel();

		$cats = $adv->newQuery()
			->leftJoin('cats_category', function ($q){
				$q->on('cats_category.id', 'advs_advs.cat1')
					->orOn('cats_category.id', 'advs_advs.cat2')
					->orOn('cats_category.id', 'advs_advs.cat3')
					->orOn('cats_category.id', 'advs_advs.cat4')
					->orOn('cats_category.id', 'advs_advs.cat5')
					->orOn('cats_category.id', 'advs_advs.cat6')
					->orOn('cats_category.id', 'advs_advs.cat7')
					->orOn('cats_category.id', 'advs_advs.cat8')
					->orOn('cats_category.id', 'advs_advs.cat9')
					->orOn('cats_category.id', 'advs_advs.cat10');
			})
			->leftJoin('cats_category_translations', 'cats_category.id', 'cats_category_translations.entry_id')
			->leftJoin('location_countries_translations','advs_advs.country_id', 'location_countries_translations.entry_id')
			->leftJoin('location_cities_translations','advs_advs.city', 'location_cities_translations.entry_id')
			->whereIn('cats_category_translations.locale', array(Request()->session()->get('_locale'), setting_value('streams::default_locale'), 'en'))
			->whereIn('advs_advs_translations.locale', array(Request()->session()->get('_locale'), setting_value('streams::default_locale'), 'en'))
			->select(['advs_advs_translations.name', 'advs_advs_translations.advs_desc', 'location_countries_translations.name as country', 'location_cities_translations.name as city_name', DB::raw("group_concat(default_cats_category_translations.name SEPARATOR ', ') as categories")])
			->groupBy('advs_advs.id')
			->get();

		return $cats;
	}

	public function map($adv): array
	{
		return [
			$adv->id,
			$adv->name,
			strip_tags($adv->advs_desc),
			$adv->currency,
			$adv->price,
			$adv->created_by_id,
			$adv->categories,
			$adv->country,
			$adv->city_name,
		];
	}

	public function headings(): array
	{
		return [
			'ID',
			trans('module::field.name.name'),
			trans('module::field.description'),
			trans('module::field.currency.name'),
			trans('module::field.price.name'),
			trans('module::field.created'),
			trans('module::field.categories.name'),
			trans('module::field.country.name'),
			trans('module::field.city.name'),
		];
	}
}
