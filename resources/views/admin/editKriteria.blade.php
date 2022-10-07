@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Edit Kriteria</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <!-- loop collection and display to form edit -->
            @foreach($kriteria as $k)
            <form action="{{ route('kriteria/update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_kriteria">Kode Kriteria</label>
                    <input type="text" name="kode_kriteria" id="kode_kriteria" class="form-control" value="{{ $k->kode_kriteria }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" value="{{ $k->nama_kriteria }}">
                </div>
                <!-- form atribut select box with option benefit / cost -->
                <div class="form-group">
                    <label for="atribut">Atribut</label>
                    <select name="atribut" id="atribut" class="form-control">
                        <option value="cost" {{ $k->atribut == 'cost' ? 'selected' : '' }}>Cost</option>
                        <option value="benefit" {{ $k->atribut == 'benefit' ? 'selected' : '' }}>Benefit</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <!-- back button -->
                <a href="{{ route('admin.kriteria') }}" class="btn btn-default">Cancel</a>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection