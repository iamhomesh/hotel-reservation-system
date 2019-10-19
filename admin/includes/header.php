<!-- Right Panel -->

<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="./">HOTEL RESERVATION SYSTEM</a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars text-dark"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                    <?php
                    include_once __DIR__ . '../../../classes/Message.php';
                    $messageObj = new Message();
                    $messages = $messageObj->getMessages();
                    $countMessages = $messageObj->countMessages();
                    ?>
                    <div class="dropdown for-message">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sms"></i>
                            <span class="count bg-info"><?= $countMessages ?></span>
                        </button>
                        <?php if ($countMessages > 0) : ?>
                            <div class="dropdown-menu" aria-labelledby="notification" style="width: 380px">
                                <p class="text-dark font-weight-bold float-left text-uppercase">You have <?= $messageObj->countMessages() ?> messages(s)</p>
                                <p class="float-right"><a class="text-info" href="messages.php">See all</a></p>
                                <?php foreach ($messages as $message) : ?>
                                    <div class="dropdown-item">
                                        <div class="message">
                                            <span class="text-dark font-weight-bold"><?= current(explode(' ', $message['name'])); ?></span>
                                            <span class="time float-right"><?= date('d M Y h:i A', strtotime($message['created_at'])) ?></span>
                                            <p class="font-italic mails-message"><?= $message['message']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    include_once __DIR__ . '../../../classes/Reservation.php';
                    include_once __DIR__ . '../../../classes/Guest.php';
                    include_once __DIR__ . '../../../classes/RoomType.php';

                    $reservaionObj = new Reservation();
                    $roomTypeObj = new RoomType();
                    $guestObj = new Guest();

                    $notifications = $reservaionObj->getPendings();
                    $countPendings = $reservaionObj->countAllPendings();
                    ?>
                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-warning"><?= $countPendings; ?></span>
                        </button>
                        <?php if ($countPendings > 0) : ?>
                            <div class="dropdown-menu" aria-labelledby="notification" style="width:380px">
                                <p class="text-dark font-weight-bold float-left text-uppercase">You have <?= $countPendings ?> Notification(s)</p>
                                <p class="float-right"><a class="text-info" href="reservations.php">See all</a></p>
                                <?php foreach ($notifications as $notification) : ?>
                                    <a class="dropdown-item media" href="book.php?reservation=<?= $notification['id'] ?>">
                                        <i class="fa fa-bell text-danger"></i>
                                        <p>
                                            <span class="font-weight-bold text-dark">
                                                <?= current(explode(' ', $guestObj->getName($notification['guest_id']))) ?>
                                            </span>
                                            wants to book 
                                            <span class="text-dark font-weight-bold font-italic"><?= $roomTypeObj->getRoomTypeName($notification['room_type_id']); ?></span>
                                        </p>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    include_once __DIR__ . '../../../classes/Support.php';
                    $supportObj = new Support();

                    $supports = $supportObj->getUnread();
                    $countSupports = $supportObj->countUnread();
                    ?>

                    <div class="dropdown for-mail">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="mail" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="count bg-danger"><?= $countSupports; ?></span>
                        </button>
                        <?php if ($countSupports > 0) : ?>
                            <div class="dropdown-menu" aria-labelledby="mail" style="width: 380px">
                                <?php if (!empty($supports)) : ?>
                                    <p class="text-dark font-weight-bold float-left text-uppercase">You have <?= $countSupports ?> mail(s)</p>
                                    <p class="float-right"><a class="text-info" href="supports.php">See all</a></p>
                                    <?php foreach ($supports as $support) : ?>
                                        <a class="dropdown-item media" href="view_support.php?gsid=<?= $support['id'] ?>">
                                            <div class="mr-2">
                                                <i class="fas fa-user-circle text-dark" style="font-size:50px"></i>
                                            </div>
                                            <div class="message media-body float-right">
                                                <span class="name font-weight-bold text-dark"><?= current(explode(' ', $guestObj->getName($support['guest_id']))); ?></span>
                                                <span class="time float-right"><?= date('d M Y h:i A', strtotime($support['created_at'])) ?></span>
                                                <p class="font-italic mails-message"><?= $support['message']; ?></p>
                                            </div>
                                        </a>
                                <?php endforeach;
                                    endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="user-area dropdown float-right">
                    <a href="#" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="text-uppercase font-weight-bold"><?= $loggedUser['username'] ?>&nbsp;<i class="fas fa-ellipsis-v"></i></div>
                    </a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="password.php"><i class="fas fa-key"></i>Password</a>
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--/Header-->