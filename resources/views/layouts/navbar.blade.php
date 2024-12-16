<nav class="main-header navbar navbar-expand navbar-success navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        @if(auth()->check())
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle"></i> {{ auth()->user()->name }} <i class="fas fa-chevron-down ml-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="/profile" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" onclick="event.preventDefault(); confirmLogout();" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>

                    <!-- Form Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endif
    </ul>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout?',
                text: "Anda akan keluar dari sesi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</nav>
