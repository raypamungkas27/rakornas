$( "#profile" ).validate({
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