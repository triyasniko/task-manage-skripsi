@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Nilai Bobot Alternative</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-1">
                    <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Alternatif</th>
                        <?php
                        // dd($heads[0]->count);
                        $heads=$heads[0]->count;
                        if($heads>0):
                            for($a = 1; $a<=$heads; $a++){
                                echo "<th>C$a</th>";
                            }
                        endif;  
                        ?>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection