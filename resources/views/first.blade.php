<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pengajuan Cuti PT BCU</title>
    <link rel="icon" href="{!! asset('templates/img/bcu-logo.png') !!}" />
    @include('layout.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                <img src="{{ asset('templates/img/bcu.png') }}" width="200px">
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->

            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Beranda -->
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login">
                    <i class="fas fa-fw fa-sign-in-alt"></i>
                    <span>Login</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-flex align-items-center">
                        <p class="h3 text-gray-800 mb-0 mr-1 font-weight-bold">Dashboard</p>
                        <p class="mb-0 text-gray-800 text-small">Overview & Statistics</p>
                        {{-- <p class="mb-0 bg-primary rounded text-white p-2"><i class="far fa-calendar"></i>{{ date(' j F Y') }}</p> --}}
                    </div>

                    <div class="row">
                        <!-- Card  -->
                        

                        <!-- <div class="col-xl-4  mb-3 mt-2">
                            <div class="card border-left-success shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-s font-weight-bold text-success mb-2">
                                                Oktober 2023</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $count_peralatan }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <hr class="divider">
                                    <div class="text-gray-800 text-sm">Total Karyawan Cuti Bulan Ini</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4  mb-3 mt-2">
                            <div class="card border-left-success shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-s font-weight-bold text-success mb-2">
                                                Tahun 2023</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $count_ruangan }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <hr class="divider">
                                    <div class="text-gray-800 text-sm">Total Karyawan Cuti Tahun ini</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div> -->
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Modal Keluar --}}
    {{-- @include('admin.keluar.m_keluar') --}}

    {{-- @include('sweetalert::alert') --}}

    {{-- Script --}}
    @include('layout.script')
    {{-- End Script --}}
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
                pointFormat: '<b>{point.y} Ruang</b>'
            },
            series: [{
                name: 'Iklan',
                data: <?php echo json_encode($ruang); ?>
            }]
        });
    </script> --}}
</body>

</html>
