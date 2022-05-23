<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::create([
            'id' => '1',
            'libelle' => 'Stock first',
            'status' => 'Encours',
            'dateacquis' => '2011-02-04',
            'description' => 'Stock seeding',
        ]);
    }
}
