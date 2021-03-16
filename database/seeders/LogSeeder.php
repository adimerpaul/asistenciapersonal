<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
            ['asistencia_id'=>1,'estado'=>'ENTRADA','created_at'=>now()],
            ['asistencia_id'=>1,'estado'=>'SALIDA','created_at'=>now()],
            ['asistencia_id'=>2,'estado'=>'ENTRADA','created_at'=>now()],
        ]);
    }
}
