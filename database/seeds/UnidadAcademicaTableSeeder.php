<?php

use Illuminate\Database\Seeder;
use App\UnidadAcademica;
class UnidadAcademicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ua = new UnidadAcademica();
        $ua->codigo = '4';
        $ua->nombre = 'Oro Verde';
        $ua->direccion = 'Ruta 11km 10.5';
        $ua->localidad = 'Oro Verde';
        $ua->codigo_postal = 3100;
        $ua->telefono = '343-4975066';
        $ua->email = 'fcyt_alumnado@uader.edu.ar';
        $ua->save();
    }
}
