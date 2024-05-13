<!-- Bootstrap core JavaScript-->
{{-- <script src="{{ asset('templates/vendor/jquery/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="{{ asset('templates/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('templates/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('templates/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('templates/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('templates/js/demo/datatables-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('templates/js/bar-chart-penyimpanan.js') }}"></script>
<script src="{{ asset('templates/js/pilih_rak.js') }}"></script>
<script src="{{ asset('templates/js/pilih_box.js') }}"></script>
<script src="{{ asset('templates/js/lokasi_arsip.js') }}"></script>
<script src="{{ asset('templates/js/tahun_dokumen.js') }}"></script>

{{-- End Of Custom Script --}}

{{-- CDN Sweet Alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Styles -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" /> --}}
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

{{-- KHUSUS SCRIPT BARU TARO DI BAWAH INI --}}

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<?php if (isset($ruang)) { ?>
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statistik Penyimpanan'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                },
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y} Dokumen</b>'
        },
        series: [{
            name: 'Iklan',
            data: <?php echo json_encode($ruang); ?>
        }]
    });
</script>
<?php } ?>
