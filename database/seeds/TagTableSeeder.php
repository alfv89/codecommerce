<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('tags')->truncate();
        DB::table('tags')->delete();

        factory('CodeCommerce\Tag', 15)->create();
    }
}
