<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Sede;

class SedeTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'sedes';
		$this->filename = base_path().'/database/seeds/csvs/datos/sedes.csv';
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
