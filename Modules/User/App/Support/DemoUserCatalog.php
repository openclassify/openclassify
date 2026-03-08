<?php

namespace Modules\User\App\Support;

final class DemoUserCatalog
{
    public static function records(): array
    {
        return [
            [
                'email' => 'a@a.com',
                'name' => 'Admin',
                'password' => '236330',
                'phone' => '+905551112233',
                'is_admin' => true,
            ],
            [
                'email' => 'b@b.com',
                'name' => 'Member',
                'password' => '236330',
                'phone' => '+905551112244',
                'is_admin' => false,
            ],
            [
                'email' => 'c@c.com',
                'name' => 'Ava Carter',
                'password' => '236330',
                'phone' => '+905551112255',
                'is_admin' => false,
            ],
            [
                'email' => 'd@d.com',
                'name' => 'Liam Stone',
                'password' => '236330',
                'phone' => '+905551112266',
                'is_admin' => false,
            ],
            [
                'email' => 'e@e.com',
                'name' => 'Mila Reed',
                'password' => '236330',
                'phone' => '+905551112277',
                'is_admin' => false,
            ],
        ];
    }

    public static function emails(): array
    {
        return array_column(self::records(), 'email');
    }

    public static function phoneFor(string $email): string
    {
        foreach (self::records() as $record) {
            if ($record['email'] === $email) {
                return $record['phone'];
            }
        }

        return '+905551110000';
    }

    public static function isAdmin(string $email): bool
    {
        foreach (self::records() as $record) {
            if ($record['email'] === $email) {
                return (bool) $record['is_admin'];
            }
        }

        return false;
    }
}
