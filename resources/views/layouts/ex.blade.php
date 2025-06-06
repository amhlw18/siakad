<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('lte/dist/img/ikt.png') }}" alt="ikt" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Digilib IKT</span>
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
                <a href="#" class="d-block">Admin Perpus</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ Request::is('/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ Request::is('/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                 <li
                    class="nav-item {{ Request::is('dashboard/databuku*') || Request::is('dashboard/kategori-buku*') ? 'menu-open' : '' }} ">
                    <a href="#"
                        class="nav-link {{ Request::is('dashboard/databuku*') || Request::is('dashboard/kategori-buku*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-solid fa-book"></i>
                        <p>
                            Buku
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/databuku"
                                class="nav-link {{ Request::is('dashboard/databuku*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/kategori-buku"
                                class="nav-link  {{ Request::is('dashboard/kategori-buku*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Buku</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item {{ Request::is('dashboard/datamhs*') || Request::is('dashboard/datadosen*') ? 'menu-open' : '' }} ">
                    <a href="#"
                        class="nav-link {{ Request::is('dashboard/datamhs*') || Request::is('dashboard/datadosen*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-solid fa-users"></i>
                        <p>
                            Anggota
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/datamhs"
                                class="nav-link {{ Request::is('dashboard/datamhs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/datadosen"
                                class="nav-link {{ Request::is('dashboard/datadosen*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ Request::is('dashboard/datapeminjaman*') || Request::is('dashboard/riwayatpeminjaman*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('dashboard/datapeminjaman*') || Request::is('dashboard/riwayatpeminjaman*') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Peminjaman
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/datapeminjaman"
                                class="nav-link {{ Request::is('dashboard/datapeminjaman*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peminjaman Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/riwayatpeminjaman"
                                class="nav-link {{ Request::is('dashboard/riwayatpeminjaman*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Peminjaman</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-header">Pengaturan</li>

                                <li class="nav-item">
                                    <a href="pages/calendar.html" class="nav-link">
                                        <i class="nav-icon fas mdi mdi-logout me-2"></i>
                                        <i class=""></i>
                                        <p>
                                            Keluar
                                        </p>
                                    </a>
                                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Data Pokok
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Data Akademik
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/dashboard/tahun-akademik" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tahun Akademik</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/dashboard/kurikulum" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kurikulum</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/dashboard/matakuliah" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Matakuliah</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/dashboard/ruangan" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ruangan</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/dashboard/kelas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelas</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/dashboard/batas-sks" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Batas SKS</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/dashboard/data-dosen" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Dosen</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Data Institusi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/dashboard/prodi" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Program Studi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>
