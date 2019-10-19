<?php
include_once __DIR__ . '/includes/head.php';
include_once __DIR__ . '/includes/left_panel.php';
include_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '../../classes/Bill.php';
$billObj = new Bill();
require_once __DIR__ . '../../classes/Booking.php';
$bookingObj = new Booking();
$bill_id = $bill_no = $booking_id = $guest_name = $payment_mode = $amount = $paid = $due = $notes = "";

if (isset($_POST['submit'])) {
    $payment_mode_id = $_POST['payment_mode'];
    $amount = $_POST['amount'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $notes = $_POST['notes'];

    if (empty($payment_mode_id)) $errors[] = 'Please select payment mode.';
    if ($paid < 0) $errors[] = 'Paid amount must not be less than 0.';
    if ($due < 0) $errors[] = 'Due amount must not be less tahn 0.';
    if (strlen($notes) > 300) $errors[] = 'Length of notes must not exceed 300 characters.';
    
    if (empty($errors)) {
        $fields = [
            'payment_mode_id' => $payment_mode_id,
            'amount' => $amount,
            'paid' => $paid,
            'due' => $due,
            'notes' => $notes
        ];
        $updated = $billObj->update($_POST['bill_id'], $fields);
        if ($updated) {
            $success = "Bill updated successfully.";
        }
    }
}

if (isset($_GET['bill'])) {
    $bill_id = $_GET['bill'];
    $bill = $billObj->getBill($bill_id);
    $bill_no = $bill['bill_no'];
    $payment_mode = $bill['payment_mode_id'];
    $amount = $bill['amount'];
    $paid = $bill['paid'];
    $due = $bill['due'];
    $notes = $bill['notes'];
    $booking_id = $bill['booking_id'];
    $booking = $bookingObj->getBooking($booking_id);

    $guest_name = $guestObj->getName($booking['guest_id']);
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="page-header">
            <div class="page-title float-right">
                <ol class="breadcrumb text-right">
                    <li class="breadcrumb-item"><a href="bills.php">Bills</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <strong class="text-uppercase">Billing form</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <span class="badge badge-danger text-center" id="error"></span>
                        </div>

                        <form method="POST" action="">
                            <div class="form-row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="Bill">Bill</label>
                                        <input type="hidden" value="<?= $bill_id ?>" name="bill_id">
                                        <input type="text" class="form-control stt" value="<?= $bill_no ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="booking">Booking</label>
                                        <input type="text" class="form-control" value="<?= $booking_id . ' - ' . $guest_name ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="payment-mode">Payment Mode</label>
                                        <select name="payment_mode" class="custom-select">
                                            <option value="">Select Payment Mode</option>
                                            <?php
                                            include_once __DIR__ . '../../classes/PaymentMode.php';
                                            $paymentModeObj = new PaymentMode();
                                            $paymentModes = $paymentModeObj->getAllPaymentModes();
                                            foreach ($paymentModes as $paymentMode) :
                                                if ($paymentMode['id'] == $payment_mode) :
                                                    ?>
                                                    <option value="<?= $paymentMode['id'] ?>" selected><?= $paymentMode['name'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $paymentMode['id'] ?>"><?= $paymentMode['name'] ?></option>
                                            <?php endif;
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="edit-amount" value="<?= $amount ?>" name="amount" placeholder="Amount" readonly />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="check-paid">Paid</label>
                                        <div class="custom-control custom-checkbox d-inline">
                                            <input type="checkbox" class="custom-control-input" id="edit-check-paid">
                                            <label class="custom-control-label" for="edit-check-paid"></label>
                                        </div>
                                        <input type="text" class="form-control" id="edit-paid" value="<?= $paid ?>" name="paid" placeholder="Paid" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="due">Due</label>
                                        <input type="text" class="form-control" id="edit-due" value="<?= $due ?>" name="due" placeholder="Due" readonly />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea name="notes" maxlength="300" class="form-control" rows="2"><?= $notes ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button name="submit" class="btn btn-danger btn-block btn-sm">Save</button>
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