$(document).ready(function() {
    $('#ruang_2').on('change', function() {
        var ruangID = $(this).val();
        if (ruangID) {
            $.ajax({
                url: '/getRak/' + ruangID,
                type: "GET",
                data: { "_token": "{{ csrf_token() }}" },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#rak_2').empty();
                        $('#rak_2').append('<option hidden>-Pilih Rak-</option>');
                        $.each(data, function(key, value) {
                            $('select[name="rak_2"]').append('<option value="' + value.id_rak + '">' + value.nama_rak + '</option>');
                            $('#rak_2').removeAttr('disabled'); // untuk enable field select rak
                            $('#form-select-rak').removeClass('d-none');
                        });
                    } else {
                        $('#rak_2').empty();
                    }
                }
            });
        } else {
            $('#rak_2').empty();
        }
    });
});

$(document).ready(function() {
    $('#rak_2').on('change', function() {
        var rakID = $(this).val();
        if (rakID) {
            $.ajax({
                url: '/getBox/' + rakID,
                type: "GET",
                data: { "_token": "{{ csrf_token() }}" },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#box_select').empty();
                        $('#box_select').append('<option hidden>-Pilih Box-</option>');
                        $.each(data, function(key, value) {
                            $('select[name="box_select"]').append('<option value="' + value.id_box + '">' + value.nama_box + '</option>');
                        });
                    } else {
                        $('#box_select').empty();
                    }
                }
            });
        } else {
            $('#box_select').empty();
        }
    });
});


//Untuk menghidupkan field nama box
$(document).ready(function() {
    $('#rak_2').on('change', function() {
        $('#box_select').removeAttr('disabled');
        $('#form-select-box').removeClass('d-none');
    });
});

//Untuk menghidupkan field nama box
$(document).ready(function() {
    $('#box_select').on('change', function() {
        $('#map').removeAttr('disabled');
        $('#form-map').removeClass('d-none');
    });
});

$('input[type="text"]').on('keypress keyup keydown change', function() {
    if ($('input[type="text"]').val() == "") {
        $('button[id="btn-simpan"]').prop('disabled', true);
    } else {
        $('button[id="btn-simpan"]').prop('disabled', false);
    }
});