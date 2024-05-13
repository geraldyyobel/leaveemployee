<ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <img src="{{ asset('templates/img/bcu.png') }}" width="200">
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->

    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Beranda -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pengguna -->
    @if (auth()->user()->level == 'user')
        <li
            class="nav-item {{ request()->is('dokumen_terbuka_user') | request()->is('dokumen_terbatas_user') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuperadmin"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file-alt"></i>
                <!-- <span>Dokumen</span> -->
            </a>
            <!-- <div id="collapseSuperadmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('dokumen_terbuka_user') ? 'active' : '' }}"
                        href="/dokumen_terbuka_user">
                        <i class="fas fa-fw fa-square fa-xs"></i>
                        <span>Terbuka</span>
                    </a>
                    <a class="collapse-item {{ request()->is('dokumen_terbatas_user') ? 'active' : '' }}"
                        href="/dokumen_terbatas_user">
                        <i class="fas fa-fw fa-square fa-xs"></i>
                        <span>Terbatas</span>
                    </a>
                </div>
            </div> -->
        </li>
    @endif


    {{-- UNTUK TAMPILAN SUPER ADMIN --}}

    @if (auth()->user()->level == 'superadmin')
        

            <li
            class="nav-item {{ request()->is('dokumen_terbuka') ? 'active' : '' }}">
            <a class="nav-link" href="/dokumen_terbuka">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Pengajuan Cuti</span>
            </a>
            </li>

            <li
            class="nav-item {{ request()->is('master_setup/data_user') ? 'active' : '' }}">
            <a class="nav-link" href="/master_setup/data_user">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>User</span>
            </a>
            </li>
        </li>
        {{-- END OF SIDEBAR MENU 2 SUPER ADMIN --}}

        {{-- SIDEBAR MENU 3 SUPER ADMIN --}}
        <li class="nav-item {{ request()->is('approval/pengarsipan') | request()->is('approval/peminjaman') | request()->is('approval/pengembalian') | request()->is('approval/pengarsipan_dua') | request()->is('approval/peminjaman_dua') | request()->is('approval/pengembalian_dua') ? 'active' : '' }} ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-signature "></i>
                <span class="mr-5">Approval</span>
                {{-- Untuk count all pengajuan pending --}}
                <p class="d-none">
                    {{ $a = $count_pengarsipan_pending + $count_peminjaman_pending + $count_pengembalian_pending +  $count_peminjaman_pending_ruangan + $count_pengembalian_pending_ruangan }}
                </p>
                @if ($a == 0)
                @else
                    <i class="float-center badge badge-danger ">{{ $count_peminjaman_pending }}</i>
                @endif
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    
                    
                        <a class="collapse-item {{ request()->is('approval/pengarsipan') ? 'active' : '' }}"
                            href="/approval/pengarsipan">
                            <i class="fas fa-fw fa-square fa-xs"></i>
                            <span>Pengarsipan Cuti</span>
                            @if ( $count_pengarsipan_pending == 0)
                            @else
                                <i class="badge badge-danger float-right">
                                    {{ $count_pengarsipan_pending }}
                                </i>
                            @endif
                        </a>
                        
                    <a class="collapse-item {{ request()->is('approval/peminjaman') ? 'active' : '' }}"
                        href="/approval/peminjaman">
                        <i class="fas fa-fw fa-square fa-xs"></i>
                        <span>Pengajuan Cuti</span>
                        @if ($count_peminjaman_pending == 0)
                        @else
                            <i class="float-right badge badge-danger ">{{ $count_peminjaman_pending }}</i>
                        @endif
                    </a>
                    
                    
                    <a class="collapse-item {{ request()->is('approval/pengembalian') ? 'active' : '' }}"
                        href="/approval/pengembalian">
                        <i class="fas fa-fw fa-square fa-xs"></i>
                        <span>Hitung Masa Cuti</span>
                        
                    </a>
                </div>
            </div>
        </li>
    @endif
    {{-- END OF SIDEBAR MENU 3 SUPER ADMIN --}}

    {{-- END OF TAMPILAN SUPER ADMIN --}}


    {{-- UNTUK TAMPILAN ADMIN --}}
    @if (auth()->user()->level == 'admin')

            <li
            class="nav-item {{ request()->is('dokumen_terbuka_admin') ? 'active' : '' }}">
            <a class="nav-link" href="/dokumen_terbuka_admin">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Pengajuan Cuti</span>
            </a>
            </li>

        <li
            class="nav-item {{ request()->is('riwayat/riwayat_pengarsipan') | request()->is('riwayat/riwayat_peminjaman') | request()->is('riwayat/riwayat_pengembalian') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-history"></i>
                <span  class="mr-5">Riwayat</span>
                {{-- Untuk count all pengajuan pending --}}
                
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    
                    <a class="collapse-item {{ request()->is('riwayat/riwayat_peminjaman') ? 'active' : '' }}"
                        href="/riwayat/riwayat_peminjaman">
                        <i class="fas fa-fw fa-square fa-xs"></i>
                        <span>Riwayat Cuti</span>
                        
                    </a>
                </div>
            </div>
        </li>
    @endif
    {{-- END OF SIDEBAR MENU 3 ADMIN --}}
    {{-- END OF TAMPILAN ADMIN --}}


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
