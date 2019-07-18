<?php
include_once __DIR__ . '../includes/header.php';
$support_type = $screenshot = $message = "";
$errors = array();
$support_view = array();
if (isset($_GET['ticket'])) : ?>
    <script>
        $().ready(function() {
            $(".card-header li .active").removeClass('bg-dark text-light active');
            $('#view-tab').addClass('bg-dark text-light active');
            $('#nav-view').addClass('show active').siblings().removeClass('show active');
        });
    </script>
    <?php
    $ticket = $_GET['ticket'];
    $support_view = $guestSupport->fetchByTicket($ticket);
endif;
if (isset($_POST['submit'])) {
    $support_type = $_POST['support-type'];
    $message = $_POST['message'];
    if (empty($support_type)) $errors[] = "Please select support type.";
    if (empty($message)) $errors[] = "Please type message.";
    if (strlen($message) < 15 || strlen($message) > 300) $errors[] = "Message must have between 15 and 300 characters";

    if (empty($errors)) {
        if (!$_FILES['screenshot']['name']) {
            $fields = array(
                'guest_id' => $guest_id,
                'type_id' => $support_type,
                'message' => $message,
                'screenshot' => $screenshot
            );
            $insert = $guestSupport->insert($fields);
            $support_type = $screenshot = $message = "";
            if ($insert) : ?>
                <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="width:500px">
                        <div class="toast-header">
                            <i class="fas fa-check text-success"></i>&nbsp;
                            <strong class="mr-auto text-success">Success</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Data inserted successfully.
                        </div>
                    </div>
                </div>
                <script>
                    $().ready(function() {
                        $('.toast').toast('show');
                    })
                    $().ready(function() {
                        $(".card-header li .active").removeClass('bg-dark text-light active');
                        $('#history-tab').addClass('bg-dark text-light active');
                        $('#nav-history').addClass('show active').siblings().removeClass('show active');
                    });
                </script>
            <?php endif;
        } else {
            $temp_name = $_FILES['screenshot']['tmp_name'];
            $extension = $guestSupport->getExtension($_FILES, "screenshot");
            if (!$extension) : ?>
                <script>
                    alert("Only image file allowed");
                </script>
            <?php else :
                $screenshot = __DIR__ . "/support_screenshots/" . $guest->getEmail($guest_id) . '_' . date("Ymd-His") . ".$extension";
                echo $screenshot;
                move_uploaded_file($temp_name, $screenshot);
                $fields = array(
                    'guest_id' => $guest_id,
                    'type_id' => $support_type,
                    'message' => $message,
                    'screenshot' => $screenshot
                );
                $insert = $guestSupport->insert($fields);
                $support_type = $screenshot = $message = "";
                if ($insert) : ?>
                    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="width:500px">
                            <div class="toast-header">
                                <i class="fas fa-check text-success"></i>&nbsp;
                                <strong class="mr-auto text-success">Success</strong>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                Data inserted successfully.
                            </div>
                        </div>
                    </div>
                    <script>
                        $().ready(function() {
                            $('.toast').toast('show');
                        })
                        $().ready(function() {
                            $(".card-header li .active").removeClass('bg-dark text-light active');
                            $('#history-tab').addClass('bg-dark text-light active');
                            $('#nav-history').addClass('show active').siblings().removeClass('show active');
                        });
                    </script>
                <?php endif;
            endif;
        }
    } else { ?>

        <script>
            $().ready(function() {
                $('.toast').toast('show');
            })
        </script>
        <?php foreach ($errors as $error) : ?>
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="width:500px">
                    <div class="toast-header">
                        <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;
                        <strong class="mr-auto text-danger">Error</strong>
                        <button type="button" class="ml-2 mb-1 close text-danger" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <?= $error ?>
                    </div>
                </div>
            </div>
        <?php endforeach;
    }
}
?>
<div class="container">




    <div class="row m-auto">
        <div class="col-lg-12">
            <div class="card mt-3 mt-lg-5" style="max-height: 410px">
                <div class="card-header text-center bg-white badge">
                    <script>
                        $().ready(function() {
                            $('.card-header li .active').addClass('bg-dark text-light');
                            $(".card-header li").click(function() {
                                $(this).siblings().children().removeClass('bg-dark text-light');
                                $(this).children().addClass('bg-dark text-light');

                            });
                        });
                    </script>
                    <ul class="nav nav-fill" id="test">
                        <li class="nav-item">
                            <a class="nav-link text-secondary active" id="request-tab" data-toggle="tab" href="#nav-request" role="tab" aria-controls="request" aria-selected="true"><strong>REQUEST</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" id="history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="history" aria-selected="false"><strong>HISTORY</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" id="view-tab" data-toggle="tab" href="#nav-view" role="tab" aria-controls="view" aria-selected="false"><strong>VIEW</strong></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body overflow-auto">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-request" role="tabpanel" aria-labelledby="nav-request-tab">
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="support-type">Support Type</label>
                                                    <select name="support-type" class="custom-select">
                                                        <?php
                                                        include_once __DIR__ . '../../classes/SupportType.php';
                                                        $supportType = new SupportType();
                                                        $rows = $supportType->getAllType();
                                                        ?>
                                                        <option value="">Select Type</option>

                                                        <?php foreach ($rows as $row) :
                                                            if ($row['type_id'] == $support_type) : ?>
                                                                <option value="<?= $row['type_id'] ?>" class="text-danger" selected><?= $row['type_name'] ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $row['type_id'] ?>"><?= $row['type_name'] ?></option>
                                                            <?php endif;
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-lg-6">
                                                <label for="screenshot">Screenshot(Optional)</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="screenshot">
                                                        <label class="custom-file-label" for="screenshot">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="message">Message</label>
                                                    <textarea name="message" id="" class="form-control"><?= $message ?? "" ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button name="submit" class="btn btn-dark btn-block btn-sm">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
                            <div class="row">
                                <div class="col-12">
                                    <?php $rows = $guestSupport->fetchById($guest_id);
                                    if (empty($rows)) : ?>
                                        <div class="text-center">
                                            <span class="font-italic">Your support history will be shown here.</span>
                                        </div>
                                    <?php else : ?>
                                        <table class="table table-sm table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>TICKET</th>
                                                    <th>TYPE</th>
                                                    <th>MESSAGE</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">
                                                <?php $count = 1;
                                                foreach ($rows as $row) : ?>
                                                    <tr>
                                                        <td><?= $count++ ?></td>
                                                        <td><?= $row['ticket'] ?></td>
                                                        <td><?= $supportType->getTypeName($row['type_id']) ?></td>
                                                        <td><span class="d-inline-block text-truncate" style="max-width:300px"><?= $row['message'] ?></span></td>
                                                        <td><a href="<?= "?ticket=" . $row['ticket'] ?>" class="badge badge-dark">VIEW</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if ($support_view) : ?>
                            <div class="tab-pane fade" id="nav-view" role="tabpanel" aria-labelledby="nav-view-tab">
                                <div class="row overflow-auto">
                                    <div class="col-12 col-sm-12 col-lg-12 text-center">
                                        <p class="text-right badge"><?= $support_view['created_at'] ?></p>
                                        <p class="badge badge-secondary"><?= $support_view['ticket'] ?></p>
                                        <p class="badge badge-dark text-uppercase"><?= $supportType->getTypeName($support_view['type_id']) ?></p>
                                        <p class="text-right badge badge-danger text-uppercase"><?= $support_view['status'] ?></p>
                                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#screenshot-modal">VIEW SCREENSHOT</a>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for=""><strong>MESSAGE: </strong></label>
                                        <p><?= $support_view['message'] ?></p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for=""><strong>COMMENT: </strong></label>
                                        <p><?= $support_view['comment'] ?? "NO COMMENTS" ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="tab-pane fade" id="nav-view" role="tabpanel" aria-labelledby="nav-view-tab">
                                <div class="text-center">
                                    <span class="font-italic">Select ticket from history to view details</span>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="screenshot-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content" style="max-width: 200px">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <?= $support_view['screenshot'] ?>
                        <a href=""><img src="<?= $support_view['screenshot'] ?>" alt="screenshot" style="max-height: 100%; max-width: 100%"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once __DIR__ . '../includes/footer.php'; ?>