<?php

use Faker\Generator as Faker;

$factory->define(App\Memoria::class, function (Faker $faker) {
    return [
        'sede_id' => $faker->numberBetween(1, 3),
        'catedra_id' => $faker->numberBetween(1, 30),
        'plan_id' => $faker->numberBetween(1, 4),
        'carrera_id' => $faker->numberBetween(1, 20),
        'docente_id' => $faker->numberBetween(1, 800),
        'planificacion_id' => $faker->numberBetween(1, 30),
        'anio_academico' => $faker->numberBetween(2017, 2020),
        'equipo_docente' => $faker->name.', '.$faker->name.', '.$faker->name,
        'anio_carrera' => $faker->numberBetween(1, 5),
        'regimen_materia' => $faker->sentence(1),
        'carga_horaria' => $faker->numberBetween(4, 8),
        'ajus_plani_original' => $faker->text(200),
        'alu_cursaron' => $faker->numberBetween(0, 50),
        'alu_ini_regulares' => $faker->numberBetween(0, 50),
        'alu_regularizaron' => $faker->numberBetween(0, 50),
        'alu_abndonaron' =>  $faker->numberBetween(0, 50),
        'alu_promocionaron' => $faker->numberBetween(0, 50),
        'clases_desarrolladas' => $faker->numberBetween(0, 50),
        'recup_realizadas' => $faker->numberBetween(0, 50),
        'org_promo_catedra_obs' => $faker->text(100),
        'regimen_curs_promo' => $faker->sentence(200),
        'cond_des_esp_curri' => $faker->text(100),
        'cumpl_req_rendir' => $faker->text(100),
        'cumpl_cron_trabajo' => $faker->text(100),
        'cumpl_equipo_catedra' => $faker->text(100),
        'cumpl_mecan_autoeval' => $faker->text(100),
    ];
});
