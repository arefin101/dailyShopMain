<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            'id' => 1,
            'userName' => 'khanbahadur',
            'productName' => 'Tshirt1',
            'price' => 145,
            'color' => 'black',
            'quantity' => 2,
            'picture' => "defaultP.jpg",
        ]);
    }

}
