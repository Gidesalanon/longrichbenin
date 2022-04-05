<?php

namespace Database\Seeders;

use App\Models\Enterprise;
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
        $this->call(StockSeeder::class);
        $this->call(EnterpriseSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(MagasiniersSeeder::class);
    }
}
