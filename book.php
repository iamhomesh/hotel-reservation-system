<?php
include_once __DIR__ . '/includes/header.php';
$adults = $children = $check_in = $check_out = $room_type = "";
if (isset($_GET['type-id'])) {
    $room_type = $_GET['type-id'];
}
$errors = array();
if (isset($_POST['submit'])) {
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $room_type = $_POST['room-type'];
    $check_in = $_POST['check-in'];
    $check_out = $_POST['check-out'];

    if (empty($room_type)) $errors[] = "Please select room type";
    if (empty($adults)) $errors[] = "Enter number of adult guests";
    if (empty($check_in)) $errors[] = "Please select check-in date";
    if (empty($check_out)) $errors[] = "Please select check-out date";

    if (empty($errors)) {
        $fields = array(
            'guest_id' => $loggedGuestId,
            'adults' => $adults,
            'children' => $children,
            'room_type_id' => $room_type,
            'check_in' => $check_in,
            'check_out' => $check_out
        );
        $booked = $reservaionObj->create($fields);
        if ($booked) {
            header('refresh: 3; url= bookings.php');
            toast('success', 'Reservation was successful.');
        }
    }
}

?>
<div class="container mb-5">
    <div class="row m-auto">
        <div class="col-lg-12">
            <div class="card mt-3 mb-5">
                <div class="card-header text-center bg-white">
                    <span class="d-block font-weight-bold text-uppercase">Reservation Form</span>
                </div>
                <div class="card-body card-block">
                    <?php
                    if (!empty($errors)) :
                        foreach ($errors as $error) : ?>
                            <p class="bg-dark text-danger text-center"><?= $error ?> </p>
                    <?php
                        endforeach;
                    endif;
                    ?>
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="room-type">Room Type</label>
                                    <select name="room-type" id="room-type" class="custom-select">
                                        <?php
                                        $roomTypes = $roomTypeObj->getAll(); ?>
                                        <option value="">Select Type</option>
                                        <?php foreach ($roomTypes as $roomType) :
                                            if ($roomType['id'] == $room_type) : ?>
                                                <option value="<?= $roomType['id'] ?>" selected><?= $roomType['name'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $roomType['id'] ?>"><?= $roomType['name'] ?></option>
                                        <?php endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="form-group">
                                    <label for="adults">Adults</label>
                                    <input type="number" class="form-control" value="<?= $adults ?? "" ?>" name="adults" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="form-group">
                                    <label for="children">Children</label>
                                    <input type="number" class="form-control" value="<?= $children ?? "" ?>" name="children" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="check-in">Check-In</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="check-in" value="<?= $check_in; ?>" name="check-in" placeholder="YYYY-MM-DD" readonly />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-light check-in-btn"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="check-out">Check-Out</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="check-out" value="<?= $check_out; ?>" name="check-out" placeholder="YYYY-MM-DD" readonly />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-light check-out-btn"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1" id="room-desc">
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <button id="submit" name="submit" class="btn btn-dark btn-block btn-sm">BOOK</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $().ready(function() {
        var typeId = $('#room-type').val();
        if (typeId) {
            $.get('check_room_type.php?room-type=' + typeId, function(data) {
                $('#room-desc').html(data);
            });
        }
    });
    $('#room-type').change(function() {
        var id = $(this).val();
        $.get('check_room_type.php?room-type=' + id, function(data) {
            $('#room-desc').html(data);
        });
    });
    $('.check-in-btn').click(function() {
        $('#check-in').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            weeks: true,
            minDate: 0
        });
        $('#check-in').datetimepicker('show');
    });
    $('.check-out-btn').click(function() {
        $('#check-out').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            weeks: true,
            onShow: function(ct) {
                this.setOptions({
                    minDate: $('#check-in').val() || false
                })
            }
        });
        $('#check-out').datetimepicker('show');
    });
</script>
<?php include_once __DIR__ . '/includes/footer.php' ?>