@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Kriteria</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('kriteria/add') }}" class="btn btn-primary mb-3">Tambah Kriteria</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="table-1">
                    <thead>
                        <tr>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Atribut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriteria as $k)
                        <tr>
                            <td>{{ $k->kode_kriteria }}</td>
                            <td>{{ $k->nama_kriteria }}</td>
                            <td>{{ $k->atribut }}</td>
                            <td>
                                <a href="{{ route('kriteria/edit',[$k->kode_kriteria]) }}" class="btn btn-outline-warning">Edit</a>
                                <a href="{{ route('kriteria/delete',[$k->kode_kriteria]) }}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection