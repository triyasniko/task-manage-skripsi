<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->insert([
            [
                'kode_kriteria'=>'K01-DAT',
                'nama_kriteria'=>'DATELINE',
                'atribut'=>'cost',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kode_kriteria'=>'K02-BSRHNR',
                'nama_kriteria'=>'BESAR HONOR',
                'atribut'=>'benefit',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kode_kriteria'=>'K03-TNGKTKMPT',
                'nama_kriteria'=>'TINGKAT KOMPETENSI',
                'atribut'=>'benefit',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kode_kriteria'=>'K04-RPTKLN',
                'nama_kriteria'=>'REPUTASI KLIEN',
                'atribut'=>'benefit',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'kode_kriteria'=>'K05-KOMPLS',
                'nama_kriteria'=>'KOMPLEKSITAS',
                'atribut'=>'cost',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
            
        ]);
        // if(DB::table('users')->count() == 0){

        //     DB::table('users')->insert([

        //         [
        //             'name' => 'Administrator',
        //             'email' => 'admin@app.com',
        //             'password' => bcrypt('password'),
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ],
        //         [
        //             'name' => 'Agency',
        //             'email' => 'agency@app.com',
        //             'password' => bcrypt('password'),
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ],
        //         [
        //             'name' => 'End',
        //             'email' => 'endcustomer@app.com',
        //             'password' => bcrypt('password'),
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ]

        //     ]);
            
        // } else { echo "\e[31mTable is not empty, therefore NOT "; }

    }
}
