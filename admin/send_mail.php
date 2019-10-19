<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$email = $subject = $text = "";

$errors = [];
$success = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];

    if (empty($email)) $errors[] = 'Please enter email address.';
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter valid email address';
    if (empty($subject)) $errors[] = 'Please enter subject.';
    if (empty($text)) $errors[] = 'Please enter mal text.';
    if (strlen($text) > 300) $errors[] = "Desciption must not be more than 300 characters";

    if (empty($errors)) {
        if(mail($email, $subject, $text, 'From: homver30@gmail.com')){
            $success = "Mail has been sent successfully";
            $email = $subject = $text = "";
        }else{
            $errors[] = "Mail did not send.";
        }
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item">Mails</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="send_mail.php">Send Mail</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <!-- Animated -->
    <div class="animated fadeIn">
        <?php
        if (!empty($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?= $success ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif;
            if (!empty($errors)) :
                foreach ($errors as $error) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            endforeach;
        endif;
        ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong class="text-uppercase">SEND MAIL</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <span id="user-error" class="badge badge-danger"></span>
                        </div>
                        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="text" class="form-control" value="<?= $email ?>" name="email" placeholder="Email Addreess" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" value="<?= $subject ?>" name="subject" placeholder="Subject" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="text">Mail Text</label>
                                        <textarea name="text" maxlength="10" class="form-control" rows="2"><?= $text ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button name="submit" class="btn btn-success btn-block btn-sm">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
<?php include_once __DIR__ . '/includes/footer.php'; ?>

<script>


</script>