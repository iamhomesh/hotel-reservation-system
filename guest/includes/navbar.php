<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-contents" aria-controls="navbar-contents" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <i class="fas fa-bars"></i> -->
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-contents">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="active nav-item">
                <a href="home.php" class="nav-link"><i class="d-none d-lg-block text-center fa fa-laptop" style="font-size: 20px"></i>Home</a>
            </li>


            <li class="nav-item">
                <a href="book.php" class="nav-link"><i class="d-none d-lg-block text-center fas fa-bed" style="font-size: 20px"></i>Book</a>
            </li>
            <li class="nav-item">
                <a href="bookings.php" class="nav-link"><i class="d-none d-lg-block text-center fas fa-history" style="font-size: 20px"></i>Bookings</a>
            </li>
            <li class="nav-item">
                <a href="support.php" class="nav-link"><i class="d-none d-lg-block text-center fas fa-envelope" style="font-size: 20px"></i>Support</a>
            </li>
        </ul>

    </div>
    <div class="navbar-brand">

        <div class="user-area dropdown">

            <a href="#" class="active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!--dropdown-toggle-->
                <p class="text-uppercase nav-link m-1 text-dark font-weight-bold"><?= $name ?? "" ?> <i class="fas fa-chevron-circle-down"></i></p>
                <!-- <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar"> -->
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

            <div class="user-menu dropdown-menu bg-dark position-absolute">

                <a class="text-secondary nav-link" href="profile.php"><i class="fas fa-user mr-2"></i>Profile</a>

                <a class="text-secondary nav-link" href="change_password.php"><i class="fas fa-cog mr-2"></i>Password</a>

                <a class="text-danger nav-link" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </div>
        </div>
    </div>
</nav>