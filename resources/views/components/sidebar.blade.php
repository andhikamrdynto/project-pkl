<aside class="main-sidebar sidebar-dark-primary d-flex flex-column " style="background-color: #F6F6F6">
    <!-- Brand Logo -->
    <a href="#" class="brand-link border-bottom border-white" style="background-color: rgb(252, 249, 249)">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-bold text-dark">UniversityAllStar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pb-3 pt-3 rounded border-0 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('auth.dashboard') }}" class="d-block text-success font-weight-normal">{{ Auth::user()->username }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">MASTER-DATA</li>
                <li class="nav-item menu-open">
                    <a href="{{ route('auth.dashboard') }}" class="nav-link bg-success">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('auth.jurusan.index') }}" class="nav-link text-secondary @if (Route::currentRouteName() == 'auth.jurusan.index') active text-success @endif">
                                <i class="far fa-clipboard nav-icon"></i>
                                <p>Data Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth.mahasiswa.index') }}" class="nav-link text-secondary @if (Route::currentRouteName() == 'auth.mahasiswa.index') active text-success @endif">
                                <i class="far fa-user nav-icon"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth.dosen.index') }}" class="nav-link text-secondary @if (Route::currentRouteName() == 'auth.dosen.index') text-success active @endif">
                                <i class="far fa-user nav-icon"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth.matakuliah.index') }}" class="nav-link text-secondary @if (Route::currentRouteName() == 'auth.matakuliah.index') text-success active @endif">
                                <i class="far fa-clipboard nav-icon"></i>
                                <p>Data Matakuliah</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>