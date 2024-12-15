<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="nominasi" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Nominasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard hanya untuk admin dan juri -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Request::is('dashboard') ? 'bg-primary active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Menampilkan menu 'Data Master' hanya jika pengguna adalah admin -->
                @if (auth()->user()->isAdmin())
                    <li class="nav-header">Data Master</li>
                    <li class="nav-item">
                        <a href="{{ route('perlombaan.index') }}"
                            class="nav-link {{ Request::is('perlombaan*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>Perlombaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('class.index') }}"
                            class="nav-link {{ Request::is('class*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Kelas Perlombaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('criteria.index') }}"
                            class="nav-link {{ Request::is('criteria*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Kriteria</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peserta.index') }}"
                            class="nav-link {{ Request::is('peserta*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Peserta</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('juri.index') }}"
                            class="nav-link {{ Request::is('juri*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-gavel"></i>
                            <p>Juri</p>
                        </a>
                    </li>
                @endif

                <!-- Menampilkan menu 'Penilaian Master' hanya untuk admin dan juri -->
                @if (auth()->user()->isAdmin() || auth()->user()->isJuri())
                    <li class="nav-header">Penilaian Master</li>
                    <li class="nav-item">
                        <a href="{{ route('penilaian.index') }}"
                            class="nav-link {{ Request::is('penilaian*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('score.index') }}"
                            class="nav-link {{ Request::is('score*') ? 'bg-primary active' : '' }}">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Hasil</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
