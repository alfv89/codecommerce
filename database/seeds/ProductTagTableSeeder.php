<?php

use CodeCommerce\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_tag')->truncate();
        $prods = Product::all();

        foreach ($prods as $prod) {
            $tags = [];
            for ($i = 1; $i <= rand(1, 15); $i++) {
                $tags[] = rand(1, 15);
            }

            $prod->tags()->sync($tags);
        }
    }
}
