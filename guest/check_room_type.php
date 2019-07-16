<?php
include_once __DIR__ . '../../classes/RoomType.php';

$room_type_id = $_GET['room-type'];

$room = new RoomType();

$row = $room->fetchDesciption($room_type_id);
if (!empty($row)) : ?>
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <p class="text-center font-weight-bold">Desciption</p>
            </div>
            <div class="col-4">
                <p class="text-right font-weight-bold">Price</p>
            </div>
        </div>
        <div class="row overflow-auto" style="max-height:140px">
            <div class="col-8">

                <div class="overflow-auto" style="max-height:80px">
                    <p class="text-dark"><?= $row[0] ?></p>
                </div>
            </div>
            <div class="col-4">

                <p class="text-success text-right"><?= $row[1] ?></p>

            </div>
        </div>

    </div>

<?php endif; ?>