<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            adminSeeder::class,
            categorySeeder::class,
            customerSeeder::class,
            productSeeder::class,
            userSeeder::class,
        ]);
    }
}
