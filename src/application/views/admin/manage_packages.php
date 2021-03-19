<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

    <div class="container-fluid">
        <h3 class="mb-5">Manage Packages</h3>
    
        <div class="row">
            <div class="col-md-8">
                <div class="flex align-items-center mb-4">
                    <div class="flex-1">
                        <b>Search</b>
                    </div>
                    <div class="flex-9">
                        <input type="search" placeholder="Search..." class="form-control search-input" data-table="customers-list"/>
                    </div>
                </div>
            </div>
        </div>
        
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

        <div class="spacer-50"></div>

    </div>

</div>

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