@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Edit Rel Alternative</h1>
</div>
<div class="section-body">
    <h2 class="section-title">
        {{ $nama_alternative[0]->nama_alternative}}
    </h2>
    <div class="card">
        <div class="card-body">
        <form action="{{ route('admin.rel_alternative.update') }}" method="POST">
        @csrf
        @foreach ($rel_alternatives as $rel_alt)
            <div class="form-group">
                <label>{{ $rel_alt->nama_kriteria }}</label>
                <input class="form-control" type="text" name="id-{{ $rel_alt->id_rel_alternatives }}" value="{{ $rel_alt->nilai }}">
            </div>
        @endforeach
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.rel_alternative') }}" class="btn btn-link"> Kembali</a>
        </div>
    </div>
</div>
@endsection
