@extends("/admin/layouts/app")

@section('title',"Data Kuesioner")

@section('content')

<div class="card">
    <div class="card-header">
        Data Kuesioner {{ $data->judul_acara }}
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pilihanGanda" > <i class="fa fa-plus mr-1" ></i> Tambah Soal Pilihan Ganda</button>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#checkbox" ><i class="fa fa-plus mr-1" ></i> Tambah Soal checkbox</button>
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#essai" ><i class="fa fa-plus mr-1" ></i> Tambah Soal Essai</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pilihanGanda" tabindex="-1" aria-labelledby="pilihanGandaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pilihanGandaLabel">Tambah Data Kuesioner Pilihan Ganda</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/admin/master/acara/kuesioner/add/pg/{{ $data->id }}" method="post">
            
           @csrf
            <div class="form-group">
                <label for="soal">Soal</label>
                <input type="text" required class="form-control" id="soal" name="soal"  >
            </div>
            <ul>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
            </ul>
            

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="checkbox" tabindex="-1" aria-labelledby="checkboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="checkboxLabel">Tambah Data Kuesioner checkbox</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/admin/master/acara/kuesioner/add/cb/{{ $data->id }}" method="post">
            
           @csrf
            <div class="form-group">
                <label for="soal">Soal</label>
                <input type="text" required class="form-control" id="soal" name="soal"  >
            </div>
            <ul>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pilihan" name="pilihan[]" >
                        </div>
                    </div>
                </li>
            </ul>
            

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal -->
<div class="modal fade" id="essai" tabindex="-1" aria-labelledby="essaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="essaiLabel">Tambah Data Kuesioner essai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/admin/master/acara/kuesioner/add/essai/{{ $data->id }}" method="post">
            
           @csrf
            <div class="form-group">
                <label for="soal">Soal</label>
                <input type="text" required class="form-control" id="soal" name="soal"  >
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>


@endsection