<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class PlanTableSeeder extends CsvSeeder
{
   public function __construct()
	{
		$this->table = 'planes';
		$this->filename = base_path().'/database/seeds/csvs/datos/planes.csv';
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
