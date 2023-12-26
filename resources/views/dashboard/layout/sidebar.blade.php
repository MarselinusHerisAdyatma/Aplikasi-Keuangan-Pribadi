<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MoneyList</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-money-check"></i>
            <span>Pendapatan & Simpanan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">MENU PEMASUKAN</h6>
                <a class="collapse-item" href="/pemasukan">Daftar Pemasukan</a>
                <a class="collapse-item" href="/pemasukan/filter">Cetak Laporan</a>
                <br>
                <h6 class="collapse-header">MENU TABUNGAN</h6>
                <a class="collapse-item" href="/tabungan">Daftar Tabungan</a>
                <a class="collapse-item" href="/tabungan/filter">Cetak Tabungan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-credit-card"></i>
            <span>Pengeluaran & Hutang</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">MENU PENGELUARAN</h6>
                <a class="collapse-item" href="/pengeluaran">Daftar Pengeluaran</a>
                <a class="collapse-item" href="/pengeluaran/filter">Cetak Laporan</a>
                <br>
                <h6 class="collapse-header">MENU HUTANG</h6>
                <a class="collapse-item" href="/hutang">Daftar Hutang</a>
                <a class="collapse-item" href="/hutang/filter">Cetak Hutang</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
            aria-expanded="true" aria-controls="collapseUtilities2">
            <i class="fas fa-chart-line"></i>
            <span>Perencanaan Keuangan</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">MENU ASURANSI</h6>
                <a class="collapse-item" href="/asuransi">Daftar Asuransi</a>
                <a class="collapse-item" href="/asuransi/filter">Cetak Asuransi</a>
                <br>
                <h6 class="collapse-header">MENU INVESTASI</h6>
                <a class="collapse-item" href="/investasi">Daftar Investasi</a>
                <a class="collapse-item" href="/investasi/filter">Cetak Investasi</a>
                <br>
                <h6 class="collapse-header">MENU WISHLIST</h6>
                <a class="collapse-item" href="/wishlist">Daftar Wishlist</a>
                <a class="collapse-item" href="/wishlist/filter">Cetak Wishlist</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3"
            aria-expanded="true" aria-controls="collapseUtilities4">
            <i class="fas fa-university"></i>
            <span>Akun Keuangan</span>
        </a>
        <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">MENU AKUN KEUANGAN</h6>
                <a class="collapse-item" href="/akun_keuangan">Daftar Akun Keuangan</a>
                <a class="collapse-item" href="/akun_keuangan/filter">Cetak Akun Keuangan</a>
            </div>
        </div>
    </li>

    @if(auth()->user()->role == "admin")
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Admin Menu
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
        <div id="collapseAdminMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ADMIN MENU</h6>
                <a class="collapse-item" href="/admin/listuser">Kelola User</a>
            </div>
        </div>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>