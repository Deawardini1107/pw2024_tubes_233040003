<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Time Traveler</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    
    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>admin/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>admin/place.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Place</span></a>
    </li>

   
    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>admin/category.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Category</span></a>
    </li>

       
    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>admin/komentar.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Komentar</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>admin/booking.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>List Booking</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>