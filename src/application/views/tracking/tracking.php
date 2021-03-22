<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

    <div class="container">
        <div class="text-center mb-3">
            <img src="<?= base_url('resources/images/tracking-search.png') ?>" alt="Tracking Image">
            <h1 class="mt-3">IS IT NEARLY THERE?</h1>

            <div class="mw-700 margin-0-auto">
            The pick-up and delivery is easy with us, and doing so Could not be simpler. Once your delivery has been booked through us, 
            a tracking ID is assigned (for example <i>AWB-472304198</i>) to your order. Just input the unique ID into the box below and, ta-dah, you can find out exactly where it is!
            </div>
        </div>

        <div class="mw-300 margin-0-auto">
            <div class="mb-2">
                <form id="trackingForm"></form>
                    <input type="text" id="tracking_id" class="form-control" autocomplete="off" placeholder="Example I2S73MW8RP">
                </form>
            </div>
            <div>
                <button form="trackingForm" type="submit" class="btn btn-default btn-block">Track It</button>
            </div>
        </div>

        <div id="tracking_result" class="mw-700 margin-0-auto mt-3"></div>

        <div class="spacer-50"></div>

    </div>

</div>