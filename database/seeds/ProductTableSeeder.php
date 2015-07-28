<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('products')->truncate();
        DB::table('products')->delete();

        factory('CodeCommerce\Product', 50)->create();
    }
}
