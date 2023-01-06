@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Tambah Alternative</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('alternative/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_alternative">Kode Alternative</label>
                    <input type="text" name="kode_alternative" id="kode_alternative" class="form-control">
                    @error('kode_alternative')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_alternative">Nama Alternative</label>
                    <input type="text" name="nama_alternative" id="nama_alternative" class="form-control">
                    @error('nama_alternative')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- form atribut select box with option benefit / cost -->
                <div class="form-group">
                    <label for="atribut">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    @error('keterangan')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <!-- back button -->
                <a href="{{ route('admin.alternative') }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection