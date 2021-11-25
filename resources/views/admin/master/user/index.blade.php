@extends("/admin/layouts/app")

@section('title',"Master User")

@section('content')
    <div class="card">
        <div class="card-header">
            Data Master User
        </div>
        <div class="card-body">
        
        
            <div class="table-responsive">
                <table id="table_view" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Nomer Aptikom</th>
                            <th style="width: 20%">
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Nomer Aptikom</th>
                            <th>Action</th>
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
            {data: 'email', name: 'email'},
            {data: 'no_telp', name: 'no_telp'},
            {data: 'nama', name: 'nama'},
            {data: 'id_status', name: 'id_status'},
            {data: 'no_aptikom', name: 'no_aptikom'},
            {data: 'action', name: 'action'},
            ]
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

        function reset(id) {
            showDialogConfirmationAjax2(null, 'Apakah anda yakin akan mengupdate data (reset Password)?', 'Data berhasil diupdate!', base_endpoint+'/reset/'+id, 'GET', table_id);
        }

</script>
    
@endsection