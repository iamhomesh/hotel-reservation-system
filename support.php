<?php
include_once __DIR__ . '/includes/header.php';
$support_type = $screenshot = $message = "";
$errors = array();
$support = array();
$support_view = [];
if (isset($_POST['view'])) :
    $ticket = $_POST['ticket'];
    $support_view = $supportObj->getByTicket($ticket); ?>
    <script>
        $().ready(function() {
            $(".card-header li .active").removeClass('bg-dark text-light active');
            $('#view-tab').addClass('bg-dark text-light active');
            $('#nav-view').addClass('show active').siblings().removeClass('show active');
        });
    </script>
<?php endif;

if (isset($_POST['submit'])) {
    $support_type = $_POST['support-type'];
    $message = $_POST['message'];
    if (empty($support_type)) $errors[] = "Please select support type.";
    if (empty($message)) $errors[] = "Please enter message.";
    if (!empty($message)) {
        if (strlen($message) < 10) $errors[] = "Message must have at least 10 characters.";
        if (strlen($message) > 300) $errors[] = "Message must not exceed 300 characters.";
    }
    if (empty($errors)) {
        if (!$_FILES['screenshot']['name']) {
            $fields = [
                'guest_id' => $loggedGuestId,
                'type_id' => $support_type,
                'message' => $message,
                'screenshot' => $screenshot
            ];
            $insert = $supportObj->insert($fields);
            $support_type = $screenshot = $message = "";
            if ($insert) {
                toast('success', 'Message sent successfully');
            }
        } else {
            $temp_name = $_FILES['screenshot']['tmp_name'];
            $extension = $supportObj->getExtension($_FILES, "screenshot");
            if (!$extension) {
                $errors[] = "Only image file allowed";
            } else {
                $screenshot = 'images/support/' . str_replace(' ', '_', strtoupper($guestObj->getName($loggedGuestId)))  . '_' . date("Ymd_His") . ".$extension";
                move_uploaded_file($temp_name, __DIR__ . "/$screenshot");
                $fields = array(
                    'guest_id' => $loggedGuestId,
                    'type_id' => $support_type,
                    'message' => $message,
                    'screenshot' => $screenshot
                );
                $insert = $supportObj->insert($fields);
                $support_type = $screenshot = $message = "";
                if ($insert) {
                    toast('success', 'Message sent successfully');
                }
            }
        }
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
                            <a class="nav-link text-secondary active" id="form-tab" data-toggle="tab" href="#nav-form" role="tab" aria-controls="form" aria-selected="true"><strong>FORM</strong></a>
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
                        <div class="tab-pane fade show active" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab">
                            <div class="row">

                                <div class="col-12">
                                    <?php if (!empty($errors)) :
                                        foreach ($errors as $error) : ?>
                                            <p class="text-danger bg-dark text-center"><?= $error ?><p>
                                            <?php endforeach;
                                            endif; ?>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="support-type">Support Type</label>
                                                            <select name="support-type" class="custom-select">
                                                                <?php
                                                                include_once __DIR__ . '/classes/SupportType.php';
                                                                $supportTypeObj = new SupportType();
                                                                $supportTypes = $supportTypeObj->getAllType();
                                                                ?>
                                                                <option value="">Select Type</option>

                                                                <?php foreach ($supportTypes as $supportType) :
                                                                    if ($supportType['id'] == $support_type) : ?>
                                                                        <option value="<?= $supportType['id'] ?>" class="text-danger" selected><?= $supportType['name'] ?></option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $supportType['id'] ?>"><?= $supportType['name'] ?></option>
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
                                                        <button name="submit" class="btn btn-dark btn-block btn-sm">SEND</button>
                                                    </div>
                                                </div>
                                            </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
                            <div class="row">
                                <div class="col-12">
                                    <?php $supports = $supportObj->getByGuestId($loggedGuestId);
                                    if (empty($supports)) : ?>
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
                                                    foreach ($supports as $support) : ?>
                                                    <tr>
                                                        <td><?= $count++ ?></td>
                                                        <td><?= $support['ticket'] ?></td>
                                                        <td><?= $supportTypeObj->getTypeName($support['type_id']) ?></td>
                                                        <td><span class="d-inline-block text-truncate" style="max-width:300px"><?= $support['message'] ?></span></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="ticket" value="<?= $support['ticket'] ?>">
                                                                <button class="badge badge-dark border-0" name="view">VIEW</button>
                                                            </form>
                                                        </td>
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
                                        <p class="badge badge-dark text-uppercase"><?= $supportTypeObj->getTypeName($support_view['type_id']) ?></p>
                                        <p class="badge badge-success text-uppercase"><?= $support_view['status'] == 'Solved' ? "solved" : "" ?></p>
                                        <?php
                                            if ($support_view['screenshot']) : ?>
                                            <a href="" class="badge badge-warning" data-toggle="modal" data-target="#screenshot-modal">VIEW SCREENSHOT</a>
                                            <div class="modal fade" id="screenshot-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                                                    <div class="modal-content" style="max-width: 200px">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <a href=""><img src="<?= ltrim($support_view['screenshot'], '/') ?>" alt="screenshot" style="max-height: 100%; max-width: 100%"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
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

<?php include_once __DIR__ . '../includes/footer.php'; ?>