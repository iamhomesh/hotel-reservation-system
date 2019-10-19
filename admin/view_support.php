<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
$errors = [];
$success = $comment = "";
if (isset($_POST['submit'])) {
    if (strlen($_POST['comment']) > 300) $errors[] = "Comment must not exceed length of 300 characters";
    if (empty($errors)) {
        $fields = [];
        if (isset($_POST['solved'])) {
            $fields = [
                'comment' => $_POST['comment'],
                'status' => $_POST['solved']
            ];
            $solved = $supportObj->update($_POST['id'], $fields);
            if ($solved) {
                $success = "Support solved successfully";
            }
        } else {
            $fields = [
                'comment' => $_POST['comment'],
                'status' => 'Read'
            ];
            $updated = $supportObj->update($_POST['id'], $fields);
            if ($updated) {
                $success = "Support updated successfully";
            }
        }
    }
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="supports.php">Supports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content mb-5">
    <!-- Animated -->
    <div class="animated fadeIn">
        <?php if (!empty($success)) : ?>
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
        <?php endforeach; endif; ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>GUEST SUPPORT</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['gsid'])) :
                            require_once __DIR__ . '../../classes/SupportType.php';
                            $supportTypeObj = new SupportType();
                            $support = $supportObj->getGuestSupport($_GET['gsid']);
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <span class="badge text-uppercase"><?= $guestObj->getName($support['guest_id']) ?></span>
                                        <span class="badge"><?= date('d M Y h:i:s', strtotime($support['created_at'])) ?></span>
                                        <span class="badge badge-dark"><?= $support['ticket'] ?></span>
                                        <span class="badge badge-secondary text-uppercase"><?= $supportTypeObj->getTypeName($support['type_id'])  ?></span>
                                        <?php if ($support['status'] == 'Unread') : ?>
                                            <span class="badge badge-danger text-uppercase"><?= $support['status'] ?></span>
                                        <?php elseif ($support['status'] == 'Read') : ?>
                                            <span class="badge badge-warning text-uppercase"><?= $support['status'] ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-success text-uppercase"><?= $support['status'] ?></span>
                                        <?php endif; ?>
                                        <?php
                                            if ($support['screenshot']) : ?>
                                            <a href="" class="badge badge-warning" data-toggle="modal" data-target="#screenshot-modal">VIEW SCREENSHOT</a>
                                            <div class="modal fade" id="screenshot-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                                                    <div class="modal-content" style="max-width: 200px">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <a href="<?= '../'. $support['screenshot'] ?>" target="__blank"><img src="<?= '../' . $support['screenshot'] ?>" alt="screenshot" style="max-height: 100%; max-width: 100%"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <p class="font-weight-bold text-dark">Message</p>
                                <p class="text-justify"><?= $support['message'] ?></p>
                            </div>
                            <div class="col-lg-12">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?= $support['id']; ?>">
                                        <label for="comment" class="font-weight-bold">Comment</label>
                                        <?php if ($support['status'] != 'Solved') : ?>
                                            <div class="custom-control custom-checkbox float-right">
                                                <input type="checkbox" name="solved" value="solved" class="custom-control-input" id="solved">
                                                <label class="custom-control-label" for="solved">Solved</label>
                                            </div>
                                            <textarea name="comment" maxlength="300" rows="2" class="form-control"><?= $support['comment'] ?></textarea>
                                    </div>
                                    <button name="submit" class="btn btn-danger btn-block">UPDATE</button>
                                <?php else : ?>
                                    <p class="text-justify"><?= $support['comment'] ?></p>
                            </div>
                        <?php endif; ?>
                        </form>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .animated -->
</div>
<!-- /.content -->
<?php include_once __DIR__ . '/includes/footer.php'; ?>