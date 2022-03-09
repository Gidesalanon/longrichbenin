<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'code' => '1',
            'nom' => 'Admin KDL',
            'prenom' => 'KDL',
            'email' => 'adminkdl@gmail.com',
            'adresse' => 'cotonou',
            'tel' => '+229 97261458',
            'status' => '1', //compte validé
            'password' => bcrypt('adminkdl'),
            'is_admin' => 1, //admin=1 & non admin=0
            'isban' => '0', //compte activé
        ]);
    }
}
