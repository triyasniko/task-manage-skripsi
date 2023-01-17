<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SiteHelpers;
use Carbon\Carbon;

class UserController extends Controller{
    public function index(){
        $id_user=SiteHelpers::get_user_id();
        $alternateData=DB::table('alternatives')
        ->where('user_id', $id_user)
        ->get();
        $relAlternatives=DB::table('rel_alternatives')
        ->where('nilai', '>', 0)
        ->where('user_id', $id_user)
        ->get();

        $kriterias=SiteHelpers::get_kriteria();
        $alternatives=SiteHelpers::get_alternative();
        // dd($alternatives);
        // dd($kriterias);
        $matriks=SiteHelpers::AHP_get_relkriteria();
        // dd($matriks);
        $totalKolom=SiteHelpers::AHP_get_total_kolom($matriks);
        // dd($totalKolom);
        $matriksNormal=SiteHelpers::AHP_normalize($matriks, $totalKolom);
        $rata=SiteHelpers::AHP_get_rata($matriksNormal);
        // dd($rata);
        // $cekMmult=SiteHelpers::AHP_mmult($matriks, $rata);
        // dd($cekMmult);
        // echo "oi#########";
        $constMeasure=SiteHelpers::AHP_consistency_measure($matriks, $rata);
        // dd($constMeasure);
        $nRI=SiteHelpers::AHP_get_nRI();
        $topsisHasilAnalisa=SiteHelpers::TOPSIS_hasil_analisa();
        $topsisNormal=SiteHelpers::TOPSIS_normalize(SiteHelpers::TOPSIS_get_hasil_analisa());
        $topsisNormalTerbobot=SiteHelpers::TOPSIS_normalize_terbobot($topsisNormal, $rata);
        $matriksIdeal=SiteHelpers::TOPSIS_solusi_ideal($topsisNormalTerbobot);
        $jarakSolusi=SiteHelpers::TOPSIS_jarak_solusi($topsisNormalTerbobot, $matriksIdeal);
        $nilaiPref=SiteHelpers::TOPSIS_preferensi($jarakSolusi);
        $altRank=SiteHelpers::get_rank($alternatives, $topsisNormal, $nilaiPref);

        return view('user.home', [
            'alternateData'=>$alternateData,
            'alternatives'=>$alternatives,
            'relAlternatives'=>$relAlternatives,
            'topsisNormal'=>$topsisNormal,
            'nilaiPref'=>$nilaiPref,
            'altRank'=>$altRank
        ]);
    }
    public function storeActivity(Request $request){
        $id_user=SiteHelpers::get_user_id();
        $data=$request->all();
        // dump($data);
        // insert into table alternatives
        $kode_alternative=$data['kodeTask'];
        $nama_alternative=$data['namaTask'];
        $keterangan=$data['taskDescription'];
        $queryInsertAlternatives=DB::table('alternatives')->insert([
            'kode_alternative'=>$kode_alternative,
            'nama_alternative'=>$nama_alternative,
            'keterangan'=>$keterangan,
            'status'=>'doing',
            'user_id'=>SiteHelpers::get_user_id(),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        // insert $data['taskDeadline], $data['besaranHonor'],
        // $data['tingkatKompetensi'], $data['reputasiKlien'], $data['kompleksitas'] into $new_kriterias
        $kriterias=DB::table('kriterias')->get();
        $newRelKriteriasAlternative=[];
        $datelineDays=Carbon::parse($data['taskDeadline'])->diffInDays(Carbon::now());
        if($datelineDays<=1){
            $datelineDays=1;
        }else if($datelineDays>1 && $datelineDays<=3){
            $datelineDays=2;
        }else if($datelineDays>3 && $datelineDays<=5){
            $datelineDays=3;
        }else if($datelineDays>5 && $datelineDays<=10){
            $datelineDays=4;
        }else if($datelineDays>10){
            $datelineDays=5;
        }

        $dataRelAlternatives=[
            $datelineDays,$data['besaranHonor'],
            $data['tingkatKompetensi'], $data['reputasiKlien'], $data['kompleksitas']
        ];
        //  key use $kriterias[key], but value use $dataRelAlternatives value
        foreach($kriterias as $key=>$value){
            $newRelKriteriasAlternative[$value->kode_kriteria]=$dataRelAlternatives[$key];
        }
        // dd($newRelKriteriasAlternative);

        if($queryInsertAlternatives){
            $queryInsertRelAlternatives=DB::insert("INSERT INTO rel_alternatives(kode_alternative, kode_kriteria, nilai, user_id, created_at, updated_at) SELECT '$kode_alternative', kode_kriteria, -1, $id_user, NOW(), NOW() FROM kriterias");
            if($queryInsertRelAlternatives){
                // get data rel_alternatives
                $queryGetRelAlternatives=DB::table('rel_alternatives')->where('kode_alternative',$kode_alternative)->get();
                // dd($queryGetRelAlternatives);
                // update rel_alternatives
                foreach($queryGetRelAlternatives as $key=>$value){
                    $queryUpdateRelAlternatives=DB::table('rel_alternatives')->where('id_rel_alternatives',$value->id_rel_alternatives)->update([
                        'nilai'=>$newRelKriteriasAlternative[$value->kode_kriteria]
                    ]);
                }
                return redirect()->route('user.home');
            }
        }else{
            return redirect()->route('user.home');
        }
    }
    public function deleteActivity($kode_alternative){

        DB::table('alternatives')->where('kode_alternative',$kode_alternative)->delete();
        DB::table('rel_alternatives')
            ->where('kode_alternative',$kode_alternative)
            ->delete();
        return redirect()->route('user.home');
    }
    public function editActivity($kode_alternative){
        $data=array();
        $alternatives = DB::table('alternatives')
            ->select('kode_alternative','nama_alternative','keterangan', 'tgl_duedate')
            ->where('kode_alternative',$kode_alternative)
            ->first();
        $rel_alternatives = DB::table('rel_alternatives')
            ->join('kriterias','kriterias.kode_kriteria','=','rel_alternatives.kode_kriteria')
            ->where('kode_alternative',$kode_alternative)
            ->get();
        foreach($rel_alternatives as $key=>$value){
            $data[$value->nama_kriteria]=$value->nilai;
        }
        // merge $alternatives and $data 
        $data=array_merge((array)$alternatives, $data);
        // remove space in array key data
        foreach($data as $key=>$value){
            $data[str_replace(' ','',$key)]=$value;
            if ($key != str_replace(' ','',$key)) {
                unset($data[$key]);
            }
        }
        
        return response()->json($data);
    }
    public function updateActivity(Request $request){
        $data=$request->all();
        // dd($data);
        $kode_alternative=$data['kodeTask'];
        $nama_alternative=$data['namaTask'];
        $keterangan=$data['taskDescription'];
        $queryUpdateAlternatives=DB::table('alternatives')->where('kode_alternative',$kode_alternative)->update([
            'nama_alternative'=>$nama_alternative,
            'keterangan'=>$keterangan,
            'tgl_duedate'=>$data['taskDeadline'],
            'updated_at'=>date('Y-m-d H:i:s')
        ]);

        // insert $data['taskDeadline], $data['besaranHonor'], $data['tingkatKompetensi'], $data['reputasiKlien'], $data['kompleksitas']
        $kriterias=DB::table('kriterias')->get();
        $newRelKriteriasAlternative=[];
        // dd($data['taskDeadline']);
        $datelineDays=Carbon::parse($data['taskDeadline'])->diffInDays(Carbon::now());
        // dd($datelineDays);
        if($datelineDays<=1){
            $datelineDays=1;
        }else if($datelineDays>1 && $datelineDays<=3){
            $datelineDays=2;
        }else if($datelineDays>3 && $datelineDays<=5){
            $datelineDays=3;
        }else if($datelineDays>5 && $datelineDays<=10){
            $datelineDays=4;
        }else if($datelineDays>10){
            $datelineDays=5;
        }

        $dataRelAlternatives=[
            $datelineDays,$data['besaranHonor'],
            $data['tingkatKompetensi'], $data['reputasiKlien'], $data['kompleksitas']
        ];
        //  key use $kriterias[key], but value use $dataRelAlternatives value
        foreach($kriterias as $key=>$value){
            $newRelKriteriasAlternative[$value->kode_kriteria]=$dataRelAlternatives[$key];
        }
        $queryGetRelAlternatives=DB::table('rel_alternatives')->where('kode_alternative',$kode_alternative)->get();
        foreach($queryGetRelAlternatives as $key=>$value){
            $queryUpdateRelAlternatives=DB::table('rel_alternatives')->where('id_rel_alternatives',$value->id_rel_alternatives)->update([
                'nilai'=>$newRelKriteriasAlternative[$value->kode_kriteria]
            ]);
        }

        return redirect()->route('user.home');
    }

}