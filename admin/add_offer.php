<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';

$name = $from = $to = $discount = $description = "";
$errors = [];
$success = "";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    if (empty($name)) $errors[] = 'Please enter offer name.';
    if (empty($from)) $errors[] = 'Please select from date.';
    if (empty($to)) $errors[] = 'Please select to date.';
    if (empty($discount)) $errors[] = 'Please enter discount.';
    if ($discount < 0 || $discount > 100) $errors[] = 'Discount must be between 0 to 100.';
    if (strlen($description) > 300) $errors[] = "Desciption must not be more than 300 characters";

    if (empty($errors)) {
        require_once __DIR__ . '../../classes/Offer.php';
        $offerObj = new Offer();
        $fields = [
            'name' => $name,
            'from' => $from,
            'to' => $to,
            'discount' => $discount,
            'description' => $description
        ];
        $added = $offerObj->add($fields);
        if ($added) {
            $success = "Offer added successfully";
            $name = $from = $to = $discount = $description = "";
        }
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="offers.php">Offers</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="add_offer.php">Add</a></li>
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
                        <strong class="text-uppercase">ADD OFFER</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <span id="user-error" class="badge badge-danger"></span>
                        </div>
                        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" maxlength="150" class="form-control" value="<?= $name ?>" name="name" placeholder="Offer Name" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="discount">Discount*</label>
                                        <input type="number" class="form-control" value="<?= $discount ?>" name="discount" placeholder="Discount %" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="from">From*</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="from" value="<?= $from ?>" name="from" placeholder="YYYY-MM-DD" readonly />
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-light from"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="to">To</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="to" value="<?= $to ?>" name="to" placeholder="YYYY-MM-DD" readonly />
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-light to"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" maxlength="300" class="form-control" rows="2"><?= $description ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button name="submit" class="btn btn-info btn-block btn-sm">Add</button>
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