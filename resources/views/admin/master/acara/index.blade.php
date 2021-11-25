@extends("/admin/layouts/app")

@section('title',"Master Acara")

@section('content')
    <div class="card">
        <div class="card-header">
            Data Master Acara
        </div>
        <div class="card-body">
            <a href="/admin/master/acara/create" class="btn btn-primary btn-sm mb-3"> <i class="fa fa-plus mr-1" ></i> Tambah Data </a>
        
            <div class="table-responsive">
                <table id="table_view" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>Judul Acara</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Status Presensi</th>
                            <th>Action</th>
                            <th style="width: 30%" >Presensi / Sertifikat / Kuesioner</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>Judul Acara</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Status Presensi</th>
                            <th>Action</th>
                            <th>presensi / Sertifikat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        
        
        </div>
    </div>
@endsection

@section('js')

<script>
    var base_endpoint = "{{$model['base_url']}}";
    var table_id = '#table_view';
    var table = null;


    $(document).ready(function() {

        var table = $(table_id).DataTable({
            processing: true,
            serverSide: true,
            order: [[ 0, "asc" ]],
            ajax: {
                url: base_endpoint,
                data: function (d) {
                    d.status = $('#status').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
            {data: 'id', name: 'id', render : function(data, type, full, meta) {
                return '<strong class=" col-red" style="font-size: 12px">'+(meta.row+1)+'</strong>';
            }},
            {data: 'judul_acara', name: 'judul_acara'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'id_status', name: 'id_status'},
            {data: 'status_presensi', name: 'status_presensi'},
            {data: 'action', name: 'action'},
            {data: 'presensi', name: 'presensi'},
            ]
        });



        });

        function status(id) {
            showDialogConfirmationAjax2(null, 'Apakah anda yakin akan mengupdate data (status)?', 'Data berhasil diupdate!', base_endpoint+'/status/'+id, 'GET', table_id);
        }

        function presensi(id) {
            showDialogConfirmationAjax2(null, 'Apakah anda yakin akan mengupdate data (status presensi)?', 'Data berhasil diupdate!', base_endpoint+'/status_presensi/'+id, 'GET', table_id);
        }

</script>
    
@endsection