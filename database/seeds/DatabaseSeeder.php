<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SedeTableSeeder::class);
        $this->call(CarreraTableSeeder::class);
        $this->call(CarreraSedeTableSeeder::class);
        $this->call(DocenteTableSeeder::class);
        
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(CatedraTableSeeder::class);
        $this->call(PlanCatedraTableSeeder::class);

        // Los usuarios necesitarán los roles, carreras previamente generados
        $this->call(UserTableSeeder::class);
        $this->call(UnidadAcademicaTableSeeder::class);        
  
        //$this->call(PlanificacionTableSeeder::class);
        //$this->call(MemoriaTableSeeder::class);
        //$this->call(RevisorTableSeeder::class);
        
    }
}
