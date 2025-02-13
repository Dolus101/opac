<link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-4605c815f1874757bc9ac33aa114fb0f.css?vsn=d">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-thin.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-solid.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-regular.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-light.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-thin.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-thin.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-regular.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-light.css">

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-myadmin">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">OMNIBOOK</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <hr>
        <!-- Navbar-->
        <ul class="nav navbar-nav navbar-right me-2">

        </ul>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../signout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link <?php if ($page == 'dashboard') {
                                                echo 'active';
                                            } ?> " href="../dashboard/index">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link <?php if ($page == 'chart') {
                                                echo 'active';
                                            } ?>" href="../dashboard/chart">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                            Chart
                        </a>

                        <!-- OPAC Dropdown Menu -->
                        <a class="nav-link collapsed <?php ?>" href="#" data-bs-toggle="collapse" data-bs-target="#opacDropdown" aria-expanded="false" aria-controls="opacDropdown">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                            OPAC
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="opacDropdown" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?php if ($page == 'subject') {
                                                        echo 'active';
                                                    } ?>" href="../opac/subject">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                    Subject Areas
                                </a>
                                <a class="nav-link <?php if ($page == 'book') {
                                                        echo 'active';
                                                    } ?>" href="../opac/books">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>
                                    Books
                                </a>
                                <a class="nav-link <?php if ($page == 'journal') {
                                                        echo 'active';
                                                    } ?> " href="../opac/journal">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book-journal-whills"></i></div>
                                    Journals
                                </a>
                                <a class="nav-link <?php if ($page == 'newspaper') {
                                                        echo 'active';
                                                    } ?> " href="../opac/newspaper">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                                    Newspapers
                                </a>
                                <a class="nav-link <?php if ($page == 'thesis') {
                                                        echo 'active';
                                                    } ?> " href="../opac/thesis">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bookmark"></i></div>
                                    Thesis
                                </a>

                            </nav>
                        </div>
                        <!-- MANAGEMENT DROPDOWN -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#managementDropdown" aria-expanded="false" aria-controls="opacDropdown">
                            <div class="sb-nav-link-icon"><i class="fa fa-solid fa-school-circle-exclamation"></i></div>
                            Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="managementDropdown" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?php if ($page == 'users') {
                                                        echo 'active';
                                                    } ?> " href="../management/users">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-user">
                                        </i>
                                    </div>
                                    Users
                                </a>
                                <a class="nav-link <?php if ($page == 'reservation') {
                                                        echo 'active';
                                                    } ?> " href="../management/borrow_confirmation">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-user">
                                        </i>
                                    </div>
                                    Book Confirmation
                                </a>
                                <a class="nav-link <?php if ($page == 'borrowed') {
                                                        echo 'active';
                                                    } ?> " href="../management/borrowed">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    Borrowed Books
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#reportDropdown" aria-expanded="false" aria-controls="opacDropdown">
                            <div class="sb-nav-link-icon"><i class="fa-duotone fa-regular fa-chart-simple"></i></div>
                            Reports
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="reportDropdown" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?php if ($page == 'report') {
                                                        echo 'active';
                                                    } ?> " href="../reports/reports">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-sharp fa-solid fa-users"></i>
                                        </i>
                                    </div>
                                    Active User Report
                                </a>
                                <a class="nav-link <?php if ($page == 'borrowed_report') {
                                                        echo 'active';
                                                    } ?>" href="../reports/borrowed_report.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-user">
                                        </i>
                                    </div>
                                    Borrowed Report
                                </a>
                                <a class="nav-link" href="#">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-book"></i>
                                    </div>

                                </a>
                            </nav>
                        </div>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php  ?>
                </div>
            </nav>
        </div>
        <script src="https://use.fortawesome.com/1ce05b4b.js"></script>