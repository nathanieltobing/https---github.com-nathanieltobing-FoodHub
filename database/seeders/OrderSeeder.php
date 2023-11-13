<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'id' => 1,
            'status' => 'OPEN',
            'customer_id' => 1,
            'vendor_id' => 1,
            'order_detail_id' => 1
        ]);
    }
}
