<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asistencias')->insert([
                ['persona_id'=>1,'tipo'=>'ENTRADA','created_at'=>now(),'nombre'=>'JUAN PEREZ','unidad'=>'UNIDAD DE SISTEMAS','unit_id'=>1],
                ['persona_id'=>2,'tipo'=>'ENTRADA','created_at'=>now(),'nombre'=>'MARIA CALLE','unidad'=>'UNIDAD DE SISTEMAS','unit_id'=>1],
//                ['persona_id'=>1,'tipo'=>'SALIDA','created_at'=>now(),'nombre'=>'JUAN PEREZ','unidad'=>'UNIDAD DE SISTEMAS','unit_id'=>1]
            ]);
    }
}
