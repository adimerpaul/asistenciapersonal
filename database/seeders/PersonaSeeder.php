<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            [
                'nombre'=>'JUAN PEREZ',
                'targeta'=>'14738893',
                'unit_id'=>1,
                'created_at'=>now()
            ],
            [
                'nombre'=>'MARIA CALLE',
                'targeta'=>'14906023',
                'unit_id'=>1,
                'created_at'=>now()
            ],
            [
                'nombre'=>'MARIEL COCA',
                'targeta'=>'07735693',
                'unit_id'=>1,
                'created_at'=>now()
            ],
        ]);
    }
}
