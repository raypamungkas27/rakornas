@extends("/admin/layouts/app")

@section('title',"Master Validasi")

@section('content')
    <div class="card">
        <div class="card-header">
            Data Master Validasi 
            <a href="/admin/master/validasi/dataGagal" class="btn btn-primary btn-sm ml-3" style="float: right" > <i class="fa fa-eye" ></i> Lihat Data Gagal</a>
        </div>
        <div class="card-body">
        
            <div class="table-responsive">
                <table id="table_view" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>nama</th>
                            <th>Status Peserta</th>
                            <th>Acara</th>
                            <th>status</th>
                            <th>Harga</th>
                            <th>Via</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>nama</th>
                            <th>Status Peserta</th>
                            <th>Acara</th>
                            <th>status</th>
                            <th>Harga</th>
                            <th>Via</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        
        
        </div>
    </div>
@endsection

@section('js')

<script src="{{ asset('assets/js/plugin/dTables/asset/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/dTables/asset/buttons.print.min.js') }}"></script>


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
            {data: 'id', name: 'pendaftaran.id', render : function(data, type, full, meta) {
                return '<strong class=" col-red" style="font-size: 12px">'+(meta.row+1)+'</strong>';
            }},
            {data: 'email', name: 'email'},
            {data: 'no_telp', name: 'no_telp'},
            {data: 'nama', name: 'nama'},
            {data: 'id_status', name: 'id_status'},
            {data: 'acara', name: 'acara'},
            {data: 'status', name: 'status'},
            {data: 'harga', name: 'harga'},
            {data: 'via', name: 'via'},
            {data: 'file', name: 'file'},
            {data: 'action', name: 'action'},
            ],
            dom: 'lBfrtip',
            buttons: ['excel', 'csv', 'pdf', 'copy'],
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });

        });

        function sukses(id) {

            showDialogConfirmationAjax2(null, 'Apakah anda yakin akan mengupdate data (sukses)?', 'Data berhasil diupdate!', base_endpoint+'/sukses/'+id, 'GET', table_id);
        }

        function gagal(id) {

            showDialogConfirmationAjax2(null, 'Apakah anda yakin akan mengupdate data (gagal)?', 'Data berhasil diupdate!', base_endpoint+'/gagal/'+id, 'GET', table_id);
        }

</script>
    
@endsection