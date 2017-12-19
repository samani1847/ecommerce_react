<?php

use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table("voucher")->insert([
            'name' => 'Harbolnas Voucher',
            'discount' => 20,
            'max_claim' => 100,
            'claimed' => 0,
            'status' => true,
            'start_date'=> '2017-11-01',
            'end_date' => '2017-12-30',
            'code' => 'ABC123'
            ]);
    }
}
