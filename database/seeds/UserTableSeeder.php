<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->truncate();
        DB::table('users')->delete();

        factory('CodeCommerce\User')->create([
            'name' => 'Administrator',
            'email' => 'admin@codecommerce.com',
            'address' => 'Rua dos Bobos, n 0',
            'city' => 'Oz',
            'state' => 'Asdrubal',
            'fu' => 'AS',
            'zipcode' => '22333000',
            'password' => Hash::make(123456),
            'is_admin' => 1,
            'remember_token' => Hash::make(str_random(10)),
        ]);

        factory('CodeCommerce\User')->create([
            'name' => 'Arthur Vasconcelos',
            'email' => 'vasconcelos.arthur@gmail.com',
            'address' => 'Rua dos Bobos, n 0',
            'city' => 'Oz',
            'state' => 'Asdrubal',
            'fu' => 'AS',
            'zipcode' => '22333000',
            'password' => Hash::make(123456),
            'remember_token' => Hash::make(str_random(10)),
        ]);

        factory('CodeCommerce\User', 5)->create();
    }
}
