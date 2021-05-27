<?php
namespace Visiosoft\CatsModule\Category;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoryExport implements WithMapping, FromCollection, WithHeadings
{
	public function collection()
	{
		return CategoryModel::all();
	}

	public function map($cats): array
	{
		return [
			$cats->id,
			$cats->name,
			$cats->parent_category_id,
            $cats->level,
            $cats->count,
            $cats->seo_keyword,
            $cats->seo_description,
		];
	}

	public function headings(): array
	{
		return [
			'ID',
			trans('module::field.name.name'),
			trans('module::field.parent'),
			trans('module::field.level'),
			trans('module::field.count'),
			trans('module::field.seo_keyword.name'),
			trans('module::field.seo_description.name'),
		];
	}
}
