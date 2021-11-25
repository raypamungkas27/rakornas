@extends("/admin/layouts/app")

@section('title',"Edit Data Acara")

@section('content')
<div class="card">
    <div class="card-header">
        Edit Data Acara {{ $model['data']->judul_acara }}
    </div>
    <div class="card-body">
        <form action="/admin/master/acara/{{$model['data']->id  }}" id="tambahAcara" enctype="multipart/form-data" method="post">
            @method("PUT")
            @csrf

            <div class="form-group">
                <label for="judul_acara">Judul Acara <small class="text-danger">*</small> </label>
                <input type="text" class="form-control" value="{{ $model['data']->judul_acara }}" required id="judul_acara" name="judul_acara"
                    placeholder="Masukan Judul Acara">
            </div>
            <div class="form-group">
                <label for="tema">Tema Acara <small class="text-danger">*</small></label>
                <input type="text" class="form-control" value="{{ $model['data']->judul_acara }}" required id="tema" name="tema" placeholder="Masukan Tema Acara">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Acara <small class="text-danger">*</small></label>
                <input type="date" class="form-control" value="{{ $model['data']->tanggal }}" required id="tanggal" name="tanggal"
                    placeholder="Masukan Tanggal Acara">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jam">Jam Acara <small class="text-danger">*</small></label>
                        <input type="time" class="form-control" value="{{ $model['data']->jam }}"  required id="jam" name="jam"
                            placeholder="Masukan Jam Acara">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jam_akhir">Jam Selesai Acara <small class="text-danger">*</small></label>
                        <input type="time" class="form-control" value="{{ $model['data']->jam_akhir }}"  required id="jam_akhir" name="jam_akhir"
                            placeholder="Jam Selesai Acara">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="kuota">Kuota Acara Zoom <small class="text-danger">*</small></label>
                <input type="number" class="form-control" value="{{ $model['data']->kuota }}" required id="kuota" name="kuota"
                    placeholder="Masukan kuota Zoom Acara">
            </div>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_zoom">Link Zoom Acara </label>
                        <input type="text" class="form-control" value="{{ $model['data']->link_zoom }}" id="link_zoom" name="link_zoom"
                            placeholder="Masukan link Zoom  Acara">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_youtube">Link Youtube Acara</label>
                        <input type="text" class="form-control" id="link_youtube" value="{{ $model['data']->link_youtube }}" name="link_youtube"
                            placeholder="Masukan Link Youtube Acara">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_materi">Link materi Acara</label>
                        <input type="text" class="form-control" id="link_materi" value="{{ $model['data']->link_materi }}" name="link_materi"
                            placeholder="Masukan Link materi Acara">
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_zoom_umum">Harga Zoom Umum (Sertifikat) <small class="text-danger">*</small>
                        </label>
                        <input type="text" class="form-control harga" id="harga_zoom_umum" value="{{ $model['data']->harga_zoom_umum }}" name="harga_zoom_umum"
                            placeholder="Masukan harga Zoom Umum Acara">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_zoom_aptikom">Harga Zoom Aptikom (Sertifikat) <small
                                class="text-danger">*</small> </label>
                        <input type="text" class="form-control harga" id="harga_zoom_aptikom" value="{{ $model['data']->harga_zoom_aptikom }}" name="harga_zoom_aptikom"
                            placeholder="Masukan harga Aptikom Acara">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_youtube_umum">Harga Youtube Umum (Sertifikat) <small
                                class="text-danger">*</small> </label>
                        <input type="text" class="form-control harga" id="harga_youtube_umum" value="{{ $model['data']->harga_youtube_umum }}" name="harga_youtube_umum"
                            placeholder="Masukan harga umum Acara">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_youtube_aptikom">harga Youtube Aptikom (Sertifikat) <small
                                class="text-danger">*</small> </label>
                        <input type="text" class="form-control harga" id="harga_youtube_aptikom" value="{{ $model['data']->harga_youtube_aptikom }}" name="harga_youtube_aptikom"
                            placeholder="Masukan harga Youtube Aptikom Acara">
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="id_status">Status Acara</label>
                <select name="id_status" id="id_status" class="form-control">
                    <option {{ ($model['data']->id_status == "1" ) ? "selected" : ""   }} value="1">Aktif</option>
                    <option {{ ($model['data']->id_status == "0" ) ? "selected" : ""   }} value="0">Tutup</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Via Acara : </label>
                <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                        <input type="checkbox"  {{ ($model['data']->ViaAcaraModel->via_zoom_sertifikat == "1" ) ? "checked" : ""   }} name="via_zoom_sertifikat" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">Zoom (sertifikat)</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="checkbox" {{ ($model['data']->ViaAcaraModel->via_youtube_sertifikat == "1" ) ? "checked" : ""   }} name="via_youtube_sertifikat" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">Youtube (sertifikat)</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="checkbox" {{ ($model['data']->ViaAcaraModel->via_zoom_gratis == "1" ) ? "checked" : ""   }} name="via_zoom_gratis" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">Zoom (Gratis)</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="checkbox" {{ ($model['data']->ViaAcaraModel->via_youtube_gratis == "1" ) ? "checked" : ""   }} name="via_youtube_gratis" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">youtube (Gratis)</span>
                    </label>

                </div>
            </div>

            <div class="separator-solid"></div>
            <div class="form-group form-show-validation row">
                <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Upload Image ( Max File : 2MB ) <span
                        class="required-label">*</span></label>
                <div class="col-lg-4 col-md-9 col-sm-8">
                    <div class="input-file input-file-image">
                        <a target="_blank" href=" {{ asset("assets/img/webinar/")."/".$model['data']->img }} "> <i class="fa fa-eye" ></i> Lihat Gambar</a>
                        <img class="img-upload-preview " width="300" height="200" src="http://placehold.it/100x100"
                            alt="preview">
                            
                        <input type="file" class="form-control form-control-file" id="img" name="img" accept="image/*">
                        <label for="img" class="btn btn-info btn-round btn-lg"><i class="fa fa-file-image"></i>
                            Upload a Image</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary mt-5" style="width: 100% !important"  > Simpan</button>

        </form>

    </div>
</div>
@endsection

@section('js')
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script> 
    <script src="{{ asset("assets/js") }}/jquery.mask.js"></script>

   <script>
       $( "#tambahAcara" ).validate({
        rules: {
            judul_acara: {
                required: true
            },
            tema: {
                required: true
            },
            tanggal: {
                required: true
            },
            jam: {
                required: true
            },
            jam_akhir: {
                required: true
            },
            kuota: {
                required: true
            },
            harga_zoom_umum: {
                required: true
            },
            harga_zoom_aptikom: {
                required: true
            },
            harga_youtube_umum: {
                required: true
            },
            harga_youtube_aptikom: {
                required: true
            },
            id_status: {
                required: true
            },

        }
        });

        $(document).ready(function(){
            $('.harga').mask('000.000.000.000.000', {reverse: true});

            });
   </script>

@endsection
