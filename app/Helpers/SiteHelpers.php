<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class SiteHelpers{
    public static function TOPSIS_get_hasil_analisa(){
        $results=DB::table('Alternatives as a')
        ->join('Rel_Alternatives as ra', 'ra.kode_alternative', '=', 'a.kode_alternative')
        ->join('Kriterias as k', 'k.kode_kriteria', '=', 'ra.kode_kriteria')
        ->select('a.kode_alternative', 'k.kode_kriteria', 'ra.nilai')
        ->orderBy('a.kode_alternative')
        ->orderBy('k.kode_kriteria')
        ->get();
        $data=array();
        foreach($results as $result){
            $data[$result->kode_alternative][$result->kode_kriteria]=$result->nilai;
        }
        return $data;
    }
    public static function get_alternative(){
        $results=DB::table('Alternatives')
        ->select('kode_alternative', 'nama_alternative')
        ->get();
        $ALTERNATIVE=array();
        foreach($results as $result){
            $ALTERNATIVE[$result->kode_alternative]=$result->nama_alternative;
        }
        return $ALTERNATIVE;
    }
    public static function get_kriteria(){
        $results=DB::table('Kriterias')
        ->select('kode_kriteria', 'nama_kriteria', 'atribut')
        ->orderBy('kode_kriteria')
        ->get();
        $KRITERIA=array();
        foreach($results as $result){
            $KRITERIA[$result->kode_kriteria]=array(
                'nama_kriteria'=>$result->nama_kriteria,
                'atribut'=>$result->atribut,
                'bobot'=>0,
            );
        }
        return $KRITERIA;
    }

}