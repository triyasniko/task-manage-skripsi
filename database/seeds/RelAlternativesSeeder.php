<?php

use Illuminate\Database\Seeder;

class RelAlternativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rel_alternatives')->insert([
            [
                'kode_alternative' => 'TA01',
                'kode_kriteria'=>'K01-DAT',
                'nilai'=>2,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA01',
                'kode_kriteria'=>'K02-BSRHNR',
                'nilai'=>3,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA01',
                'kode_kriteria'=>'K03-TNGKTKMPT',
                'nilai'=>4,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA01',
                'kode_kriteria'=>'K04-RPTKLN',
                'nilai'=>5,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA01',
                'kode_kriteria'=>'K05-KOMPLS',
                'nilai'=>1,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA02',
                'kode_kriteria'=>'K01-DAT',
                'nilai'=>3,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA02',
                'kode_kriteria'=>'K02-BSRHNR',
                'nilai'=>4,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA02',
                'kode_kriteria'=>'K03-TNGKTKMPT',
                'nilai'=>5,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA02',
                'kode_kriteria'=>'K04-RPTKLN',
                'nilai'=>1,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA02',
                'kode_kriteria'=>'K05-KOMPLS',
                'nilai'=>2,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA03',
                'kode_kriteria'=>'K01-DAT',
                'nilai'=>4,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA03',
                'kode_kriteria'=>'K02-BSRHNR',
                'nilai'=>5,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA03',
                'kode_kriteria'=>'K03-TNGKTKMPT',
                'nilai'=>1,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA03',
                'kode_kriteria'=>'K04-RPTKLN',
                'nilai'=>2,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'kode_alternative' => 'TA03',
                'kode_kriteria'=>'K05-KOMPLS',
                'nilai'=>3,
                'user_id' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]
        ]);
    }
}
