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
                        $data=SiteHelpers::TOPSIS_get_hasil_analisa();
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
                    <?php
                        foreach($alternatives as $row):?>
                        <tr>
                            <td><?=$row->kode_alternative?></td>
                            <td><?=$row->nama_alternative?></td>
                            <?php foreach($data[$row->kode_alternative] as $key => $val):?>
                            <td><?=$val?></td>
                            <?php endforeach?>
                            <td>
                                <a href="{{ route('admin.rel_alternative_edit', ['kode_alternative' => $row->kode_alternative]) }}" 
                                class="btn btn-xs btn-outline-secondary text-warning">Ubah</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection