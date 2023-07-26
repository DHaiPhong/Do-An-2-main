<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(OrdersTableSeeder::class);
        $this->call(RatingTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(OrderItemsTableSeeder::class);
    }
}
