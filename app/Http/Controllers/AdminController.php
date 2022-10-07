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
        DB::table('Kriterias')->insert([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut
        ]);
        return redirect('/kriteria');
    }
    public function editKriteria($kode_kriteria){
        $kriteria = DB::table('Kriterias')->where('kode_kriteria',$kode_kriteria)->get();
        return view('admin.editKriteria', ['kriteria' => $kriteria]);
    }
    public function updateKriteria(Request $request){
        DB::table('Kriterias')->where('kode_kriteria',$request->kode_kriteria)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut
        ]);
        return redirect('/kriteria');
    }
    public function deleteKriteria($kode_kriteria){
        DB::table('Kriterias')->where('kode_kriteria',$kode_kriteria)->delete();
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
        $nilai_bobot_kriteria = DB::table('nilaibobotkriterias')
            ->join('kriterias', 'nilaibobotkriterias.kode_kriteria1', '=', 'kriterias.kode_kriteria')
            ->select('nilaibobotkriterias.*', 'kriterias.nama_kriteria as nama_kriteria_1')
            ->orderBy('nilaibobotkriterias.kode_kriteria1', 'asc')
            ->orderBy('nilaibobotkriterias.kode_kriteria2', 'asc')
            ->get();

        return view ('admin.nilaiBobotKriteria', 
            ['kriteria_option' => $kriteria_option, 
            'ahp_nilai_option' => $ahp_nilai_option,
            'nilaiBobotKriteria' => $nilaiBobotKriteria
        ]);
    }
}
