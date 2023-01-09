@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Nilai Bobot Kriteria</h1>
</div>

@php
    $criterias=array();
    $data=array();
    foreach($rel_kriterias as $rel_kriteria){
        $criterias[$rel_kriteria->id1]=$rel_kriteria->nama_kriteria;
        $data[$rel_kriteria->id1][$rel_kriteria->id2]=$rel_kriteria->nilai;
    }
@endphp

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <!-- display alert message -->
            @if (session('alert_message_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ session('alert_message_error') }}
                </div>
            </div>
            @endif
            @if (session('alert_message_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('alert_message_success') }}
                </div>
            </div>
            @endif
            <form action="{{ route('admin.rel_kriteria.update') }}" class="form-inline" method="post">
            @csrf    
            <div class="form-group mx-1">
                    <select class="form-control" name="id1">
                        @foreach($kriteria_option as $krt_opt)
                        <option value="{{ $krt_opt->kode_kriteria }}">{{ $krt_opt->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- loop ahp nilai option -->
                <div class="form-group mx-1">
                    <select class="form-control" name="nilai">
                        @foreach($ahp_nilai_option as $key=>$value)
                        <option value="{{ $key }}">{{ $key." - ".$value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mx-1">
                    <select class="form-control" name="id2">
                        @foreach($kriteria_option as $krt_opt)
                        <option value="{{ $krt_opt->kode_kriteria }}">{{ $krt_opt->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mx-1">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg">Ubah</button>
                </div>
            </form>
            <!-- table nilai bobot -->
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-hover table-striped font-weight-bold">
                <!-- <thead> -->
                    <tr>
                        <th>Kode</th>
                        <?php 
                        foreach($data as $key=>$value){
                            echo "<th>$key</th>";
                        }         
                        ?>
                    </tr>
                <!-- </thead> -->
                <!-- <tbody> -->
                    <?php
                        $no=1;
                        $a=1;
                        foreach($data as $key => $value):?>
                    <tr>
                        <th><?=$key?></th>
                        <?php  
                            $b=1;
                            foreach($value as $k => $dt){ 
                                if( $key == $k ) 
                                    $class = 'bg-success';
                                elseif($b > $a)
                                    $class = 'bg-danger';
                                else
                                    $class = '';
                                    
                                echo "<td class='$class'>".round($dt, 3)."</td>";   
                                $b++;            
                            } 
                            $no++;       
                        ?>
                    </tr>
                    <?php $a++; endforeach;?>
                <!-- </tbody> -->
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
