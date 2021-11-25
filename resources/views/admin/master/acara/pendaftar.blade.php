@extends("/admin/layouts/app")

@section('title',"Master Acara Pendaftar")

@section('content')
    <div class="card">
        <div class="card-header">
            Data Master Acara Pendaftar <b> {{ $model['acara']->judul_acara }} </b> 
        </div>
        <div class="card-body">
        
            <div class="table-responsive">
                <table id="table_view" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>email</th>
                            <th>nama</th>
                            <th>No Hp</th>
                            <th>status</th>
                            <th>Via</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>email</th>
                            <th>nama</th>
                            <th>No Hp</th>
                            <th>status</th>
                            <th>Via</th>

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
                {data: 'nama', name: 'nama'},
                {data: 'no_telp', name: 'no_telp'},
                {data: 'status', name: 'status'},
                {data: 'via', name: 'via'},
            ],
            dom: 'lBfrtip',
            buttons: ['excel', 'csv', 'pdf', 'copy'],
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });

        $('#kategori_filter').change(function(){
            table.draw();
        });

        $('#status').change(function(){
            table.draw();
        });

        initFormValidation(formId, rulesForm);
        initFormValidation(formEditId, rulesFormEdit);
        $(modalEditButtonId).click(function(e){
            setEditAction();
        });

        $('#kategori').select2({
            theme: "bootstrap",
            placeholder: 'Pilih Segmentasi',
            language: "id"
        });


        });

        function deleteAlert(id) {
            var body = {
                "id": id,
                "_token": token,
            }
            showDialogConfirmationAjax(null, 'Apakah anda yakin akan mengupdate data?', 'Data berhasil diupdate!', base_endpoint+'/'+id, 'DELETE', body, table_id);
        }

</script>
    
@endsection