<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>DASHBOARD</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fas fa-user"></i></i>GUESTS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-user-plus"></i><a href="add_guest.php">Add</a></li>
                        <li><i class="fas fa-table"></i><a href="guests.php">View</a></li>
                    </ul>
                </li>
                <?php
                if ($isAdmin) : ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fas fa-user-tie"></i></i>USERS</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fas fa-user-plus"></i><a href="add_user.php">Add</a></li>
                            <li><i class="fas fa-user-edit"></i><a href="users.php">View</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li><a href="reservations.php" class=""> <i class="menu-icon fas fa-history"></i>RESERVATIONS</a></li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-bed"></i>BOOKINGS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-bed"></i><a href="book.php">Book</a></li>
                        <li><i class="fas fa-table"></i><a href="bookings.php">View</a></li>
                    </ul>
                </li>


                <li><a href="bills.php" class=""> <i class="menu-icon fas fa-rupee-sign"></i>BILLS</a></li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-hotel"></i></i>ROOM</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-level-down-alt"></i><a href="room_status.php">Status</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-percentage"></i></i>OFFERS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-plus"></i><a href="add_offer.php">Add</a></li>
                        <li><i class="fas fa-table"></i><a href="offers.php">View</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-cog"></i></i>SETTINGS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-hotel"></i><a href="room_setting.php">Room</a></li>
                        <li><i class="fas fa-hotel"></i><a href="room_type_setting.php">Room Type</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-envelope"></i></i>MAILS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-headset"></i><a href="supports.php">Supports</a></li>
                        <li><i class="fas fa-sms"></i><a href="messages.php">Messages</a></li>
                        <li><i class="fas fa-envelope"></i><a href="send_mail.php">Send Mail</a></li>
                    </ul>
                </li>

                <li><a href="logout.php" class=""><i class="menu-icon fas fa-sign-out-alt"></i>Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->