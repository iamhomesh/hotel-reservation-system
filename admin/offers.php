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
                    <li class="breadcrumb-item"><a href="offers.php">Offers</a></li>
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
                        <strong class="text-uppercase">VIEW OFFERS</strong>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 overflow-auto">
                                <table class="table table-sm data-table">
                                    <thead class="">

                                        <tr>
                                            <th>#</th>
                                            <th>OFFER</th>
                                            <th>FROM</th>
                                            <th>TO</th>
                                            <th>DISCOUNT %</th>
                                            <th>DESCRIPTION</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once __DIR__ . '../../classes/Offer.php';
                                        $offerObj = new Offer();
                                        $offers = $offerObj->getAllOffers();
                                        $count = 0;
                                        foreach ($offers as $offer) :
                                            ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= $offer['name'] ?></td>
                                                <td><?= date('d-M-Y', strtotime($offer['from'])) ?></td>
                                                <td><?= date('d-M-Y', strtotime($offer['to'])) ?></td>
                                                <td><?= $offer['discount'] ?></td>
                                                <td><?= $offer['description'] ?></td>
                                                <td class="text-right"><a href="edit_offer.php?offer=<?= $offer['id'] ?>" class="badge badge-warning">EDIT</a></td>
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