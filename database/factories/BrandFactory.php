<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Brand;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'brand_name' => $faker->name,
        'brand_url' => Str::random(10).'@gmail.com',
        'brand_logo' => 'http://uploads.2001api.com/uploads/jOVlSBPyCkHigU445IzLrS575v5I71cXF6X11F4d.jpeg',
        'brand_desc' => Str::random(10),
        'created_at' => date("Y-m-d H:i:s",time()),
        'updated_at' => date("Y-m-d H:i:s",time()),
    ];
});
