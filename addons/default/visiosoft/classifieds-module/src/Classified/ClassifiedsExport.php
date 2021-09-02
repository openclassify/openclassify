<?php
namespace Visiosoft\ClassifiedsModule\Classified;

use Anomaly\UsersModule\User\UserModel;
use Illuminate\Support\Facades\DB;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClassifiedsExport implements WithMapping, FromCollection, WithHeadings
{
	/**
	 * @return ClassifiedModel[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
	 */
	public function collection()
	{
		$classified = new ClassifiedModel();

		$cats = $classified->newQuery()
			->leftJoin('cats_category', function ($q){
				$q->on('cats_category.id', 'classifieds_classifieds.cat1')
					->orOn('cats_category.id', 'classifieds_classifieds.cat2')
					->orOn('cats_category.id', 'classifieds_classifieds.cat3')
					->orOn('cats_category.id', 'classifieds_classifieds.cat4')
					->orOn('cats_category.id', 'classifieds_classifieds.cat5')
					->orOn('cats_category.id', 'classifieds_classifieds.cat6')
					->orOn('cats_category.id', 'classifieds_classifieds.cat7')
					->orOn('cats_category.id', 'classifieds_classifieds.cat8')
					->orOn('cats_category.id', 'classifieds_classifieds.cat9')
					->orOn('cats_category.id', 'classifieds_classifieds.cat10');
			})
			->leftJoin('cats_category_translations', 'cats_category.id', 'cats_category_translations.entry_id')
			->leftJoin('location_countries_translations','classifieds_classifieds.country_id', 'location_countries_translations.entry_id')
			->leftJoin('location_cities_translations','classifieds_classifieds.city', 'location_cities_translations.entry_id')
			->whereIn('cats_category_translations.locale', array(Request()->session()->get('_locale'), setting_value('streams::default_locale'), 'en'))
			->whereIn('classifieds_classifieds_translations.locale', array(Request()->session()->get('_locale'), setting_value('streams::default_locale'), 'en'))
			->select(['classifieds_classifieds_translations.name', 'classifieds_classifieds_translations.classifieds_desc', 'location_countries_translations.name as country', 'location_cities_translations.name as city_name', DB::raw("group_concat(default_cats_category_translations.name SEPARATOR ', ') as categories")])
			->groupBy('classifieds_classifieds.id')
			->get();

		return $cats;
	}

	public function map($classified): array
	{
		return [
			$classified->id,
			$classified->name,
			strip_tags($classified->classifieds_desc),
			$classified->currency,
			$classified->price,
			$classified->standard_price,
			$classified->created_by_id,
			$classified->categories,
			$classified->country,
			$classified->city_name,
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
			trans('module::field.standard_price.name'),
			trans('module::field.created'),
			trans('module::field.categories.name'),
			trans('module::field.country.name'),
			trans('module::field.city.name'),
		];
	}
}
