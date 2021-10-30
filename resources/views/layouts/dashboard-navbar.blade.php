<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('adminIndex')}}"><i class="fas fa-home fa-5x"></i></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('adminIndex')}}"><i class="fas fa-home"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                        <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                    </ul>
                </li>
            <li class="menu-header">DKM</li>
            <!--Jamaah-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Jamaah Manajemen</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('adminalamat-jamaah.index')}}">Alamat Jamaah</a></li>
                    <li><a class="nav-link" href="{{route('admindata-jamaah.index')}}">Detail Jamaah</a></li>
                </ul>
            </li>
            <!--Bendahara-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i> <span>Bendhara</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('adminkas-penerimaan.index')}}">Penerimaan</a></li>
                    <li><a class="nav-link" href="{{route('adminkas-pengeluaran.index')}}">Pengeluaran</a></li>
                    <li><a class="nav-link" href="{{route('adminZisDashboard')}}">Zis</a></li>
                </ul>
            </li>

            <li class="menu-header">ZIS</li>
            <!--Bendahara-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i> <span>ZIS</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('adminzis.create')}}">Tambah Penerimaan ZIS</a></li>
                    <li><a class="nav-link" href="{{route('adminzis.index')}}">Data Penerimaan ZIS</a></li>
                    <li><a class="nav-link" href="{{route('adminZisDashboard')}}">Zis</a></li>
                </ul>
            </li>

            <li class="menu-header">Dashboard Admin</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>User Manajemen</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('adminusers.index')}}">User</a></li>
                    <li><a class="nav-link" href="{{route('adminroles.index')}}">Role</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>