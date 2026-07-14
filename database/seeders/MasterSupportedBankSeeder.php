<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSupportedBankSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_supported_banks')->insert([
            [
                'bank_code' => '002',
                'bank_name' => 'Bank BRI',
                'is_active' => true,
                'fee' => 1500
            ],
            [
                'bank_code' => '008',
                'bank_name' => 'Bank Mandiri',
                'is_active' => true,
                'fee' => 1500
            ],
            [
                'bank_code' => '009',
                'bank_name' => 'Bank BNI',
                'is_active' => true,
                'fee' => 1500
            ],
            [
                'bank_code' => '014',
                'bank_name' => 'Bank BCA',
                'is_active' => true,
                'fee' => 1500
            ],
            [
                'bank_code' => '028',
                'bank_name' => 'Bank OCBC NISP',
                'is_active' => true,
                'fee' => 1500
            ]
        ]);
    }
}
    