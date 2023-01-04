<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view ('admin.index');
    }
    public function kriteria(){
        $kriteria = DB::table('Kriterias')->get();
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
            'kode_kriteria' => 'required|unique:Kriterias',
            'nama_kriteria' => 'required',
            'atribut' => 'required'
        ]);

        DB::table('Kriterias')->insert([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('Rel_Kriterias')->insert([
            ['id1'=>$kode_kriteria, 
            'id2'=>$kode_kriteria, 
            'nilai'=>1, 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')]
        ]);
        DB::insert("INSERT INTO Rel_Kriterias(id1, id2, nilai, created_at, updated_at) SELECT kode_kriteria, '$kode_kriteria', 1, NOW(), NOW() FROM Kriterias WHERE kode_kriteria<>'$kode_kriteria'");
        DB::insert("INSERT INTO Rel_Alternatives(kode_alternative, kode_kriteria, nilai, created_at, updated_at) SELECT kode_alternative, '$kode_kriteria', -1, NOW(), NOW()  FROM Alternatives");

        return redirect('/kriteria');

    }
    public function editKriteria($kode_kriteria){
        $kriteria = DB::table('Kriterias')->where('kode_kriteria',$kode_kriteria)->get();
        return view('admin.editKriteria', ['kriteria' => $kriteria]);
    }
    public function updateKriteria(Request $request){
        $this->validate($request,[
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'atribut' => 'required'
        ]);
        DB::table('Kriterias')->where('kode_kriteria',$request->kode_kriteria)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut
        ]);
        return redirect('/kriteria');
    }
    public function deleteKriteria($kode_kriteria){
        DB::table('Kriterias')->where('kode_kriteria',$kode_kriteria)->delete();
        DB::table('Rel_Kriterias')
            ->where('id1',$kode_kriteria)
            ->orWhere('id2',$kode_kriteria)
            ->delete();
        DB::table('Rel_Alternatives')
            ->where('kode_kriteria',$kode_kriteria)
            ->delete();
        return redirect('/kriteria');
    }
    public function nilaiBobotKriteria(){
        $kriteria_option = DB::table('Kriterias')->get();
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
        $nilai_bobot_kriteria = DB::table('Rel_Kriterias')
            ->join('kriterias', 'Rel_Kriterias.id1', '=', 'kriterias.kode_kriteria')
            ->select('Rel_Kriterias.*', 'kriterias.nama_kriteria as nama_kriteria_1')
            ->orderBy('Rel_Kriterias.id1', 'asc')
            ->orderBy('Rel_Kriterias.id2', 'asc')
            ->get();
        
        // var_dump($nilai_bobot_kriteria);
        // exit();

        $criterias=array();
        $data=array();
        foreach($nilai_bobot_kriteria as $n){
            $criterias[$n->id1]=$n->nama_kriteria_1;
            $data[$n->id1][$n->id2]=$n->nilai;
        }

        // var_dump($data);
        // exit();

        return view ('admin.nilaiBobotKriteria', 
            ['kriteria_option' => $kriteria_option, 
            'ahp_nilai_option' => $ahp_nilai_option,
            'data'=>$data,
        ]);
    }
    public function alternative(){
        $alternative = DB::table('Alternatives')->get();
        return view ('admin.alternative', ['alternative' => $alternative]);
    }
    public function addAlternative(){
        return view ('admin.addAlternative');
    }
}
