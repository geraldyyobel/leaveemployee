// JS Untuk pilih tanggal di pengajuan pengarsipan - retensi
$(document).ready(function() {
    $('input[id="tahun-dokumen"]').datepicker({
        minViewMode: 2,
        format: 'yyyy',
        autoclose: true
    });

    $('input[id="tahun-dokumen"]').on('keypress', function() {
        if (event.charCode >= 48 && event.charCode <= 57) {
            return true;
        } else {
            return false;
        }
    });
    // document.getElementById("tahun-dokumen").style.cursor = "pointer";
});