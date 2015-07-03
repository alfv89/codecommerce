<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

$factory->define(CodeCommerce\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make(str_random(10)),
        'remember_token' => Hash::make(str_random(10)),
    ];
});

$factory->define(CodeCommerce\Category::class, function ($faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(),
    ];
});

$factory->define(CodeCommerce\Product::class, function ($faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(),
        'price' => $faker->randomFloat(2,1,100),
        'featured' => $faker->boolean(),
        'recommend' => $faker->boolean(),
        'category_id' => $faker->numberBetween(1,10),
    ];
});

$factory->define(CodeCommerce\ProductImage::class, function ($faker) {
    $width = rand(100,1000);
    $height = rand(100,1000);
    $name = md5('random'.rand().'_'.time()).'.jpg';

    $image = Image::make($faker->imageUrl($width, $height));
    $image->save(public_path('uploads').'/'.$name, 60);

    return [
        'name' => $name,
        'extension' => 'jpg',
        'mime' => $image->mime(),
        'size' => rand(),
        'product_id' => $faker->numberBetween(1,50),
    ];
});