$(document).ready(function() {
    $('#ruang').on('change', function() {
        var ruangID = $(this).val();
        if (ruangID) {
            $.ajax({
                url: '/getRak/' + ruangID,
                type: "GET",
                data: { "_token": "{{ csrf_token() }}" },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#rak').empty();
                        $('#rak').append('<option hidden>-Pilih Rak-</option>');
                        $.each(data, function(key, value) {
                            $('select[name="rak"]').append('<option value="' + value.id_rak + '">' + value.nama_rak + '</option>');
                            $('select').removeAttr('disabled'); // untuk enable field select rak
                            $('#form-rak').removeClass('d-none');
                        });
                    } else {
                        $('#rak').empty();
                    }
                }
            });
        } else {
            $('#rak').empty();
        }
    });
});

//Untuk menghidupkan field nama box
$(document).ready(function() {
    $('#rak').on('change', function() {
        $('#form-box').removeClass('d-none');
        $('input').removeAttr('disabled');
    });
});