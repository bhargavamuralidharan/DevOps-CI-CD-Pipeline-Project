<div class="page-content">

    <div class="container-fluid">
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
                </div>
                <div class="col-md-3">
                    <div class="bold mb-3">Actions</div>
                    <?php
                        if($delivery_status[0]['status'] == 1) {
                            echo '<button class="btn btn-sm btn-success">Dispatch Package</button>';
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