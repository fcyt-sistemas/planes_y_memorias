<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
class CarreraSedeTableSeeder extends CsvSeeder
{
   
    public function __construct()
	{
		$this->table = 'carrera_sede';
		$this->filename = base_path().'/database/seeds/csvs/datos/carreras_sedes.csv';
	}
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       parent::run();
    }
}
