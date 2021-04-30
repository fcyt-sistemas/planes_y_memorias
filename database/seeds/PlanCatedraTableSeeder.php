<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class PlanCatedraTableSeeder extends CsvSeeder
{
   public function __construct()
	{
		$this->table = 'plan_catedra';
		$this->filename = base_path().'/database/seeds/csvs/datos/plan_catedra.csv';
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
