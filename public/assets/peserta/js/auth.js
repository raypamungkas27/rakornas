
$( "#login" ).validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password : {
            required: true,
        }
    }
});

$( "#registerUmum" ).validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        name : {
            required: true,
        },
        id_pekerjaan : {
            required: true,
        },
        no_telp : {
            required: true,
            number:true,
        },
        provinsi : {
            required: true,
        },
        institusi : {
            required: true,
        },
        password : {
            required: true,
            minlength: 8
        },
        password2 : {
            required: true,
            equalTo:"#password"
        },
    }
});

$( "#Registeranggota" ).validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        no_aptikom : {
            required: true,
        },
        password : {
            required: true,
        }
    }
});

$( "#registerPengurus" ).validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        no_aptikom : {
            required: true,
        },
        no_telp : {
            required: true,
            number:true,
        },
        provinsi : {
            required: true,
        },
        institusi : {
            required: true,
        },
        password : {
            required: true,
        },
    }
});

$('.provinsi').select2({
	  
    placeholder: 'Provinsi Anda...',
    ajax: {
        url: '/select2/daftarProvinsi',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nama_provinsi,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

$('.institusi').select2({

    placeholder: 'institusi Anda...',
    ajax: {
        url: '/select2/daftarInstitusi',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.nama_pt,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    },
    tags: "true",

    });