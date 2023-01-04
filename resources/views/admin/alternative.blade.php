@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Alternative</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('alternative/add') }}" class="btn btn-primary mb-3">Tambah Alternative</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="table-1">
                    <thead>
                        <tr>
                            <th>Kode Alternative</th>
                            <th>Nama Kriteria</th>
                            <th>Keterangan</th>
                            <th>Action</th>
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