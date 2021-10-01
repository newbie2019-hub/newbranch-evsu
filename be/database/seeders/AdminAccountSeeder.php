<?php

namespace Database\Seeders;

use App\Models\AdminAccount;
use App\Models\AdminAccountInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account_info = AdminAccountInfo::create([
            'first_name' => 'Yvan',
            'middle_name' => 'Caindoy',
            'last_name' => 'Sabay',
            'gender' => 'Male',
            'contact_number' => '09355310166',
        ]);

        AdminAccount::create([
            'email' => 'sabayyvan2018@gmail.com',
            'password' => Hash::make('123123'),
            'admin_account_info_id' => $account_info->id
        ]);

        $account_info_ezikiel = AdminAccountInfo::create([
            'first_name' => 'Ezikiel',
            'middle_name' => 'Pura',
            'last_name' => 'Tulawan',
            'gender' => 'Male',
            'contact_number' => '09366036099',
        ]);

        AdminAccount::create([
            'email' => 'ezikielpuratulawan@gmail.com',
            'password' => Hash::make('123123'),
            'admin_account_info_id' => $account_info_ezikiel->id
        ]);
    }
}
