<?php
namespace Visiosoft\AdvsModule\Adv;


use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class AdvsImport implements ToModel
{
	public function model(array $row)
    {
        return new AdvModel([
            'name' => $row[0],
            'slug' => Str::slug($row[0]),
            'price' => $row[1],
            'currency' => $row[2],
        ]);
    }
}
