<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'Usuario Docente';
        $role->save();
        
        $role = new Role();
        $role->name = 'control';
        $role->description = 'Usuario Controlador';
        $role->save();

        $role = new Role();
        $role->name = 'lectura'; 
        $role->description = 'Usuario de Solo Lectura';
        $role->save();
        
    }
}
