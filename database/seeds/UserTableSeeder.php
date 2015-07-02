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
        DB::table('users')->truncate();

        factory('CodeCommerce\User')->create([
            'name' => 'Arthur Vasconcelos',
            'email' => 'vasconcelos.arthur@gmail.com',
            'password' => Hash::make(123456),
            'remember_token' => Hash::make(str_random(10)),
        ]);

        factory('CodeCommerce\User', 5)->create();
    }
}
