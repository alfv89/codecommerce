<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('product_images')->truncate();
        DB::table('product_images')->delete();
        $files = Storage::disk('public')->files();

        if(($key = array_search('.gitignore', $files)) !== false) {
            unset($files[$key]);
        }

        Storage::disk('public')->delete($files);

        factory('CodeCommerce\ProductImage', 20)->create();
    }
}
