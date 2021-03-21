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
                'nombre'=>'Freddy Leon Caro Coca',
                'targeta'=>'1',
                'foto'=>'avatars/1.jpg',
                'unit_id'=>1,
                'created_at'=>now()
            ],
            [
                'nombre'=>'Javier Guzmán León',
                'targeta'=>'2',
                'foto'=>'avatars/2.jpg',
                'unit_id'=>1,
                'created_at'=>now()
            ],
            [
                'nombre'=>'Néstor Alejandro Benítez Diaz',
                'targeta'=>'3',
                'foto'=>'avatars/3.jpg',
                'unit_id'=>1,
                'created_at'=>now()
            ],
            [
                'nombre'=>'Sergio Gualberto Cruz Condori',
                'targeta'=>'4',
                'foto'=>'avatars/4.png',
                'unit_id'=>1,
                'created_at'=>now()
            ],
            [
                'nombre'=>'Elmer Flores Miranda',
                'targeta'=>'5',
                'foto'=>'avatars/5.jpg',
                'unit_id'=>1,
                'created_at'=>now()
            ],
        ]);
    }
}
