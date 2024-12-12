<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Data Master</li>
                <li class="nav-item">
                    <a href="{{ route('perlombaan.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Perlombaan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('class.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Kelas Perlombaan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('criteria.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Kriteria
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peserta.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Peserta
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('juri.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Juri
                        </p>
                    </a>
                </li>
                <li class="nav-header">Penilaian Master</li>
                <li class="nav-item">
                    <a href="{{ route('penilaian.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Penilaian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('score.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Hasil
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
