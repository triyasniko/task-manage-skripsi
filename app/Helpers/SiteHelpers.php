<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class SiteHelpers{
    public static function get_user_id(){
        $user_id=auth()->user()->id;
        return $user_id;
    }
    public static function TOPSIS_get_hasil_analisa(){
        $id_user=SiteHelpers::get_user_id();
        $results=DB::table('alternatives as a')
        ->join('rel_alternatives as ra', 'ra.kode_alternative', '=', 'a.kode_alternative')
        ->join('kriterias as k', 'k.kode_kriteria', '=', 'ra.kode_kriteria')
        ->select('a.kode_alternative', 'k.kode_kriteria', 'ra.nilai')
        ->where('a.user_id', $id_user)
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
        $results=DB::table('alternatives')
        ->select('kode_alternative', 'nama_alternative')
        ->where('user_id', SiteHelpers::get_user_id())
        ->get();
        $ALTERNATIVE=array();
        foreach($results as $result){
            $ALTERNATIVE[$result->kode_alternative]=$result->nama_alternative;
        }
        return $ALTERNATIVE;
    }
    public static function get_kriteria(){
        $results=DB::table('kriterias')
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
    public static function AHP_get_relkriteria(){
        $relKriterias=array();
        $query = DB::table('rel_kriterias as rk')
            ->join('kriterias as k', 'k.kode_kriteria', '=', 'rk.id1')
            ->select('k.nama_kriteria', 'rk.id1', 'rk.id2', 'nilai')
            ->orderBy('id1', 'asc')
            ->orderBy('id2', 'asc')
            ->get();
        foreach($query as $q){
            $relKriterias[$q->id1][$q->id2]=$q->nilai;
        }
        return $relKriterias;
    }
    public static function AHP_get_total_kolom($matriks=array()){
        $totalKolom=array();
        foreach($matriks as $id1=>$m){
            foreach($m as $id2=>$nilai){
                if(!isset($totalKolom[$id2])){
                    $totalKolom[$id2]=0;
                }
                $totalKolom[$id2]+=$nilai;
            }
        }
        return $totalKolom;
    }
    public static function AHP_normalize($matriks=array(), $total=array()){
        foreach($matriks as $key => $value){
            foreach($value as $k => $v){
                $matriks[$key][$k] = $matriks[$key][$k]/$total[$k];
            }
        }     
        return $matriks;     
    }
    public static function AHP_get_rata($matriksNormal){
        $rata=array();
        foreach($matriksNormal as $key => $value){
            $rata[$key]=array_sum($value)/count($value);
        }
        return $rata;
    }
    public static function AHP_mmult($matriks = array(), $rata = array()){
        $data = array();
        $rata = array_values($rata);
        // dd($matriks);
        foreach($matriks as $key => $value){
            $no=0;
            // var_dump($key.$value);
            foreach($value as $k => $v){
                if(!isset($data[$key])){
                    $data[$key]=0;
                }
                $data[$key]+=$v*$rata[$no];       
                $no++;  
            }			
        }
        // dd($data);
        return $data;
    }

    public static function AHP_consistency_measure($matriks=array(), $rata){
        // $matriks=AHP_mmult($matriks, $rata);
        // call function AHP_mmult
        $data=array();
        $matriks=self::AHP_mmult($matriks, $rata);
        // dd($matriks);
        foreach($matriks as $key => $value){
            $data[$key]=$value/$rata[$key];
        }
        return $data;
    }

    public static function AHP_get_nRI(){
        $nRI = array (
            1=>0,
            2=>0,
            3=>0.58,
            4=>0.9,
            5=>1.12,
            6=>1.24,
            7=>1.32,
            8=>1.41,
            9=>1.46,
            10=>1.49,
            11=>1.51,
            12=>1.48,
            13=>1.56,
            14=>1.57,
            15=>1.59
        );
        return $nRI;
    }
    // public static function TOPSIS_get_hasil_analisa(){
    //    $rows= DB::table('Alternatives as a')
    //    ->join('Rel_Alternative as ra', 'ra.kode_alternatives', '=', 'a.kode_alternatives')
    //    ->join('tb_kriteria as k', 'k.kode_kriteria', '=', 'ra.kode_kriteria')
    //    ->select('a.kode_alternatives', 'k.kode_kriteria', 'ra.nilai')
    //    ->orderBy('a.kode_alternatives', 'asc')
    //    ->orderBy('k.kode_kriteria', 'asc')
    //    ->get();
    //      $data=array();
    //         foreach($rows as $row){
    //             $data[$row->kode_alternatives][$row->kode_kriteria]=$row->nilai;
    //         }
    //         return $data;
    // }
    public static function TOPSIS_hasil_analisa(){
        $data=self::TOPSIS_get_hasil_analisa();
        return $data;
    }

    public static function TOPSIS_normalize($array, $max=true){
        $data=array();
        $kuadrat=array();
        foreach($array as $key => $value){
            foreach($value as $k => $v){
                if(!isset($kuadrat[$k])){
                    $kuadrat[$k]=0;
                }
                $kuadrat[$k]+=$v*$v;
            }
        }
        foreach($array as $key => $value){
            foreach($value as $k => $v){
                $data[$key][$k]=$v/sqrt($kuadrat[$k]);
            }
        }
        return $data;
    }
    public static function TOPSIS_normalize_terbobot($array, $bobot){
        $data=array();
        foreach($array as $key => $value){
            foreach($value as $k => $v){
                $data[$key][$k]=$v*$bobot[$k];
            }
        }
        return $data;
    }
    public static function TOPSIS_solusi_ideal($array){
        $kriteria=self::get_kriteria();
        $data=array();
        $temp=array();
        foreach($array as $key => $value){
            foreach($value as $k => $v){
                if(!isset($temp[$k])){
                    $temp[$k]=array();
                }
                $temp[$k][]=$v;
            }
        }
        foreach($temp as $key => $value){
            $max=max($value);
            $min=min($value);
            if($kriteria[$key]['atribut']=='benefit'){
                $data['positif'][$key]=$max;
                $data['negatif'][$key]=$min;
            }else{
                $data['positif'][$key]=$min;
                $data['negatif'][$key]=$max;
            }
        }
        return $data;
    }
    public static function TOPSIS_jarak_solusi($array, $matriksIdeal){
        $temp=array();
        $arr=array();
        foreach($array as $key => $value){                
            foreach($value as $k => $v){
                if(!isset($temp[$key])){
                    $temp[$key]=array();
                    $temp[$key]['positif']=0;
                    $temp[$key]['negatif']=0;
                }
                if(!isset($arr['positif'][$key])){
                    $arr['positif'][$key]=array();
                    $arr['negatif'][$key]=array();
                }

                $arr['positif'][$key][$k]=pow($v-$matriksIdeal['positif'][$k], 2);
                $arr['negatif'][$key][$k]=pow($v-$matriksIdeal['negatif'][$k], 2);

                $temp[$key]['positif']+=pow($v-$matriksIdeal['positif'][$k], 2);
                $temp[$key]['negatif']+=pow($v-$matriksIdeal['negatif'][$k], 2);
            }       
            $temp[$key]['positif'] = sqrt($temp[$key]['positif']);
            $temp[$key]['negatif'] = sqrt($temp[$key]['negatif']);
        }
        return $temp;
    }
    public static function TOPSIS_preferensi($array){
        $krieria=self::get_kriteria();
        $temp=array();
        foreach($array as $key => $value){
            $temp[$key]=$value['negatif']/($value['positif']+$value['negatif']);
        }
        return $temp;
    }
    public static function get_rank($alternatives, $topsisNormal, $nilaiPref){
        $data=$nilaiPref;
        arsort($data);
        $no=1;
        $newArray=array();
        
        foreach($data as $key => $value){
            $newArray[$key]=$no++;
        }
        foreach($topsisNormal as $key => $value){
            DB::table('alternatives')
            ->where('kode_alternative', $key)
            ->update([
                'total' => $nilaiPref[$key],
                'rank' => $newArray[$key]
            ]);
        }
        // dd($newArray);
        return $newArray;
    }
}