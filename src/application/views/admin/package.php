<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

    <div class="container-fluid">

        <div class="text-muted mb-3"><a href="<?= site_url('admin/manage_packages') ?>"><small><i class="fas fa-arrow-left"></i> back to dashboard</small></a></div>

        <h3 class="mb-4"><?= $package[0]['title'] ?> &nbsp;<div class="badge badge-default"><?= $delivery_status_titles[$current_status[0]['status'] - 1]['title'] ?> </div></h3>

        <div class="gutter">
            <div class="row">
                <div class="col-md-3">
                    <div class="bold mb-3">Delivering To</div>
                    <div><?= $delivery_address[0]['deliver_to'] ?></div>
                    <div><?= $delivery_address[0]['address'] ?></div>
                    <div><?= $delivery_address[0]['city'] ?>, <?= $delivery_address[0]['zip_code'] ?></div>
                    <div><?= $delivery_address[0]['province'] ?></div>
                    <div><?= $delivery_address[0]['country'] ?></div>
                </div>
                <div class="col-md-3">
                    <div class="bold mb-3">Details</div>
                    <?= $package[0]['details'] ?>
                </div>
                <div class="col-md-3">
                    <div class="bold mb-3">Weight</div>
                    <?= $package[0]['weight'] ?> lbs

                    <div class="mt-3">
                        <b>Tracking ID:</b> <span id="tracking_id"><?= $package[0]['tracking_id'] ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bold mb-3">Actions</div>
                    <?php
                        if($delivery_status[0]['status'] == 1) {
                            echo '<button class="btn btn-success" id="dispatch">Dispatch Package</button>';
                        } else if($delivery_status[0]['status'] == 2) {
                            echo '<button class="btn btn-success" id="in_transit">In Transit</button>';
                        } else if($delivery_status[0]['status'] == 3) {
                            echo '<button class="btn btn-success" id="delivered">Delivered</button>';
                        } else if($delivery_status[0]['status'] == 4) {
                            echo '<button class="btn btn-success" disabled>Delivered</button>';
                        }
                    ?>
                </div>
            </div>

            <div class="spacer-30"></div>

            <div class="bold mb-4">Updates</div>

            <?php
                $count = 1; 
                foreach($delivery_status as $ds) { 
            ?>
                <div class="flex">
                    <div class="p-4">
                        <?php if($count == 1 && $current_status[0]['status'] != 4){ $count++; ?>
                            <h3><i class="fas fa-circle-notch"></i></h3>
                        <?php } else { $count++; ?>
                            <h3><i class="fas fa-circle text-success"></i></h3>
                        <?php } ?>
                    </div>
                    <div class="box full-width">
                        <div class="flex align-items-center">
                            <div class="flex-1"><h4><?= $delivery_status_titles[$ds['status'] - 1]['title'] ?></h4></div>
                            <div class="flex-1"><?= date('F j, Y | h:m a', strtotime($ds['d_date'])) ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </div>

</div>

<div class="spacer-50"></div>