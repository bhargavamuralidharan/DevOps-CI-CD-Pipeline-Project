<div class="page-content">

    <div class="container">
        <h5 class="mb-5">Add A Package</h5>

        <div class="row">
            <div class="col-md-9 col-sm-12">

                <?php if (isset($_SESSION['package_added'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['package_added']; unset($_SESSION['package_added']); ?>
                    </div>
                <?php } ?>

                <form action="<?= site_url('admin/add_package') ?>" method="POST">
                    <div class="form-group">
                        <label for="deliver_to">Deliver To</label>
                        <select name="deliver_to" id="deliver_to" class="form-control" required>
                            <option value=""></option>
                            <?php foreach($users as $user) { ?>
                                <option value="<?= $user["id"] ?>"><?= $user["first_name"] . ' ' . $user["last_name"] . ' &nbsp;&nbsp;(' . $user["username"] . ')' ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tracking_id">Tracking ID</label>
                                <input type="text" name="tracking_id" class="form-control" required readonly value="<?= strtoupper(random_str(10)) ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="weight">Weight (in lbs)</label>
                                <input type="text" name="weight" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="delivery_title">Delivery Title</label>
                        <input type="text" name="delivery_title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="delivery_details">Delivery Details</label>
                        <textarea name="delivery_details" class="form-control" required rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="notify_user_email" checked> &nbsp;&nbsp;
                        <label for="notify_user_email">Notify the user via email</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="notify_user_email"> &nbsp;&nbsp;
                        <label for="notify_user_email">Notify the user via SMS</label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Add Package</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="spacer-50"></div>
</div>