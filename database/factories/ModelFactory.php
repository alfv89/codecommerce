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