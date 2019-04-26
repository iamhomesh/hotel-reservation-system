<?php
include_once __DIR__.'/../includes/head.html.php';
include_once __DIR__. '/../includes/left_panel.html.php';
 ?>

<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">

                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <?php $result = $conn->query("SELECT COUNT(`request_id`) FROM `booking_requests` WHERE `status` = 'Pending'");
                            $row = $result->fetch_array();
                            ?>
                            <span class="count bg-danger"><?= $row[0]; ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have <?= $row[0] ?> Notification(s)</p>
                            <?php
                            $result = $conn->query("SELECT `booking_requests`.`request_id`, `rooms`.`room_no`, `guest`.`name` FROM `rooms`, `guest`, `booking_requests` WHERE (`booking_requests`.`guest_id` = `guest`.`guest_id` AND `booking_requests`.`room_id` = `rooms`.`room_id`) AND `booking_requests`.`status` = 'Pending'");
                            while ($row = $result->fetch_assoc()) :
                                $name = explode(' ', $row['name']);
                                $fname = $name[0];
                                $room = $row['room_no']; ?>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p><strong><?= $fname; ?></strong> wants to book room no <strong><?= $room; ?></strong></p>
                                </a>
                            <?php
                        endwhile;
                        ?>
                        </div>
                    </div>


                    <?php
                    $guest_result =  $conn->query("SELECT COUNT(`id`) FROM `guest_support` WHERE `status` = 'Unread'");
                    $guest_row = $guest_result->fetch_array();

                    $user_result = $conn->query("SELECT COUNT(`id`) FROM `user_support` WHERE `status` = 'Unread'");
                    $user_row = $user_result->fetch_array();

                    $total_mails = $guest_row[0] + $user_row[0];

                    ?>

                    <div class="dropdown for-message">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>


                            <style>
                                .mails-message {
                                    max-width: 300px;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;

                                }
                            </style>


                            <?php
                            if ($total_mails > 0) : ?>
                                <span class="count bg-danger"><?= $total_mails ?></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message" style="width: 350px">

                                <p class="text-dark font-weight-bold float-left text-uppercase"><?= $guest_row[0] ?> guest(s) need your help.</p>
                                <p class="float-right"><a class="text-info" href="">See all</a></p>
                                <?php
                                $query = "SELECT `guest_support`.`id`, `guest`.`name`, `guest_support`.`message`, `guest_support`.`date` FROM `guest`, `guest_support` WHERE `guest`.`guest_id` = `guest_support`.`guest_id` AND `guest_support`.`status` = 'Unread' ORDER BY `guest_support`.`date` DESC LIMIT 5";
                                $result = $conn->query($query);
                                while ($row = $result->fetch_assoc()) :
                                    $id = $row['id'];
                                    $guest = explode(' ', $row['name']);
                                    $message = $row['message'];
                                    $date = new DateTime($row['date']);
                                    $date = $date->format('d/m/y h:i A');
                                    ?>
                                    <a class="dropdown-item media" href="read_support.html.php?gsid=<?= $id; ?>">
                                        <div class="message media-body">
                                            <span class="name float-left"><?= $guest[0] ?></span>
                                            <span class="time float-right date"><?= $date ?></span>
                                            <p class='font-italic mails-message'><?= $message ?></p>
                                        </div>
                                    </a>

                                <?php endwhile; ?>
                                <p class='text-dark font-weight-bold text-uppercase float-left'><?= $user_row[0]; ?> user(s) need your help.</p>
                                <p class='float-right'><a href='user_support.html.php' class='text-info'>See all</p>
                                <?php
                                $result = $conn->query("SELECT `user`.`name`, `user_support`.`message`, `user_support`.`date` FROM `user`, `user_support` WHERE `user`.`user_id` = `user_support`.`user_id` AND `user_support`.`status` = 'Unread'");
                                while ($row = $result->fetch_assoc()) :
                                    $user = $row['name'];
                                    $message = $row['message'];
                                    $date = new DateTime($row['date']);
                                    $date = $date->format('d/m/y h:i A');
                                    ?>
                                    <a class="dropdown-item media" href="read_support.html.php?usid=<?= $id; ?>">
                                        <div class="message media-body">
                                            <span class="name float-left"><?= $user ?></span>
                                            <span class="time float-right"><?= $date ?></span>
                                            <p class="font-italic mails-message"><?= $message ?></p>
                                        </div>
                                    </a>
                                <?php
                            endwhile; //end of while
                        else : ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="message">
                                    <p class="text-secondary font-weight-bold text-center">No messages.</p>
                                <?php
                            endif;
                            ?>




                            </div>
                        </div>

                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <img class="user-avatar rounded-circle" src="images/fang.jpg" alt="User Avatar">
                                <!-- <p class="mt-2">Admin</p> -->
                            </a>

                            <div class="user-menu dropdown-menu">

                                <a class="nav-link" href="#"><i class="fas fa-key"></i>Password</a>

                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
    </header>
    <!--/Header-->