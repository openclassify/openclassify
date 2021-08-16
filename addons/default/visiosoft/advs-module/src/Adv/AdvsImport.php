<?php
namespace Visiosoft\AdvsModule\Adv;


use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class AdvsImport implements ToModel, WithHeadingRow
{
	public function model(array $row)
    {
        $row['name'] = $row['name'] ?? $row['title'];
        if ($row['name'] !== null && $row['price'] !== null && $row['currency'] !== null) {
	        return new AdvModel([
		        'name' => $row['name'],
		        'slug' => Str::slug($row['name']),
		        'advs_desc' => $row['description'] ?? null,
		        'standard_price' => $row['standard_price'] ?? 0,
		        'price' => $row['price'],
		        'currency' => $row['currency'],
		        'country' => $row['country'] ?? null,
		        'city' => $row['city'] ?? null,
		        'cat1' => $row['cat1'] ?? null,
		        'cat2' => $row['cat2'] ?? null,
	        ]);
        }
    }
}
