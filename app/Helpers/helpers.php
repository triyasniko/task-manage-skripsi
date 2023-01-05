<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class Helpers{
    public static function TOPSIS_get_hasil_analisa(){
        $results=DB::table('tb_alternatif as a')
        ->join('tb_rel_alternatif as ra', 'ra.kode_alternatif', '=', 'a.kode_alternatif')
        ->join('tb_kriteria as k', 'k.kode_kriteria', '=', 'ra.kode_kriteria')
        ->select('a.kode_alternatif', 'k.kode_kriteria', 'ra.nilai')
        ->orderBy('a.kode_alternatif')
        ->orderBy('k.kode_kriteria')
        ->get();
        $data=array();
        foreach($results as $result){
            $data[$result->kode_alternatif][$result->kode_kriteria]=$result->nilai;
        }
        return $data;
    }
}