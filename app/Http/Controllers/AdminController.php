<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SiteHelpers;


class AdminController extends Controller
{
    public function index(){
        return view ('admin.index');
    }
    public function kriteria(){
        $kriteria = DB::table('kriterias')->get();
        return view ('admin.kriteria', ['kriteria' => $kriteria]);
    }
    public function addKriteria(){
        return view ('admin.addKriteria');
    }
    public function storeKriteria(Request $request){
        $kode_kriteria=$request->kode_kriteria;
        $nama_kriteria=$request->nama_kriteria;
        $atribut=$request->atribut;

        $this->validate($request,[
            'kode_kriteria' => 'required|unique:kriterias',
            'nama_kriteria' => 'required',
            'atribut' => 'required'
        ]);

        DB::table('kriterias')->insert([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::insert("INSERT INTO rel_kriterias(id1, id2, nilai, created_at, updated_at) SELECT '$kode_kriteria', kode_kriteria, 1, NOW(), NOW() FROM kriterias");
        DB::insert("INSERT INTO rel_kriterias(id1, id2, nilai, created_at, updated_at) SELECT kode_kriteria, '$kode_kriteria', 1, NOW(), NOW() FROM kriterias WHERE kode_kriteria<>'$kode_kriteria'");
        DB::insert("INSERT INTO rel_alternatives(kode_alternative, kode_kriteria, nilai, created_at, updated_at) SELECT kode_alternative, '$kode_kriteria', -1, NOW(), NOW()  FROM alternatives");

        return redirect('/kriteria');

    }
    public function editKriteria($kode_kriteria){
        $kriteria = DB::table('kriterias')->where('kode_kriteria',$kode_kriteria)->get();
        return view('admin.editKriteria', ['kriteria' => $kriteria]);
    }
    public function updateKriteria(Request $request){
        $this->validate($request,[
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'atribut' => 'required'
        ]);
        DB::table('kriterias')->where('kode_kriteria',$request->kode_kriteria)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut
        ]);
        return redirect('/kriteria');
    }
    public function deleteKriteria($kode_kriteria){
        DB::table('kriterias')->where('kode_kriteria',$kode_kriteria)->delete();
        DB::table('rel_kriterias')
            ->where('id1',$kode_kriteria)
            ->orWhere('id2',$kode_kriteria)
            ->delete();
        DB::table('rel_alternatives')
            ->where('kode_kriteria',$kode_kriteria)
            ->delete();
        return redirect('/kriteria');
    }
    public function relKriteria(){
        $kriteria_option = DB::table('kriterias')->get();
        $ahp_nilai_option = array(
            '1' => 'Sama penting dengan',
            '2' => 'Mendekati sedikit lebih penting dari',
            '3' => 'Sedikit lebih penting dari',
            '4' => 'Mendekati lebih penting dari',
            '5' => 'Lebih penting dari',
            '6' => 'Mendekati sangat penting dari',
            '7' => 'Sangat penting dari',
            '8' => 'Mendekati mutlak dari',
            '9' => 'Mutlak sangat penting dari',
        );
        // nilaibobotkriteria join kriteria order by kode_kriteria
        $rel_kriterias = DB::table('rel_kriterias')
            ->join('kriterias', 'rel_kriterias.id1', '=', 'kriterias.kode_kriteria')
            ->select('rel_kriterias.*', 'kriterias.nama_kriteria')
            ->orderBy('rel_kriterias.id1', 'asc')
            ->orderBy('rel_kriterias.id2', 'asc')
            ->get();
        
        // dd($rel_kriterias);
        // exit();

        // $criterias=array();
        // $data=array();

        // exit();

        return view ('admin.relKriteria', 
            ['kriteria_option' => $kriteria_option, 
            'ahp_nilai_option' => $ahp_nilai_option,
            'rel_kriterias' => $rel_kriterias
        ]);
    }
    public function updateRelKriteria(Request $request){
        $id1=$request->id1;
        $id2=$request->id2;
        $nilai=abs($request->nilai);
        // dd($nilai==1);
        // $this->validate($request,[
        //     'id1' => 'required',
        //     'id2' => 'required',
        //     'nilai' => 'required'
        // ]);
        // if condition if id1=id2 and nilai!=1
        // $id1=001;
        // $id2=001;
        // $nilai=2;
        if($id1==$id2 AND $nilai!=1){
            // dd("sama");
            $request->session()->flash('alert_message_error', 'Nilai harus 1 jika kriteria sama');
            return redirect('/kriteria/rel_kriteria');
        }else{
            DB::table('rel_kriterias')
            ->where('id1',$id1)
            ->where('id2',$id2)
            ->update([
                'nilai' => $nilai
            ]);
            DB::table('rel_kriterias')
                ->where('id1',$id2)
                ->where('id2',$id1)
                ->update([
                    'nilai' => 1/$nilai
            ]);
            $request->session()->flash('alert_message_success', 'Data berhasil diupdate');
            return redirect('/kriteria/rel_kriteria');
        }
        
    }
    public function alternative(){
        $alternatives = DB::table('alternatives')->get();
        return view ('admin.alternative', ['alternatives' => $alternatives]);
    }
    public function addAlternative(){
        return view ('admin.addAlternative');
    }
    public function storeAlternative(Request $request){
        $kode_alternative=$request->kode_alternative;
        $nama_alternative=$request->nama_alternative;
        $keterangan=$request->keterangan;
        $this->validate($request,[
            'kode_alternative' => 'required|unique:alternatives',
            'nama_alternative' => 'required',
            'keterangan' => 'required'
        ]);
        DB::table('alternatives')->insert([
            'kode_alternative' => $request->kode_alternative,
            'nama_alternative' => $request->nama_alternative,
            'keterangan' => $request->keterangan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::insert("INSERT INTO rel_alternatives(kode_alternative, kode_kriteria, nilai, created_at, updated_at) SELECT '$kode_alternative', kode_kriteria, -1, NOW(), NOW() FROM kriterias");
        return redirect('/alternative');
    }
    public function editAlternative($kode_alternative){
        $alternative = DB::table('alternatives')->where('kode_alternative',$kode_alternative)->get();
        return view('admin.editAlternative', ['alternative' => $alternative]);
    }
    public function updateAlternative(Request $request){
        $this->validate($request,[
            'kode_alternative' => 'required',
            'nama_alternative' => 'required',
            'keterangan' => 'required'
        ]);
        DB::table('alternatives')->where('kode_alternative',$request->kode_alternative)->update([
            'nama_alternative' => $request->nama_alternative,
            'keterangan' => $request->keterangan
        ]);
        return redirect('/alternative');
    }
    public function deleteAlternative($kode_alternative){
        DB::table('alternatives')->where('kode_alternative',$kode_alternative)->delete();
        DB::table('rel_alternatives')
            ->where('kode_alternative',$kode_alternative)
            ->delete();
        return redirect('/alternative');
    }
    public function relAlternative(){
        $heads=DB::table('kriterias')
                ->selectRaw('Count(*) as count')
                ->get();
        $alternatives=DB::table('alternatives')
                ->get();
        
        $data=SiteHelpers::TOPSIS_get_hasil_analisa();
        return view ('admin.relAlternative', [
            'heads' => $heads, 
            'alternatives' => $alternatives,
            'data' => $data
        ]);
    }
    public function editRelAlternative($kode_alternative){
        $nama_alternative=DB::table('alternatives')
            ->select('nama_alternative')
            ->where('kode_alternative', '=', $kode_alternative)
            ->get();
        $rel_alternatives = 
             DB::table('rel_alternatives as ra')
            ->join('kriterias as k', 'k.kode_kriteria', '=', 'ra.kode_kriteria')
            ->select('ra.id_rel_alternatives', 'k.kode_kriteria', 'k.nama_kriteria', 'ra.nilai')
            ->where('kode_alternative', '=', $kode_alternative)
            ->orderBy('kode_kriteria')
            ->get();

        // dd($alternative);
        return view('admin.editRelAlternative', ['rel_alternatives' => $rel_alternatives, 'nama_alternative' => $nama_alternative]);
    }

    public function updateRelAlternative(Request $request){
        // dd($request->all());
        $rel_alternatives=$request->all();
        $new_rel_alternatives = [];
        foreach ($rel_alternatives as $key => $value) {
            if (strpos($key, 'id-') === 0) {
                $id = str_replace('id-', '', $key);
                $new_rel_alternatives[$id] = $value;
            }
        }

        foreach ($new_rel_alternatives as $id => $value) {
            DB::table('rel_alternatives')
                ->where('id_rel_alternatives', '=', $id)
                ->update(['nilai' => $value]);
        }

        return redirect(route("admin.rel_alternative"));
    }

    public function perhitungan(){
        $rel_alternatives=DB::table('rel_alternatives')
                          ->where('nilai', '>', 0)
                          ->get();
        // dd($rel_alternatives);
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
        // dd($altRank);

        return view ('admin.perhitungan', [
            'rel_alternatives' => $rel_alternatives, 
            'kriterias' => $kriterias,
            'alternatives' => $alternatives,
            'matriks' => $matriks,
            'totalKolom' => $totalKolom,
            'matriksNormal' => $matriksNormal,
            'rata' => $rata,
            'constMeasure' => $constMeasure,
            'nRI' => $nRI,
            'topsisHasilAnalisa' => $topsisHasilAnalisa,
            'topsisNormal' => $topsisNormal,
            'topsisNormalTerbobot' => $topsisNormalTerbobot,
            'matriksIdeal' => $matriksIdeal,
            'jarakSolusi' => $jarakSolusi,
            'nilaiPref' => $nilaiPref,
            'altRank' => $altRank
        ]);
    }

}
