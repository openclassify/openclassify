<?php
namespace Visiosoft\AdvsModule\Adv;


use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class AdvsImport implements ToModel, WithHeadingRow
{
	public function model(array $row)
    {
        if ($row['name'] !== null && $row['price'] !== null && $row['currency'] !== null) {
            return new AdvModel([
                'name' => $row['name'],
                'slug' => Str::slug($row['name']),
                'advs_desc' => $row['description'],
                'price' => $row['price'],
                'currency' => $row['currency'],
            ]);
        }
    }
}
