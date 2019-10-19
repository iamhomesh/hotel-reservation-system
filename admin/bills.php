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
                    <li class="breadcrumb-item" aria-current="page"><a href="bills.php">Bills</a></li>
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
                        <strong>BILLS</strong>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="reservations" role="tabpanel" aria-labelledby="reservations-tab">
                                <div class="row">
                                    <div class="col-12 overflow-auto">
                                        <table class="table table-sm data-table">
                                            <thead class="">
                                                <tr>
                                                    <th>#</th>
                                                    <th>BILL #</th>
                                                    <th>DATE</th>
                                                    <th>AMOUNT</th>
                                                    <th>PAID</th>
                                                    <th>DUE</th>
                                                    <th class="text-right">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once __DIR__ . '../../classes/Bill.php';
                                                $billObj = new Bill();
                                                $bills = $billObj->getAll();
                                                $count = 0;
                                                foreach ($bills as $bill) :
                                                    ?>
                                                    <tr>
                                                        <td><?= ++$count ?></td>
                                                        <td><?= $bill['bill_no'] ?></td>
                                                        <td><?= $bill['created_at'] ?></td>
                                                        <td><?= $bill['amount'] ?></td>
                                                        <td><?= $bill['paid'] ?></td>
                                                        <td><?= $bill['due'] ?></td>
                                                        <td class="text-right">
                                                            <a href="print_bill.php?bill=<?= $bill['id'] ?>" target="__blank" class="badge badge-success" data-tooltip="tooltip" data-placement="top" title="Print bill"><i class="fas fa-print"></i></a>
                                                            <a href="edit_bill.php?bill=<?= $bill['id'] ?>" class="badge badge-warning" data-tooltip="tooltip" data-placement="top" title="Edit bill"><i class="fas fa-pen"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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