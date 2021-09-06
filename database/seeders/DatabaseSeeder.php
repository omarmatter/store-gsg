<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\category;
use App\Models\product;
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
        Admin::factory(2)->create();
        // category::factory(50)->create();
        // product::factory(50)->create();
    }
}
