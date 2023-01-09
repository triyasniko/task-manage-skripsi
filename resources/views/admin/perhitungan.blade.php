@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>Perhitungan</h1>
</div>
@if(count($alternatives) == 0 || count($kriterias) == 0)
    <div class="alert alert-danger">
        <h5>Peringatan!</h5>
        <p>Anda harus menambahkan data kriteria dan alternative terlebih dahulu.</p>
    </div>
@elseif(count($rel_alternatives) == 0)
    <div class="alert alert-danger">
        <h5>Peringatan!</h5>
        <p>Anda harus mengatur nilai alternative terlebih dahulu.</p>
@else 

<div class="section-body">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Mengukur Konsistensi Kriteria (AHP)</h4>
            <div class="card-header-action">
                <a data-collapse="#MengukurKonsistensiKriteriaAHP" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="collapse" id="MengukurKonsistensiKriteriaAHP">
            <div class="card-body">
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Matriks Perbandingan Kriteria</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#MatriksPerbandinganKriteria" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="MatriksPerbandinganKriteria">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($matriks as $key => $value)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                        <tr>
                                </thead>
                                @foreach($matriks as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        @foreach($value as $k => $v)
                                            <td>{{ round($v, 3) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        @foreach($totalKolom as $key => $value)
                                            <td class="text-primary">{{ round($totalKolom[$key], 3) }}</td>
                                        @endforeach
                                    </tr>
                                </tfoot>

                                </table>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Matriks Bobot Prioritas Kriteria</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#MatriksBobotPrioritasKriteria" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="MatriksBobotPrioritasKriteria">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach($matriksNormal as $key => $value)
                                            <th>{{ $key }}</th>
                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                        <th>Bobot Prioritas</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($matriksNormal as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        @foreach($value as $k => $v)
                                            <td>{{ round($v, 3) }}</td>
                                        @endforeach
                                        <td class="text-primary">{{ round($rata[$key], 3) }}</td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                                </tr>

                                </table>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Matriks Konsistensi Kriteria</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#MatriksKonsistensiKriteria" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="MatriksKonsistensiKriteria">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach($matriksNormal as $key => $value)
                                            <th>{{ $key }}</th>
                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                        <th>Bobot</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($matriksNormal as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        @foreach($value as $k => $v)
                                            <td>{{ round($v, 3) }}</td>
                                        @endforeach
                                        <td class="text-primary">{{ round($constMeasure[$key], 3) }}</td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                                </tr>
                                </table>
                            </div>    
                            <p>Tabel Ratio Index Berdasarkan Ordo Matriks.</p>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped table-hover">
                                    <tr>
                                    <th>Ordo matriks</th>
                                    @foreach($nRI as $key => $value)
                                        @if(count($matriks)==$key)
                                            <td class="font-weight-bold text-primary bg-light text-center">{{ $key }}</td>
                                        @else
                                            <td>{{ $key }}</td>
                                        @endif
                                    @endforeach
                                    </tr>
                                    <tr>
                                    <th>Ratio index</th>
                                    @foreach($nRI as $key => $value)
                                        @if(count($matriks)==$key)
                                            <td class="font-weight-bold text-primary bg-light text-center">{{ $value }}</td>
                                        @else
                                            <td>{{ $value }}</td>
                                        @endif
                                    @endforeach
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-2">
                    @php
                        $CI = ((array_sum($constMeasure)/count($constMeasure))-count($constMeasure))/(count($constMeasure)-1);
                        $RI = $nRI[count($matriks)];
                        $CR = $CI/$RI;
                        @endphp

                        <p>Consistency Index: {{ round($CI, 3) }}<br />
                            Ratio Index: {{ round($RI, 3) }}<br />
                            Consistency Ratio: {{ round($CR, 3) }}
                            @if($CR>0.10)
                                (Tidak konsisten)<br />
                            @else
                                (Konsisten)<br />
                            @endif
                        </p>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    
    <div class="card card-primary">
        <div class="card-header">
            <h4>Perhitungan TOPSIS</h4>
            <div class="card-header-action">
                <a data-collapse="#PerhitunganTOPSIS" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="collapse" id="PerhitunganTOPSIS">
            <div class="card-body">
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Hasil Analisa</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#HasilAnalisa" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="HasilAnalisa">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <th></th>
                                        @foreach($topsisHasilAnalisa[key($topsisHasilAnalisa)] as $key => $value)
                                            <th>{{ $kriterias[$key]['nama_kriteria'] }}</th>
                                        @endforeach
                                    </tr>

                                    @foreach($topsisHasilAnalisa as $key => $value)
                                        <tr>
                                            <th nowrap>{{ $alternatives[$key] }}</th>
                                            @foreach($value as $k => $v)
                                                <td>{{ $v }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Normalisasi</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#Normalisasi" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="Normalisasi">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th></th>
                                    @foreach($topsisNormal[key($topsisNormal)] as $key => $value)
                                        <th>{{ $key }}</th>
                                    @endforeach
                                </tr>

                                @foreach($topsisNormal as $key => $value)
                                    <tr>
                                        <th>A{{ $no }}</th>
                                        @foreach($value as $k => $v)
                                            <td>{{ round($v, 5) }}</td>
                                        @endforeach
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Normalisasi Terbobot</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#NormalisasiTerbobot" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="NormalisasiTerbobot">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th></th>
                                    @foreach($topsisNormalTerbobot[key($topsisNormalTerbobot)] as $key => $value)
                                        <th>{{ $key }}</th>
                                    @endforeach
                                </tr>

                                @foreach($topsisNormalTerbobot as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        @foreach($value as $k => $v)
                                            <td>{{ round($v, 5) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Matriks Solusi Ideal</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#MatriksSolusiIdeal" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="MatriksSolusiIdeal">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th></th>
                                    @foreach($matriksIdeal[key($matriksIdeal)] as $key => $value)
                                        <th>{{ $key }}</th>
                                    @endforeach
                                </tr>

                                @foreach($matriksIdeal as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        @foreach($value as $k => $v)
                                            <td>{{ round($v, 5) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Jarak Solusi & Nilai Preferensi</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#JarakSolusiAndNilaiPreferensi" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="JarakSolusiAndNilaiPreferensi">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <th></th>
                                        <th>Positif</th>
                                        <th>Negatif</th>
                                        <th>Preferensi</th>
                                    </tr>
                                @foreach($topsisNormal as $key => $value)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        <td>{{ round($jarakSolusi[$key]['positif'], 5) }}</td>
                                        <td>{{ round($jarakSolusi[$key]['negatif'], 5) }}</td>
                                        <td>{{ round($nilaiPref[$key], 5) }}</td>
                                    </tr>
                                @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-secondary">
                    <div class="card-header">
                        <h4 class="font-weight-normal text-dark">Perangkingan</h4>
                        <div class="card-header-action">
                            <a href="#" data-collapse="#Perangkingan" class="btn btn-icon btn-outline-secondary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse" id="Perangkingan">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th>Rank</th>
                                    </tr>
                                    @foreach($topsisNormal as $key=>$value)
                                    <tr>
                                        <th>{{ $key }} - {{ $alternatives[$key] }}</th>
                                        <td class="text-primary">{{ round($nilaiPref[$key], 3) }}</td>
                                        <td class="text-primary">{{ $altRank[$key] }}</td>
                                    </tr>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>                        
</div>     
@endif
@endsection