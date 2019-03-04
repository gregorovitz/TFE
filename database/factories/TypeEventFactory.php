<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 04/03/2019
 * Time: 14:02
 */
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

$factory->define(App\TypeEvents::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('typeEventtest ##'),

    ];
});