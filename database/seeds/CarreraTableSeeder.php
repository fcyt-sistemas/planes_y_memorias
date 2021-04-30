<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class CarreraTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'carreras';
		$this->filename = base_path().'/database/seeds/csvs/datos/carreras.csv';
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
