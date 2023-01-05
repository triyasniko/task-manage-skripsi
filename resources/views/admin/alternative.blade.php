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
                            <th>Nama Alternative</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatives as $alternative)
                        <tr>
                            <td>{{ $alternative->kode_alternative }}</td>
                            <td>{{ $alternative->nama_alternative }}</td>
                            <td>{{ $alternative->keterangan }}</td>
                            <td>
                                <a href="{{ route('alternative/edit', $alternative->kode_alternative) }}" class="btn btn-outline-secondary text-warning">Edit</a>
                                <a href="{{ route('alternative/delete', $alternative->kode_alternative) }}" class="btn btn-outline-secondary text-danger">Delete</a>
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