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
                <img src="{{ asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin IKT</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item {{ Request::is('/') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Data Akademik Menu -->
                <li class="nav-item {{ Request::is('dashboard/matakuliah*') || Request::is('dashboard/prodi*') || Request::is('dashboard/ruangan*') || Request::is('dashboard/kelas*') || Request::is('dashboard/tahun-akademik*') || Request::is('dashboard/kurikulum*') || Request::is('dashboard/batas-sks*') || Request::is('dashboard/data-dosen*') || Request::is('dashboard/data-mahasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('dashboard/matakuliah*') || Request::is('dashboard/prodi*') || Request::is('dashboard/ruangan*') || Request::is('dashboard/kelas*') || Request::is('dashboard/tahun-akademik*') || Request::is('dashboard/kurikulum*') || Request::is('dashboard/batas-sks*') || Request::is('dashboard/data-dosen*')  || Request::is('dashboard/data-mahasiswa*') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Master Data Akademik
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
                <li class="nav-item {{ Request::is('dashboard/kelas-mhs*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('dashboard/kelas-mhs*') ? 'active' :'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                             Data Administrasi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/kelas-mhs" class="nav-link {{ Request::is('dashboard/kelas-mhs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelas Mahasiswa</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/kurikulum" class="nav-link {{ Request::is('dashboard/kurikulum*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Kurikulum</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/matakuliah" class="nav-link {{ Request::is('dashboard/matakuliah*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Matakuliah</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/prodi" class="nav-link {{ Request::is('dashboard/prodi*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Program Studi</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/ruangan" class="nav-link {{ Request::is('dashboard/ruangan*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Ruangan</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/kelas" class="nav-link {{ Request::is('dashboard/kelas*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Kelas</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/batas-sks" class="nav-link {{ Request::is('dashboard/batas-sks*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Batas SKS</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/data-dosen" class="nav-link {{ Request::is('dashboard/data-dosen*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Data Dosen</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item">--}}
{{--                            <a href="/dashboard/data-mahasiswa" class="nav-link {{ Request::is('dashboard/data-mahasiswa*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Data Mahasiswa</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>

            </ul>
        </nav>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>
