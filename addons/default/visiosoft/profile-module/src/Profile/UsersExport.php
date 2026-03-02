<?php namespace Visiosoft\ProfileModule\Profile;

use Anomaly\UsersModule\User\User;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements WithMapping, FromCollection, WithHeadings
{
    protected $cols, $data;
    public function __construct()
    {
        $data = User::all();
        $firstUser = $data->first();
        $cols = [];
        if (!empty($firstUser)) {
            $firstUser = $firstUser->makeHidden([
                'password',
                'remember_token',
                'activation_code',
                'reset_code',
                'updated_at',
                'updated_by_id',
                'deleted_at',
                'created_by_id',
                'sort_order'
            ])->toArray();
            foreach ($firstUser as $key => $item) {
                $cols[] = $key;
            }
        }
        $this->data = $data;
        $this->cols = $cols;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($user): array
    {
        $userData = $user->makeHidden([
            'password',
            'remember_token',
            'activation_code',
            'reset_code',
            'updated_at',
            'updated_by_id',
            'deleted_at',
            'created_by_id',
            'sort_order'
        ])->toArray();
        $row = [];
        if (!empty($userData)) {
            foreach ($userData as $key => $data) {
                $row[] = $data;
            }
        }
        return $row;
    }

    public function headings(): array
    {

        return $this->cols;
    }
}
