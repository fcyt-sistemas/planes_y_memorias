<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Docente;

class DocenteTableSeeder extends CsvSeeder
{
    
    public function __construct()
	{
		$this->table = 'docentes';
		$this->filename = base_path().'/database/seeds/csvs/docentes.csv';
	}
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cargo los docentes migrados del guarani
        parent::run();
 
        //agrego manualmente algunos docentes
        $docente = new Docente();
        $docente->unidad_academica = 'FCYT';
        $docente->apellidos = 'Silvani';
        $docente->nombres = 'Maria Laura';
        $docente->nro_documento = '25931605';
        $docente->save();
      

        $docente = new Docente();
        $docente->unidad_academica = 'FCYT';
        $docente->apellidos = 'Civico';
        $docente->nombres = 'Sergio Angel';
        $docente->nro_documento = '26538098';
        $docente->save();
		
		$docente = new Docente();
        $docente->unidad_academica = 'FCYT';
        $docente->apellidos = 'FCYT-UADER';
        $docente->nombres = 'Secretaría Académica';
        $docente->nro_documento = '11111112';
        $docente->save();
		
		$docente = new Docente();
        $docente->unidad_academica = 'FCYT';
        $docente->apellidos = 'FCYT-UADER';
        $docente->nombres = 'Departamento de Sistemas';
        $docente->nro_documento = '11111111';
        $docente->save();
    }
}
