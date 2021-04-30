<?php

use Illuminate\Database\Seeder;

class MemoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Memoria::class, 100)->create();
    }
}
