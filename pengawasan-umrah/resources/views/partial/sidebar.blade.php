<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(#076b07, #5cf25c);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="images/logo_kemenag.png" alt="logo_kemenag" style="width: 50px;">
        </div>
        <div class="sidebar-brand-text mx-3">Pengawasan Umrah</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ ($title === 'Dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ ($title === 'PPIU') ? 'active' : '' }}">
        <a class="nav-link" href="lihat_ppiu.php">
            <i class="fas fa-fw fa-building"></i>
            <span>PPIU</span></a>
    </li>

    <li class="nav-item {{ ($title === 'Pengawasan') ? 'active' : '' }}">
        <a class="nav-link" href="pengawasan.php">
            <i class="fas fa-fw fa fa-file-alt"></i>
            <span>Pengawasan</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->