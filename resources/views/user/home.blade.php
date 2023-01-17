@extends('layouts.master')
@section('content')
<div class="section-header">
    <h1>TASKIFY</h1>
</div>
<div class="section-body">
    <span class="section-title"></span>
    <p class="section-lead">Tuliskan rencana kegiatanmu untuk mengetahui tugas yang paling penting dan mendesak sehingga
    kamu bisa bekerja lebih cepat dan efisien.</p>

    <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#addModalTask">
        Add Task
        <i class="fas fa-plus"></i>
    </button>

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="your-TaskList" data-toggle="tab" href="#yourTaskList" role="tab" aria-controls="yourTaskList" aria-selected="true">Your Task List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="for-YourRecommendation" data-toggle="tab" href="#forYourRecommendation" role="tab" aria-controls="profile" aria-selected="false">Recommendation For You</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade show active" id="yourTaskList" role="tabpanel" aria-labelledby="your-TaskList">
                    
                    @foreach($alternateData as $alterData)
                        <div class="card border my-1">
                            <div class="card-body py-1 d-flex align-items-center justify-content-between">
                                <div>
                                <p class="text-primary font-weight-bold my-0">
                                {{ $alterData->nama_alternative }}
                                </p>
                                
                                <p class="my-0">
                                <i class="far fa-calendar"></i>
                                {{ $alterData->tgl_duedate }}
                                </p>
                                </div>
                                <div class="ml-auto">
                                    <a href="#" class="btn btn-link editModalTask" data-toggle="modal" data-target="#editModalTask" data-kode_alternative="{{ $alterData->kode_alternative }}"
                                    data-nama_alternative="{{ $alterData->nama_alternative }}" data-keterangan="{{ $alterData->keterangan }}" data-taskDeadline="{{ $alterData->tgl_duedate }}" 
                                    >
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{ route('user.activity/delete', [$alterData->kode_alternative]) }}" class="btn btn-link">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="forYourRecommendation" role="tabpanel" aria-labelledby="for-YourRecommendation">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table-1">
                            @foreach($topsisNormal as $key=>$value)
                            <tr>
                                <div class="card border my-1">
                                <div class="card-body py-1 d-flex align-items-center justify-content-between">
                                    <div class="text-primary font-weight-bold">
                                        {{ $key }} - {{ $alternatives[$key] }}
                                    </div>
                                    <div>    
                                        <span class="badge badge-light">
                                            <span class="font-weight-bold text-dark">
                                            {{ $altRank[$key] }}
                                            </span>
                                            (
                                            {{ round($nilaiPref[$key], 3) }}
                                            )
                                        </span>
                                    </div>
                                </div>
                                </div>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


</div>
@endsection
<!-- addTaskModal -->
<div class="modal fade" id="addModalTask" tabindex="2" role="dialog" aria-labelledby="addModalTaskLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTaskLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.activity/store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kodeTask">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="namaTask">Nama Task</label>
                            <input type="text" class="form-control" id="namaTask" name="namaTask">
                        </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                            <!-- <div class="col-sm-6"> -->
                                <label for="taskDeadline">Deadline</label>
                                <input type="date" class="form-control" id="taskDeadline" name="taskDeadline">
                            <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Task Description</label>
                        <textarea class="form-control" id="taskDescription" name="taskDescription" rows="5"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Besaran Honor</label>
                        <select class="form-control" name="besaranHonor">
                            <option value="5">>5 Juta</option>
                            <option value="4">3-5 Juta</option>
                            <option value="3">1-3 Juta</option>
                            <option value="2"><1 Juta</option>
                            <option value="1">Tanpa Honor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tingkat Kompetensi</label>
                        <select class="form-control" name="tingkatKompetensi">
                            <option value="5">Sangat Baik</option>
                            <option value="4">Baik</option>
                            <option value="3">Cukup</option>
                            <option value="2">Kurang</option>
                            <option value="1">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Reputasi Klien</label>
                        <select class="form-control" name="reputasiKlien">
                            <option value="5">Sangat Baik</option>
                            <option value="4">Baik</option>
                            <option value="3">Cukup</option>
                            <option value="2">Kurang</option>
                            <option value="1">Baru</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kompleksitas</label>
                        <select class="form-control" name="kompleksitas">
                            <option value="1">Mudah</option>
                            <option value="2">Sedang</option>
                            <option value="3">Sulit</option>
                            <option value="4">Sangat Sulit</option>
                            <option value="5">Ekstrem</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <!-- dateline input with icon time -->
                        <input type="submit" class="btn btn-primary">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- editTaskModal -->
<div class="modal fade" id="editModalTask" tabindex="2" role="dialog" aria-labelledby="editModalTaskLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTaskLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.activity/update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kodeTask" id="kodeTask" readonly>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="namaTask">Nama Task</label>
                            <input type="text" class="form-control" id="namaTask" name="namaTask">
                        </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                            <!-- <div class="col-sm-6"> -->
                                <label for="taskDeadline">Deadline</label>
                                <input type="date" class="form-control" id="taskDeadline" name="taskDeadline">
                            <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Task Description</label>
                        <textarea class="form-control" id="taskDescription" name="taskDescription" rows="5"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Besaran Honor</label>
                        <select class="form-control" name="besaranHonor" id="besaranHonor">
                            <option value="5">>5 Juta</option>
                            <option value="4">3-5 Juta</option>
                            <option value="3">1-3 Juta</option>
                            <option value="2"><1 Juta</option>
                            <option value="1">Tanpa Honor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tingkat Kompetensi</label>
                        <select class="form-control" name="tingkatKompetensi" id="tingkatKompetensi">
                            <option value="5">Sangat Baik</option>
                            <option value="4">Baik</option>
                            <option value="3">Cukup</option>
                            <option value="2">Kurang</option>
                            <option value="1">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Reputasi Klien</label>
                        <select class="form-control" name="reputasiKlien" id="reputasiKlien">
                            <option value="5">Sangat Baik</option>
                            <option value="4">Baik</option>
                            <option value="3">Cukup</option>
                            <option value="2">Kurang</option>
                            <option value="1">Baru</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kompleksitas</label>
                        <select class="form-control" name="kompleksitas" id="kompleksitas">
                            <option value="1">Mudah</option>
                            <option value="2">Sedang</option>
                            <option value="3">Sulit</option>
                            <option value="4">Sangat Sulit</option>
                            <option value="5">Ekstrem</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <!-- dateline input with icon time -->
                        <input type="submit" class="btn btn-primary">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
     $('body').on('click', '.editModalTask', function () {
        var kode_alternative= $(this).data('kode_alternative');
        // console.log(kode_alternative);
        $.ajax({
            type: "GET",
            url: "/user/activity/edit/"+kode_alternative,
            success: function (data) {
                // console.log(data);
                $('#editModalTask').modal('show');
                $('#editModalTask').find('#kodeTask').val(data.kode_alternative);
                $('#editModalTask').find('#namaTask').val(data.nama_alternative);
                $('#editModalTask').find('#taskDeadline').val(data.tgl_duedate);
                $('#editModalTask').find('#taskDescription').val(data.keterangan);
                $('#editModalTask').find('#besaranHonor').val(data.BESARHONOR);
                $('#editModalTask').find('#tingkatKompetensi').val(data.TINGKATKOMPETENSI);
                $('#editModalTask').find('#reputasiKlien').val(data.REPUTASIKLIEN);
                $('#editModalTask').find('#kompleksitas').val(data.KOMPLEKSITAS);
            }
        });

     });

</script>