<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

    <div class="container">
        <h1>Staff</h1>

        <table class="table table-striped mt32 staff-list">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($staff as $s) { ?>
                    <tr>
                        <td><?= $s['username'] ?></td>
                        <td><?= $s['first_name'] ?> <?= $s['last_name'] ?></td>
                        <td><?= $s['email'] ?></td>
                        <td><?= $s['phone'] ?></td>
                        <td><?= $s['registered'] ?></td>
                        <td><a href="#" class="btn btn-block btn-default btn-sm"><i class="fas fa-wrench"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h1 class="mt-5 mb-5">Regular Users</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="flex align-items-center mb-4">
                    <div class="flex-1">
                        <b>Search</b>
                    </div>
                    <div class="flex-9">
                        <input type="search" placeholder="Search..." class="form-control search-input" data-table="users-list"/>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped mt32 users-list">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $u) { ?>
                    <tr>
                        <td><?= $u['username'] ?></td>
                        <td><?= $u['first_name'] ?> <?= $u['last_name'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['phone'] ?></td>
                        <td><?= $u['registered'] ?></td>
                        <td><a href="#" class="btn btn-block btn-default btn-sm"><i class="fas fa-wrench"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<div class="spacer-50"></div>

<script>
    (function(document) {
        'use strict';

        var TableFilter = (function(myArray) {
            var search_input;

            function _onInputSearch(e) {
                search_input = e.target;
                var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                myArray.forEach.call(tables, function(table) {
                    myArray.forEach.call(table.tBodies, function(tbody) {
                        myArray.forEach.call(tbody.rows, function(row) {
                            var text_content = row.textContent.toLowerCase();
                            var search_val = search_input.value.toLowerCase();
                            row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                        });
                    });
                });
            }

            return {
                init: function() {
                    var inputs = document.getElementsByClassName('search-input');
                    myArray.forEach.call(inputs, function(input) {
                        input.oninput = _onInputSearch;
                    });
                }
            };
        })(Array.prototype);

        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                TableFilter.init();
            }
        });

    })(document);
</script>