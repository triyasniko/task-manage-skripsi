@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kriteria/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_kriteria">Kode Kriteria</label>
                    <input type="text" name="kode_kriteria" id="kode_kriteria" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control">
                </div>
                <!-- form atribut select box with option benefit / cost -->
                <div class="form-group">
                    <label for="atribut">Atribut</label>
                    <select name="atribut" id="atribut" class="form-control">
                        <option value="cost">Cost</option>
                        <option value="benefit">Benefit</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <!-- back button -->
                <a href="{{ route('admin.kriteria') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection