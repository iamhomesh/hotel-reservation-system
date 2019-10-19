<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler bg-dark border border-0" style="border-radius: 0px" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-light"></i>
            <!-- <i class="far fa-caret-square-down"></i> -->
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <script>
                $().ready(function() {
                    $('.navbar-nav a[href="' + window.location.pathname.split("/").pop() + '"]').addClass('active font-weight-bold');
                });
            </script>
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a href="home.php" class="nav-link"><i class="d-block d-lg-block text-center fa fa-laptop" style="font-size: 15px"></i>HOME</a>
                </li>
                <li class="nav-item">
                    <a href="book.php" class="nav-link"><i class="d-block d-lg-block text-center fas fa-bed" style="font-size: 15px"></i>BOOK</a>
                </li>
                <li class="nav-item">
                    <a href="bookings.php" class="nav-link"><i class="d-block d-lg-block text-center fas fa-history" style="font-size: 15px"></i>BOOKINGS</a>
                </li>
                <li class="nav-item">
                    <a href="support.php" class="nav-link"><i class="d-block d-lg-block text-center fas fa-envelope" style="font-size: 15px"></i>SUPPORT</a>
                </li>
            </ul>
        </div>
        <div class="">
            <a href="#" class="active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <p class="text-uppercase nav-link m-0 text-dark font-weight-bold"><?= $name ?? "" ?> <i class="fas fa-chevron-circle-down"></i></p>
                </a>
            <style>
                .user-menu {
                    left: inherit !important;
                    right: 0;
                }

                .user-menu .nav-link {
                    font-size: 14px;

                }
            </style>
            <div class="user-menu dropdown-menu bg-light position-absolute">
                <a class="text-secondary nav-link" href="profile.php"><i class="fas fa-user mr-2"></i>Profile</a>
                <a class="text-secondary nav-link" href="change_password.php"><i class="fas fa-cog mr-2"></i>Password</a>
                <a class="text-danger font-weight-bold nav-link" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </div>
        </div>
    </nav>