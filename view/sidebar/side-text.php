<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">CRMC</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="nav navbar-nav navbar-right me-2">

        </ul>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="navbarDropdown" href="#" role="button"  aria-controls="opacDropdown"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                        <a class="nav-link  <?php if ($page == 'dashboard') {
                                                echo 'active';
                                            } ?> " href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link <?php ?>" href="announcement.php">
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
                                            } ?>" href="subject.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                    Subject Areas
                                </a>
                                <a class="nav-link <?php if ($page == 'book') {
                                                echo 'active';
                                            } ?>" href="books.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>
                                    Books
                                </a>
                                <a class="nav-link <?php if ($page == 'journal') {
                                                echo 'active';
                                            } ?> " href="journal.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book-journal-whills"></i></div>
                                    Journals
                                </a>
                                <a class="nav-link <?php if ($page == 'newspaper') {
                                                echo 'active';
                                            } ?> " href="newspaper.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                                    Newspapers
                                </a>
                                <a class="nav-link <?php if ($page == 'thesis') {
                                                echo 'active';
                                            } ?> " href="thesis.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bookmark"></i></div>
                                    Thesis
                                </a>

                            </nav>
                        </div>

                        <a class="nav-link <?php ?>" href="student_approval.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-solid fa-school-circle-exclamation"></i></div>
                            Management
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                   
                </div>
            </nav>
        </div>