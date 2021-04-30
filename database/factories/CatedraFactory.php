<?php

use Faker\Generator as Faker;

$factory->define(App\Catedra::class, function (Faker $faker) {
    return [
        'codigo' => $faker->numberBetween(10000, 50000),
        'nombre' => $faker->sentence(3),
        'periodo_lectivo'=>$faker->sentence(3),
        'carga_horaria'=> $faker->numberBetween(3, 10),
        ];
});
