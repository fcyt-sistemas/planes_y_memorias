<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Carrera;
use App\Docente;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_control = Role::where('name', 'control')->first();

        $user = new User();
        $user->name = 'scivico';
        $user->email = 'scivico@msn.com';
        $user->password = bcrypt('nitotero');
        $user->docente_id = Docente::where('nro_documento','26538098')->first()->id;
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'fcyt_sistemas@uader.edu.ar';
        $user->password = bcrypt('plani105kcal');
        $user->docente_id = Docente::where('nro_documento','11111111')->first()->id;
        $user->save();
        $user->roles()->attach($role_admin);
		
		$user = new User();
        $user->name = 'Academica';
        $user->email = 'fcyt_academica@uader.edu.ar';
        $user->password = bcrypt('sodio28mg1%VD');
        $user->docente_id = Docente::where('nro_documento','11111112')->first()->id;
        $user->save();
        $user->roles()->attach($role_admin);
		
		$user = new User();
        $user->name = 'Lorena';
        $user->email = 'lorenamh@gmail.com';
        $user->password = bcrypt('javilore');
        $user->docente_id = Docente::where('nro_documento','26858882')->first()->id;;
        $user->save();
        $user->roles()->attach($role_control);

    }
}
