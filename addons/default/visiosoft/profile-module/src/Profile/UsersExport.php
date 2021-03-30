<?php namespace Visiosoft\ProfileModule\Profile;

use Anomaly\UsersModule\User\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements WithMapping, FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->email,
            $user->username,
            $user->first_name,
            $user->last_name,
            $user->display_name,
            $user->ip_address,
            $user->country_id,
            $user->city,
            $user->district,
            $user->neighborhood,
            $user->village,
            $user->gsm_phone,
            $user->land_phone,
            $user->office_phone,
            $user->phone_number,
            $user->register_type,
            $user->identification_number,
            $user->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'email address',
            'username',
            'first_name',
            'last_name',
            'display_name',
            'ip_address',
            'country_id',
            'city',
            'district',
            'neighborhood',
            'village',
            'gsm_phone',
            'land_phone',
            'office_phone',
            'phone_number',
            'register_type',
            'identification_number',
            'created_at',
        ];
    }
}
