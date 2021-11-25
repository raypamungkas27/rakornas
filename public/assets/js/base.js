var token = $("meta[name='csrf-token']").attr("content");

function createColumns(columnArray){
    var array = [];
    columnArray.forEach(item => {
        array.push({
            data: item,
            name: item,
            render : function(data, type, row) {
                return '<strong class=" col-red" style="font-size: 12px">'+row[item]+'</strong>';
            }
        });
    });


    array.push({
        data: 'id',
        name: 'id',
        render : function(data, type, row) {
            return '<div class="form-button-action"><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit" onclick="editData('+row['id']+')"><i class="fa fa-edit"></i></button><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" onclick="deleteAlert('+row['id']+')"><i class="fa fa-times"></i></button></div>';
        }
    });

    return array;
}

function createColumnsAction(columnArray, action){
    var array = [];
    columnArray.forEach(item => {
        array.push({
            data: item,
            name: item,
            render : function(data, type, row) {
                return '<strong class=" col-red" style="font-size: 12px">'+row[item]+'</strong>';
            }
        });
    });


    array.push(action);

    return array;
}

function createColumnsActionNative(columnArray){
    var array = [];
    columnArray.forEach(item => {
        array.push({
            data: item,
            name: item,
            render : function(data, type, row) {
                return '<strong class=" col-red" style="font-size: 12px">'+row[item]+'</strong>';
            }
        });
    });

    return array;
}

function initDataTableLoad(view_id, endpoint, columns) {
    return $(view_id).DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        processing: true,
        serverSide: true,
        fixedColumns: true,
        order : [[1, "asc"]],
        ajax : endpoint,
        columns : columns,
    });
}

function showDialogConfirmEditPost(modalEditForm, endpoint, body, table){
    swal({
        title: 'Peringatan',
        text: "Apakah anda yakin akan mengupdate data?",
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Ya',
                className : 'btn btn-success'
            },
            cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((Confirm) => {
        if (Confirm) {
            $.ajax({
                url: endpoint,
                type: "PUT",
                data: body,
                dataType: 'json',
                success: function (data) {
                    showSuccessDialog('Berhasil', 'Berhasil mengupdate data', false, table);
                }
            });
        } else {
            swal.close();
        }
    });
}

function showDialogConfirmationAjax(modalId, textConfirm, textAfter, url, method, body, table, loadAgain) {
    swal({
        title: 'Pemberitahuan',
        text: textConfirm,
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Ya',
                className : 'btn btn-success'
            },
            cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((Okay) => {
        if (Okay) {
            $(modalId).modal('hide');
            $.ajax({
                url: url,
                type: method,
                data: body,
                success: function (){
                    showSuccessDialog(textAfter, loadAgain, table);
                }
            });
        } else {
            swal.close();
        }
    });
}

function showDialogConfirmationAjax2(modalId, textConfirm, textAfter, url, method, table, loadAgain) {
    swal({
        title: 'Pemberitahuan',
        text: textConfirm,
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Ya',
                className : 'btn btn-success'
            },
            cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((Okay) => {
        if (Okay) {
            $(modalId).modal('hide');
            $.ajax({
                url: url,
                type: method,
                success: function (){
                    showSuccessDialog(textAfter, loadAgain, table);
                }
            });
        } else {
            swal.close();
        }
    });
}

function showSuccessDialog(message, reloadPage, table){
    swal({
        title: 'Pemberitahuan',
        icon: 'success',
        text: message,
        type: 'success',
        cancel: false,
        buttons : {
            confirm: {
                className : 'btn btn-success'
            }
        }
    }).then((Delete) => {
        if (reloadPage) {
            location.reload();
        } else {
            $(table).DataTable().ajax.reload();
        }

    });
}

function initFormValidation(viewId, rules){
    $(viewId).validate({
        validClass: "success",
        rules: rules,
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
    });
}
