<?php

namespace Database\Seeders;

use App\Models\Tier;
use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiers = [
            [
                'name' => 'SMP - 7',
                'status' => 1,
                'price' => '500000'
            ],
            [
                'name' => 'SMP - 8',
                'status' => 1,
                'price' => '600000'
            ],
            [
                'name' => 'SMP - 9',
                'status' => 1,
                'price' => '700000'
            ],
            [
                'name' => 'SMA - 10',
                'status' => 1,
                'price' => '700000'
            ],
            [
                'name' => 'SMA - 11',
                'status' => 1,
                'price' => '800000'
            ],
            [
                'name' => 'SMA - 12',
                'status' => 1,
                'price' => '900000'
            ]
        ];
        Tier::insert($tiers);
    }
}
