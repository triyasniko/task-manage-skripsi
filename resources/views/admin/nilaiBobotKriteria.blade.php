@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Nilai Bobot Kriteria</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="" class="form-inline">
                <div class="form-group">
                    <select class="form-control">
                        @foreach($kriteria_option as $krt_opt)
                        <option value="{{$krt_opt->kode_kriteria}}">{{$krt_opt->nama_kriteria}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- loop ahp nilai option -->
                <div class="form-group">
                    <select class="form-control">
                        @foreach($ahp_nilai_option as $ahp_nilai_opt)
                        <option value="{{$ahp_nilai_opt}}">{{$ahp_nilai_opt}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control">
                        @foreach($kriteria_option as $krt_opt)
                        <option value="{{$krt_opt->kode_kriteria}}">{{$krt_opt->nama_kriteria}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg">Ubah</button>
                </div>
            </form>
            <!-- table nilai bobot -->
            
        </div>
    </div>
</div>
@endsection