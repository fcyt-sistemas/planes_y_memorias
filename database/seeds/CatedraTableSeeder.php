<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;


class CatedraTableSeeder extends CsvSeeder 
{
    
    public function __construct()
	{
		$this->table = 'catedras';
		$this->filename = base_path().'/database/seeds/csvs/datos/catedras.csv';
	}
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
       
/*        $faker = Faker\Factory::create();
        $catedras = App\Catedra::all();
        foreach($catedras as $cat){
            $plan = App\Plan::find($faker->numberBetween(1, 9));
            $cat->planes()->attach($plan);
            //dd($sede);
        }
       
        //factory(App\Catedra::class, 100)->create(); */
    }
}
