<?php
include_once __DIR__ . '/includes/toast.php';
include_once __DIR__ . '/classes/Message.php';
$name = $email = $mobile = $message = "";
$errors = [];
$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    if (empty($name)) $errors[] = "Please enter your name.";
    if (empty($email)) $errors[] = "Please enter your email id.";
    if (empty($mobile)) $errors[] = "Please enter your mobile number.";
    if (empty($message)) $errors[] = "Please enter message.";
    if (strlen($message) > 300) $errors[] = "Maximum 300 characters allowed.";
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email id.";

    if (empty($errors)) {
        $messageObj = new Message();
        $fields = [
            'name' => ucwords(trim(strtolower($name))),
            'mobile' => $mobile,
            'email' => trim($email),
            'message' => $message
        ];
        $sent = $messageObj->send($fields);
        if($sent) $success = "Message has been sent successfully.";
        $name = $email = $mobile = $message = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Reservation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>

<style>
    * {
        font-family: 'Open Sans'
    }

    .follow-icon {
        font-size: 40px;
    }

    .text-orange {
        color: #FF541E
    }

    @media screen and (max-width: 500px) {
        .nav-link {
            font-size: 10px
        }
    }
</style>


<body>
    <div>

    </div>
    <nav class="sticky-top">
        <div class="nav navbar bg-white" id="nav-tab" role="">
            <a class="nav-item nav-link font-weight-bold text-dark active text-uppercase" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
            <a class="nav-item nav-link text-dark text-uppercase" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a>
            <a class="nav-item nav-link text-dark text-uppercase" id="nav-room-tab" data-toggle="tab" href="#nav-room" role="tab" aria-controls="nav-room" aria-selected="false">Rooms</a>
            <a class="nav-item nav-link text-dark text-uppercase" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
            <a href="#" id="option" data-popover="popover" data-placement="left" data-trigger="focus" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-dark"></i>
            </a>
            <div class="" hidden id="popover-menu">
                <a class="text-light font-weight-bold nav-link text-dark text-uppercase" href="login.php">Login</a>
                <a class="text-light font-weight-bold text-dark nav-link text-uppercase" href="register.php">Sign up</a>
            </div>

        </div>
    </nav>
    <?php
    if (!empty($success)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= $success ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="min-vh-100 text-center m-0 d-flex flex-column justify-content-center">
                <div class="title h1">WELCOME</div>
                <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
            <div class="container">
                <div class="title h4 text-center text-uppercase">About Us</div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et dignissim neque. Integer in venenatis ipsum, at sollicitudin dui. Pellentesque sem leo, consectetur vitae posuere id, rutrum ac odio. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In viverra condimentum enim. Aliquam erat volutpat. Sed egestas libero mauris, vitae sollicitudin dui feugiat quis. Quisque rhoncus aliquet purus at consequat. Quisque a lobortis magna, quis dapibus justo. Ut sagittis, nisi pretium semper rutrum, eros justo imperdiet lorem, eu vulputate nulla ipsum eget felis. Donec et hendrerit sapien. Curabitur sodales rhoncus mi, vel faucibus ipsum lacinia eu. Vestibulum id tortor aliquam, placerat neque ut, sagittis nibh.
                </p>
                <p>
                    Sed id faucibus dolor, vel egestas ante. Integer id tortor pretium, ullamcorper eros pretium, iaculis turpis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi et leo lacus. Ut non sagittis enim. Nam at nisl nisl. Cras rhoncus vehicula lectus, at hendrerit ante pretium sed. Morbi a placerat lacus. Nam mollis enim quam, eu luctus risus vulputate eu. In hac habitasse platea dictumst. Donec condimentum eros ac velit tincidunt feugiat. Etiam sed suscipit felis, vel accumsan metus.
                </p>
                <p>
                    Etiam lorem arcu, dictum vitae faucibus in, ultrices et neque. Ut id nisi ullamcorper, ultricies lorem quis, tempus libero. Nunc non leo leo. Nulla varius porttitor felis ut dignissim. In sed nunc et lorem luctus scelerisque sit amet in ex. Mauris elementum, tortor nec lacinia consequat, dolor sapien lobortis turpis, et tristique purus quam ut nunc. Vivamus eu arcu hendrerit, molestie dui ac, porta justo. Donec imperdiet dui eu ligula maximus ornare. Phasellus eget iaculis lacus.
                </p>
                <p>
                    Phasellus arcu ante, interdum vitae lacinia sed, lobortis id massa. Nunc mollis, tortor vitae scelerisque lacinia, tortor metus euismod erat, vitae pulvinar orci sem eu turpis. Suspendisse vitae cursus dui. Aliquam dapibus bibendum quam non luctus. Cras hendrerit purus a ex convallis consequat. Fusce laoreet mi nec cursus vulputate. Sed eu viverra ipsum.

                </p>
                <p>
                    Morbi lectus sem, dictum quis sapien vitae, aliquam dictum libero. Aenean finibus auctor tincidunt. Vivamus bibendum est congue, fringilla dolor eu, porta erat. Phasellus quis consectetur risus. Pellentesque dignissim augue nec interdum tincidunt. Integer lacinia vulputate tortor et finibus. Nullam ut cursus tortor. Phasellus iaculis mauris vel odio dapibus consectetur. Phasellus tincidunt neque non mauris sollicitudin, vitae ultricies velit varius. In consectetur venenatis nibh at consequat. Nunc ut quam elit. Mauris luctus malesuada ligula, ut congue elit finibus et. Nam blandit rutrum diam ut tincidunt.
                </p>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-room" role="tabpanel" aria-labelledby="nav-room-tab">
            <div class="container">
                <div class="title h4 text-center text-uppercase">Rooms</div>
                <div class="row">
                    <?php
                    include_once __DIR__ . '/classes/RoomType.php';
                    $roomTypeObj = new RoomType();
                    $roomTypes = $roomTypeObj->getAll();
                    foreach ($roomTypes as $roomType) :
                        ?>
                        <div class="col-lg-6 my-2">
                            <div class="card">
                                <?php if ($roomType['photo']) : ?>
                                    <img class="card-img-top" src="<?= $roomType['photo'] ?>" style="max-height:200px" alt="Card image cap">
                                <?php else : ?>
                                    <img class="card-img-top" src="images/rooms/room.jpg" style="max-height:200px" alt="Card image cap">

                                <?php endif; ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title font-weight-bold"><i class="fas fa-star"></i> <?= $roomType['name'] ?></h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="card-title font-weight-bold"><i class="fas fa-rupee-sign"></i> <?= $roomType['rate'] ?></h5>
                                        </div>
                                        <div class="col-12"><i class="fas fa-quote-left"></i>
                                            <p class="card-text d-inline"><?= $roomType['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="badge">
                                    <a href="book.php?type-id=<?= $roomType['id'] ?>" class="btn btn-block btn-dark"><i class="fas fa-bed"></i> Book</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="container">
                <div class="title h4 text-center text-uppercase">Contact Us</div>
                <div class="row">
                    <div class="col-lg-6">
                        <dl>
                            <div class="text-uppercase h4">Hotel Reservation System</div>
                            <dd class="pl-3">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="text-dark ml-2">Somewhere,</span>
                                <span class="text-dark ml-4 d-block">Raipur, Chhattisgarh - 492001</span>
                            </dd>
                            <dd class="pl-3">
                                <i class="fas fa-mobile"></i>
                                <a class="text-dark text-decoration-none ml-2" href="#">+91 98765 12345</a>
                            </dd>
                            <dd class="pl-3">
                                <i class="fas fa-at"></i>
                                <a class="text-dark text-decoration-none ml-2" href="#">example@gmail.com</a>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                            <?php
                        if (!empty($errors)) :
                            foreach ($errors as $error) : ?>
                                <script>
                                    $(function() {
                                        $('#nav-contact-tab').addClass('font-weight-bold active');
                                        $('#nav-contact-tab').siblings().removeClass('font-weight-bold active')
                                        $('#nav-contact').addClass('show active').siblings().removeClass('show active');
                                    });
                                </script>
                                <p class="text-center text-danger bg-dark"><?= $error ?></p>
                        <?php endforeach;
                        endif; ?>
                        <form method="POST" action="">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Full Name*</label>
                                        <input type="text" maxlength="150" class="form-control" value="<?= $name ?? "" ?>" name="name" placeholder="Full Name" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" maxlength="70" class="form-control" value="<?= $email ?? "" ?>" name="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile*</label>
                                        <input type="tel" maxlength="13" class="form-control" value="<?= $mobile ?? "" ?>" name="mobile" placeholder="Mobile" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="message">Message* <span id="characters"></span></label>
                                        <textarea name="message" id="message" maxlength="300" class="form-control" rows="2"><?= $message ?? '' ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-warning btn-block btn-sm"><strong><i class="fa fa-paper-plane"></i> Send Message</strong></button>
                                </div>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-dark mt-5">
                <div class="col-lg-12">
                    <div class="text-center mt-5">
                        <a href="" class="text-white mx-3"><i class="follow-icon fab fa-facebook"></i></a>
                        <a href="" class="text-white mx-3"><i class="follow-icon fab fa-linkedin"></i></a>
                        <a href="" class="text-white mx-3"><i class="follow-icon fab fa-twitter-square"></i></a>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-center">
                            <a href="" class="text-decoration-none text-danger">Privacy Policy</a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="" class="text-decoration-none text-danger">Terms of Use</a>
                        </div>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col-lg-4 text-center text-white">&copy; 2019 All rights Reserved</div>
                        <div class="col-lg-4 text-center text-white">Hotel Reservation System</div>
                        <div class="col-lg-4 text-center text-white">Designed by <a class="text-orange text-decoration-none" href="">Homesh</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $(".nav-item").click(function() {
                $(this).addClass('font-weight-bold');
                $(this).siblings().removeClass('font-weight-bold')
            });
            $('.popover-dismiss').popover({
                trigger: 'focus'
            })
            $('#message').keyup(function() {
                var char = $(this).val()
                $('#characters').text('You have ' + (300 - char.length) + ' characters left.');
            });
            $('.toast').toast('show');

            $(".alert-success").delay(2000).slideUp(200, function() {
                $(this).alert('close');
            });

            $('[data-popover="popover"]').popover({
                html: true,
                content: $('#popover-menu').html()
            })
        });
    </script>
</body>

</html>