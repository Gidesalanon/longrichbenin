<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Enterprise;

class MagasiniersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'code' => '2',
            'nom' => 'Gestionnaire',
            'prenom' => 'Principal',
            'email' => 'gestionnaire@gmail.com',
            'adresse' => 'cotonou',
            'tel' => '+229 00000000',
            'status' => '1', //compte validé
            'password' => bcrypt('gestionnaire1'),
            'is_admin' => 2, //admin=1 & non admin=0
            'is_magasinier' => 1, //magasinier=1 & non magasini=0
            'isban' => '0', //compte activé
            'enterprise_id' => Enterprise::all()->random()->id,
        ]);
    }
}
