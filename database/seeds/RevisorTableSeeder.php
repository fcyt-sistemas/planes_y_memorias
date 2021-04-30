<?php

use Illuminate\Database\Seeder;
use App\Revisor;
class RevisorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $carrera1 = App\Carrera::where('codigo',34)->first();
        $carrera2 = App\Carrera::where('codigo',12)->first();
        $carrera3 = App\Carrera::where('codigo',22)->first();
        $docente1 = App\Docente::where('nro_documento','26858882')->first();
        $docente2 = App\Docente::where('nro_documento','20457119')->first();
        
        //$user = new User();
        $revisor1 = new Revisor();
        $revisor1->carrera_id = $carrera1->id;
        $revisor1->sede_id = 1;
        $revisor1->docente_id = $docente1->id;
        $revisor1->save();
        $revisor2 = new Revisor();
        $revisor2->carrera_id = $carrera2->id;
        $revisor2->sede_id = 1;
        $revisor2->docente_id = $docente2->id;
        $revisor2->save();
        $revisor3 = new Revisor();
        $revisor3->carrera_id = $carrera3->id;
        $revisor3->sede_id = 3;
        $revisor3->docente_id = $docente2->id;
        $revisor3->save();
    }
}
