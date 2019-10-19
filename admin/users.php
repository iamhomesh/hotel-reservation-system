<?php
include_once __DIR__ . '/includes/head.php';
if (!$isAdmin) header('location:index.php');
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="users.php">Users</a></li>
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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <strong class="text-uppercase">VIEW USERS</strong>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">

                                        <tr>
                                            <th>#</th>
                                            <th>USERNAME</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>MOBILE</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $users = $userObj->getAllUsers();
                                        $count = 0;
                                        foreach ($users as $user) :
                                            ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $user['username'] ?></td>
                                                <td><?= $user['name'] ?></td>
                                                <td><?= $user['mobile'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td class="text-right"><a href="edit_user.php?user=<?= $user['id'] ?>" class="badge badge-warning">EDIT</a></td>
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
<?php
include_once __DIR__ . '/includes/footer.php';
?>