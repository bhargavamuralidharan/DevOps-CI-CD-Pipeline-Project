<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

    <div class="container-fluid">
        <h5 class="mb-5">Admin Dashboard</h5>

        <div class="admin-stats">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="<?= site_url('admin/users') ?>">
                        <div class="box text-center">
                            <h1><?= $user_count ?></h1>
                            <b>Users</b>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <a href="<?= site_url('admin/users') ?>">
                        <div class="box text-center">
                            <h1><?= $staff_count ?></h1>
                            <b>Staff</b>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box text-center">
                        <h1><?= $packages_in_transit ?></h1>
                        <b>Packages In Transit</b>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="box text-center">
                        <h1>10</h1>
                        <b>Delivered Packages</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="spacer-30"></div>

        <div class="row">
            <div class="col-sm-12">
                <a href="<?= site_url('admin/add_package') ?>" class="btn btn-sm btn-primary float-right">Add Package</a>             
                <a href="<?= site_url('admin/manage_packages') ?>" class="btn btn-sm btn-primary mb-3 float-right">All Packages</a>
                <h5>Recent Packages</h5> 
                <table class="table table-striped mt32 customers-list">
                    <thead>
                        <tr>
                            <th>Deliver to</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Tracking ID</th>
                            <th>Added</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($packages as $pkg) { ?>
                            <tr>
                                <td><?= $pkg['first_name'] ?> <?= $pkg['last_name'] ?></td>
                                <td><?= $pkg['email'] ?></td>
                                <td><?= $pkg['phone'] ?></td>
                                <td><?= $pkg['tracking_id'] ?></td>
                                <td><?= date('F j, Y - h:m a', strtotime($pkg['added'])) ?></td>
                                <td><?= $delivery_status_titles[$pkg['delivery_status'] - 1]['title'] ?></td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="<?= site_url('admin/package/' . $pkg['tracking_id']) ?>">View</a> 
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="spacer-30"></div>
            </div>
        </div>

        <div class="spacer-50"></div>
    </div>

</div>