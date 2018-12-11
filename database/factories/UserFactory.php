<?php

use Faker\Generator as Faker;

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    //用户创建时间
    $created_time=\Carbon\Carbon::now()->toDateTimeString();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('admin888'), // secret
        'remember_token' => str_random(10),
        'intro' => $faker->realText(50),
        'avatar'        => '/avatar/aratar_'.rand(1, 1697).'.jpg',
        'created_at' => $created_time,
        'updated_at' => $created_time,
    ];
});
