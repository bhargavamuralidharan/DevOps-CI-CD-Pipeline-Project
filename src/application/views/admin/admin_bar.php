<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="admin-bar">
    <div class="container">
        <ul class="list-inline basic">
            <li class="mr-2">
                <a href="<?= site_url('admin') ?>">Dashboard</a>
            </li>
            <li class="mr-2">
                <a href="<?= site_url('admin/users') ?>">Users</a>
            </li>
            <li class="mr-2">
                <a href="<?= site_url('admin/manage_packages') ?>">Packages</a>
            </li>
            <li class="mr-2">
                <a href="<?= site_url('admin/server_info') ?>">Server Info</a>
            </li>
        </ul>
    </div>
</div>