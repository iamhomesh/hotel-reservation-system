<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['solve-id'])) {
        $sloved = $supportObj->solved($_POST['solve-id']);
        if ($sloved) {
            $success = "Support solved successfully.";
        }
    }
    if (isset($_POST['read-id'])) {
        $read = $supportObj->read($_POST['read-id']);
        if ($read) {
            $success = "Support marked as read successfully.";
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
                    <li class="breadcrumb-item active" aria-current="page"><a href="supports.php">Supports</a></li>
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
            <?php endif;?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-secondary active" id="unread-tab" data-toggle="tab" href="#unread" role="tab" aria-controls="unread" aria-selected="true"><strong>UNREAD</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" id="read-tab" data-toggle="tab" href="#read" role="tab" aria-controls="read" aria-selected="false"><strong>READ</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" id="solved-tab" data-toggle="tab" href="#solved" role="tab" aria-controls="solved" aria-selected="false"><strong>SOLVED</strong></a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--OPEN (UNREAD SUPPORT MESSAGE TAB)-->
                            <div class="tab-pane fade show active" id="unread" role="tabpanel" aria-labelledby="unread-tab">

                                <table class="table table-sm data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>MESSAGE</th>
                                            <th>DATE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        <?php
                                        $count = 0;
                                        $supports = $supportObj->getAllUnread();
                                        foreach ($supports as $support) : ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $guestObj->getName($support['guest_id']) ?></td>
                                                <td><?= $support['message'] ?></td>
                                                <td><?= date('d M Y', strtotime($support['created_at'])); ?></td>
                                                <td>
                                                    <a href="view_support.php?gsid=<?= $support['id'] ?>" class="badge badge-info border-0 view-btn"><i class="fas fa-eye"></i></a>
                                                    <button class="badge badge-success border-0 read" data-id="<?= $support['id'] ?>" data-tooltip="tooltip" data-placement="top" title="Mark as read"><i class="fab fa-readme"></i></button>
                                                    <button class="badge badge-danger border-0 solve" data-id="<?= $support['id'] ?>" data-toggle="modal" data-target="#confirmModalCenter" data-tooltip="tooltip" data-placement="top" title="Mark as solved"><i class="fas fa-check"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <!--CLOSE (UNREAD SUPPORT MESSAGE TAB)-->

                            <!--OPEN (READ SUPPORT MESSAGE TAB)-->
                            <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                                <div class="container">
                                    <table class="table table-sm data-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAME</th>
                                                <th>MESSAGE</th>
                                                <th>DATE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $supports = $supportObj->getAllRead();
                                            foreach ($supports as $support) : ?>
                                                <tr>
                                                    <td><?= ++$count ?></td>
                                                    <td><?= $guestObj->getName($support['guest_id']) ?></td>
                                                    <td><?= $support['message'] ?></td>
                                                    <td><?= date('d M Y', strtotime($support['created_at'])); ?></td>
                                                    <td>
                                                        <a href="view_support.php?gsid=<?= $support['id'] ?>" class="badge badge-info"><i class="fas fa-eye"></i></a>
                                                        <button class="badge badge-danger border-0 solve" data-id="<?= $support['id'] ?>" data-toggle="modal" data-target="#confirmModalCenter" data-tooltip="tooltip" data-placement="top" title="Mark as solved"><i class="fas fa-check"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--CLOSE (READ SUPPORT MESSAGE TAB)-->
                            <!--OPEN (CLOSED SUPPORT MESSAGE TAB)-->
                            <div class="tab-pane fade" id="solved" role="tabpanel" aria-labelledby="solved-tab">
                                <div class="container">
                                    <table class="table table-sm data-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAME</th>
                                                <th>MESSAGE</th>
                                                <th>DATE</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $supports = $supportObj->getAllSolved();
                                            foreach ($supports as $support) : ?>
                                                <tr>
                                                    <td><?= ++$count ?></td>
                                                    <td><?= $guestObj->getName($support['guest_id']) ?></td>
                                                    <td><?= $support['message'] ?></td>
                                                    <td><?= date('d M Y', strtotime($support['created_at'])) ?></td>
                                                    <td>
                                                        <a href="view_support.php?gsid=<?= $support['id'] ?>" class="badge badge-info border-0 view-btn"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!--CLOSE (CLOSED SUPPORT MESSAGE TAB)-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
<form action="" method="post" id="read-form">
    <input type="hidden" name="read-id" id="read-id">
</form>

<!-- Modal -->
<div class="modal fade" id="confirmModalCenter" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalCenterTitle">Confirm!</h5>
            </div>
            <div class="modal-body">
                Are you sure want to mark this as solved?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> No</button>
                <form action="" method="post" id="solve-form">
                    <input type="hidden" name="solve-id" id="solve-id">
                    <button name="solve" class="btn btn-sm btn-danger"><i class="far fa-check-circle"></i> Yes</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>