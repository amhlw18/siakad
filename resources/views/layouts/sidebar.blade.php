<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('lte/dist/img/ikt.png') }}" alt="ikt" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SIAKAD IKT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('lte/dist/img/default-user-photo.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item {{ Request::is('dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('superadmin')
                    <!-- Data Akademik Menu -->
                    <li class="nav-item {{ Request::is('dashboard/matakuliah*') || Request::is('dashboard/prodi*') || Request::is('dashboard/ruangan*') || Request::is('dashboard/kelas*') || Request::is('dashboard/tahun-akademik*') || Request::is('dashboard/kurikulum*') || Request::is('dashboard/batas-sks*') || Request::is('dashboard/data-dosen*') || Request::is('dashboard/data-mahasiswa*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('dashboard/matakuliah*') || Request::is('dashboard/prodi*') || Request::is('dashboard/ruangan*') || Request::is('dashboard/kelas*') || Request::is('dashboard/tahun-akademik*') || Request::is('dashboard/kurikulum*') || Request::is('dashboard/batas-sks*') || Request::is('dashboard/data-dosen*') || Request::is('dashboard/data-mahasiswa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Data Pokok
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/tahun-akademik" class="nav-link {{ Request::is('dashboard/tahun-akademik*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tahun Akademik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/kurikulum" class="nav-link {{ Request::is('dashboard/kurikulum*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kurikulum</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/matakuliah" class="nav-link {{ Request::is('dashboard/matakuliah*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Matakuliah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/prodi" class="nav-link {{ Request::is('dashboard/prodi*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Program Studi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/ruangan" class="nav-link {{ Request::is('dashboard/ruangan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/kelas" class="nav-link {{ Request::is('dashboard/kelas*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/batas-sks" class="nav-link {{ Request::is('dashboard/batas-sks*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Batas SKS</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/data-dosen" class="nav-link {{ Request::is('dashboard/data-dosen*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Dosen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/data-mahasiswa" class="nav-link {{ Request::is('dashboard/data-mahasiswa*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Mahasiswa</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Data Administrasi Menu -->
                    <li class="nav-item {{ Request::is('dashboard/kls-mhs*') || Request::is('dashboard/data-jadwal') || Request::is('dashboard/pa-mhs') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('dashboard/kls-mhs*') || Request::is('dashboard/data-jadwal') || Request::is('dashboard/pa-mhs')   ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>
                                Perkuliahan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/kls-mhs" class="nav-link {{ Request::is('dashboard/kls-mhs*') || Request::is('dashboard/data-jadwal/{prodi_id}') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kelas Mahasiswa</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/data-jadwal" class="nav-link {{ Request::is('dashboard/data-jadwal*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Kuliah</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/pa-mhs" class="nav-link {{ Request::is('dashboard/pa-mhs*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penasehat Akademik</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endcan

                @can('bendahara')
                    <!-- Data Pembayaran Menu -->
                    <li class="nav-item {{ Request::is('dashboard/pembayaran*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('dashboard/pembayaran*') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>
                                Data Pembayaran
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/pembayaran" class="nav-link {{ Request::is('dashboard/pembayaran*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembayaran SPP</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('dosen')
                    <!-- Dosen Menu -->
                    <li class="nav-item {{ Request::is('dashboard/aspek-nilai*') || Request::is('dashboard/nilai-semester') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('dashboard/aspek-nilai*') || Request::is('dashboard/nilai-semester')  ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user mr-2"></i>
                            <p>
                                Dosen
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/aspek-nilai" class="nav-link {{ Request::is('dashboard/aspek-nilai*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Aspek Penilaian</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/nilai-semester" class="nav-link {{ Request::is('dashboard/nilai-semester*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nilai Semester</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

            </ul>
        </nav>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>
