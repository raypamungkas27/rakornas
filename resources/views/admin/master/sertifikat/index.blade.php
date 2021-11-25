@extends("/admin/layouts/app")

@section('title',"Dashboard")

@section('content')

    <div class="card">
        <div class="card-header">
            Data Sertifikat {{ $data->judul_acara }}
        </div>
        <div class="card-body">
            @if ($data->file_sertifikat)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td> No</td>
                                <td>Nama File</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $data->file_sertifikat }}</td>
                                <td>
                                    <a href="/admin/master/acara/sertifikat/show/{{ $data->id }}" class="btn btn-primary btn-sm" target="_blank" >Lihat </a>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" type="button" > <i class="fa fa-edit" ></i> Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                
                <!-- Modal -->
                <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editLabel">edit Data Sertifikat</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/master/acara/sertifikat/edit/{{ $data->id }}" method="post" enctype="multipart/form-data" >
                                @csrf
            
                                <div class="form-group">
                                    <label for="file_sertifikat">File Sertifikat</label>
                                    <input type="file" class="form-control"  id="file_sertifikat" name="file_sertifikat" >
                                </div>
                                <div class="form-group">
                                    <label for="warna_sertifikat">Warna Font Sertifikat</label>
                                    <select required name="warna_sertifikat" id="warna_sertifikat" class="form-control">
                                        <option value="">Pilih Warna</option>
                                        <option {{ ($data->warna_sertifikat == "putih") ? "selected" : "" }} value="putih">putih</option>
                                        <option {{ ($data->warna_sertifikat == "hitam") ? "selected" : "" }} value="hitam">hitam</option>
                                        <option {{ ($data->warna_sertifikat == "biru") ? "selected" : "" }} value="biru">biru</option>
                                    </select>
                                </div>
                                <label for="" class="mt-3">Nomer</label>
                                <hr>
                                
                                <div class="form-group">
                                    <label for="format_nomer">Format Nomer</label>
                                    <input type="text" value="{{ $data->format_nomer }}" class="form-control" required id="format_nomer" name="format_nomer"  >
                                </div>
                                <div class="form-group">
                                    <label for="x_nomer">Ruas X text nomer</label>
                                    <input type="text" class="form-control" required id="x_nomer" name="x_nomer" value="{{ $data->x_nomer }}" >
                                </div>
                                <div class="form-group">
                                    <label for="y_nomer">Ruas Y text nomer</label>
                                    <input type="text" class="form-control" required id="y_nomer" name="y_nomer" value="{{ $data->y_nomer }}" >
                                </div>
                                <div class="form-group">
                                    <label for="size_font_nomer">Size font nomer</label>
                                    <input type="text" class="form-control" required id="size_font_nomer" name="size_font_nomer" value="{{ $data->size_font_nomer }}" >
                                </div>
                                <label for="" class="mt-3" >nama</label>
                                <hr>
                                <div class="form-group">
                                    <label for="y_nama">Ruas Y text nama</label>
                                    <input type="text" class="form-control" required id="y_nama" name="y_nama" value="{{ $data->y_nama }}" >
                                </div>
                                <div class="form-group">
                                    <label for="size_font_nama">Size font Nama</label>
                                    <input type="text" class="form-control" required id="size_font_nama" name="size_font_nama" value="{{ $data->size_font_nama }}" >
                                </div>
                                
            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>


            @else
                <button type="button" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm" > <i class="fa fa-plus" ></i> Tambah Data</button>
                
                <!-- Modal -->
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="tambahLabel">Tambah Data Sertifikat</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/master/acara/sertifikat/add/{{ $data->id }}" method="post" enctype="multipart/form-data" >
                                @csrf

                                <div class="form-group">
                                    <label for="file_sertifikat">File Sertifikat</label>
                                    <input type="file" class="form-control" required id="file_sertifikat" name="file_sertifikat" >
                                </div>
                                <div class="form-group">
                                    <label for="warna_sertifikat">Warna Font Sertifikat</label>
                                    <select required name="warna_sertifikat" id="warna_sertifikat" class="form-control">
                                        <option value="">Pilih Warna</option>
                                        <option value="putih">putih</option>
                                        <option value="hitam">hitam</option>
                                        <option value="biru">biru</option>
                                    </select>
                                </div>
                                <label for="" class="mt-3">Nomer</label>
                                <hr>
                                
                                <div class="form-group">
                                    <label for="format_nomer">Format Nomer</label>
                                    <input type="text" class="form-control" required id="format_nomer" name="format_nomer"  >
                                </div>
                                <div class="form-group">
                                    <label for="x_nomer">Ruas X text nomer</label>
                                    <input type="text" class="form-control" required id="x_nomer" name="x_nomer" value="{{ $data->x_nomer }}" >
                                </div>
                                <div class="form-group">
                                    <label for="y_nomer">Ruas Y text nomer</label>
                                    <input type="text" class="form-control" required id="y_nomer" name="y_nomer" value="{{ $data->y_nomer }}" >
                                </div>
                                <div class="form-group">
                                    <label for="size_font_nomer">Size font nomer</label>
                                    <input type="text" class="form-control" required id="size_font_nomer" name="size_font_nomer" value="{{ $data->size_font_nomer }}" >
                                </div>
                                <label for="" class="mt-3" >nama</label>
                                <hr>
                                <div class="form-group">
                                    <label for="y_nama">Ruas Y text nama</label>
                                    <input type="text" class="form-control" required id="y_nama" name="y_nama" value="{{ $data->y_nama }}" >
                                </div>
                                <div class="form-group">
                                    <label for="size_font_nama">Size font Nama</label>
                                    <input type="text" class="form-control" required id="size_font_nama" name="size_font_nama" value="{{ $data->size_font_nama }}" >
                                </div>
                                

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>

            @endif
        </div>
    </div>


    
   

@endsection