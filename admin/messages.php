<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item">Mails</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="messages.php">Messages</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content mb-5">
    <!-- Animated -->
    <div class="animated fadeIn">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong class="text-uppercase">Messages</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>MOBILE</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $messages = $messageObj->getAll();
                                        $count = 0;
                                        foreach ($messages as $message) : ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $message['name'] ?></td>
                                                <td><?= $message['email'] ?></td>
                                                <td><?= $message['mobile'] ?></td>
                                                <td class="text-right">
                                                    <div title="<?= $message['message'] ?>" class="badge badge-dark" data-tooltip="tooltip" data-placement="top">VIEW</div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->

<?php include_once __DIR__ . '/includes/footer.php'; ?>