<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-1">Pembelian Tiket Bioskop Online</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @php
                $user = Auth::user();
            @endphp
            @if($user && $user->role === 'admin')
                <!-- Divider -->
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Admin</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.film.index') }}">
                        <i class="fas fa-film"></i>
                        <span>Kelola Film</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.jadwal.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Kelola Jadwal Tayang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.transaksi.index') }}">
                        <i class="fas fa-receipt"></i>
                        <span>Transaksi Pemesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.laporan') }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistik Penjualan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.role.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
            @endif

            @if($user && $user->role === 'pengguna')
                <!-- Divider -->
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Pengguna</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna.film.index') }}">
                        <i class="fas fa-film"></i>
                        <span>Daftar Film</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna.jadwal') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Tayang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna.pesanan.index') }}">
                        <i class="fas fa-list"></i>
                        <span>Riwayat Pesanan</span>
                    </a>
                </li>
            @endif

            @if($user && $user->role === 'petugas')
                <!-- Divider -->
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Petugas</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petugas.pemesanan.index') }}">
                        <i class="fas fa-list"></i>
                        <span>Kelola Pemesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petugas.tiket.index') }}">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Kelola Tiket</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petugas.tiket.scan') }}">
                        <i class="fas fa-receipt"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petugas.jadwal') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Cek Jadwal</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>