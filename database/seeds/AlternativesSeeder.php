<?php

use Illuminate\Database\Seeder;

class AlternativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('alternatives')->insert([
            [
                'kode_alternative' => 'TA01',
                'nama_alternative' => 'TUGAS A1',
                'keterangan'=> 'Tugas A1',
                'status'=>'doing',
                'user_id' => 1,
                'tgl_duedate'=>'2023-01-17',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA02',
                'nama_alternative' => 'TUGAS A2',
                'keterangan'=> 'Tugas A2',
                'status'=>'doing',
                'user_id' => 1,
                'tgl_duedate'=>'2023-01-16',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA03',
                'nama_alternative' => 'TUGAS A3',
                'keterangan'=> 'Tugas A3',
                'status'=>'doing',
                'user_id' => 1,
                'tgl_duedate'=>'2023-01-18',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'kode_alternative'=>'TB01',
                'nama_alternative'=>'TUGAS B1',
                'keterangan'=>'Tugas B1',
                'status'=>'doing',
                'user_id'=>2,
                'tgl_duedate'=>'2023-01-17',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative'=>'TB02',
                'nama_alternative'=>'TUGAS B2',
                'keterangan'=>'Tugas B2',
                'status'=>'doing',
                'user_id'=>2,
                'tgl_duedate'=>'2023-01-16',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative'=>'TB03',
                'nama_alternative'=>'TUGAS B3',
                'keterangan'=>'Tugas B3',
                'status'=>'doing',
                'user_id'=>2,
                'tgl_duedate'=>'2023-01-18',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]
        ]);
    }
}
