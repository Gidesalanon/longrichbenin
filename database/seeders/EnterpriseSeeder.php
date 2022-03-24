<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enterprise;
use App\Models\Stock;

class EnterpriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enterprise::create([
            'id' => 1,
            'designation' => '...',
            'adresse' => '...',
            'stock_id' => Stock::all()->random()->id,
        ]);
    }
}
