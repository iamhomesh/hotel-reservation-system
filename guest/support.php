<?php

include_once __DIR__ . '../includes/header.php';




include_once __DIR__ . '/../classes/BookingRequest.php';
include_once __DIR__ . '/../classes/BookingHistory.php';
$bookingRequest = new BookingRequest();
$bookingHistory = new BookingHistory();



?>




<div class="container">
    <div class="row m-auto" style="">
        <!--ROW START-->

        <div class="col-lg-12 overflow-auto">

            <div class="card mt-5 mt-lg-5">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="send-tab" data-toggle="tab" href="#send" role="tab" aria-controls="send" aria-selected="true"><strong>Send</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false"><strong>History</strong></a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <!--OPEN (UNREAD SUPPORT MESSAGE TAB)-->
                        <div class="tab-pane fade show active" id="send" role="tabpanel" aria-labelledby="send-tab">

                            <div class="container overflow-auto" style="max-height:350px">

                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <form method="POST" action="">
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="type">Support Type</label>
                                                        <select name="type" class="form-control" required>
                                                            <option value="">Select...</option>
                                                            <option value="">Booking</option>
                                                            <option value="">Rate</option>
                                                            <option value="">Payment</option>
                                                            <option value="">Software</option>
                                                            <option value="">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="picture">Picture</label>
                                                        <input type="file" class="form-control" name="email" placeholder="Email" />

                                                    </div>
                                                </div>


                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="message">Message</label>
                                                        <textarea name="message" id="" class="form-control"><?= $address ?? "" ?></textarea>

                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <button name="submit" class="btn btn-danger btn-block btn-sm">Update</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <table class="table table-hover data-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>TYPE</th>
                                                    <th>MESSAGE</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">

                                                <tr>
                                                    <td>1</td>
                                                    <td>Payment</td>
                                                    <td>SOMEmessage error</td>
                                                    <td>Open</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Payment</td>
                                                    <td>i'm facing payment failure issue</td>
                                                    <td>Solved</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Payment</td>
                                                    <td>i'm facing payment failure issue</td>
                                                    <td>Solved</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Payment</td>
                                                    <td>i'm facing payment failure issue</td>
                                                    <td>Solved</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Payment</td>
                                                    <td>i'm facing payment failure issue</td>
                                                    <td>Solved</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                            <!--CLOSE (READ SUPPORT MESSAGE TAB)-->

                        </div>

                    </div>





                </div>
            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '../includes/footer.php' ?>