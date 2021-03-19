<footer class="footer">
    <section>

        <div class="container">
            <div class="row">

                <div class="footer-block col-md-3 col-sm-3 cf">
                    <img src="http://placehold.it/80x80" alt="Footer Logo">
                </div>

                <div class="footer-block col-md-3 col-sm-3 sm">
                    <h6>Who Are We?</h6>
                    <ul class="hidden-xs basic no-padding">
                        <li><a href="<?= site_url('about') ?>" tabindex="-1">About us</a></li>
                        <li><a href="<?= site_url('contact') ?>" tabindex="-1">Contact us</a></li>
                        <li><a href="<?= site_url('awards') ?>" tabindex="-1">Awards</a></li>
                    </ul>
                </div>

                <div class="footer-block col-md-3 col-sm-3">
                    <h6>Tools</h6>
                    <ul class="hidden-xs basic no-padding">
                        <li><a href="<?= site_url('dashboard') ?>" tabindex="-1">My Account</a></li>
                        <li><a href="<?= site_url('dashboard') ?>" tabindex="-1">Track A Parcel</a></li>
                        <li><a href="<?= site_url('quotes') ?>" tabindex="-1">Get A Quote</a></li>
                    </ul>
                </div>

                <div class="footer-block col-md-3 col-sm-3">
                    <h6>Features</h6>
                    <ul class="hidden-xs basic no-padding">
                        <li><a href="<?= site_url('auth/register') ?>" tabindex="-1">Business Account</a></li>        
                    </ul>
                </div>

            </div>
                <div class="mpd-social">
                <a href="#" class="fb" target="_blank" tabindex="-1"></a>
                <a href="#" class="twit" target="_blank" tabindex="-1"></a>
                <a href="#" class="linked" target="_blank" tabindex="-1"></a>
                <a href="#" class="gplus" target="_blank" tabindex="-1"></a>
            </div><!--social-->
        </div>
    </section>

    <div class="footer-dark">
        <section class="footer-baseline">
            <div class="container">
                <ul class="footer-links list-inline">
                    <li class="mr-3">&copy; Copyright International Courier Software</li>
                    <li><a href="<?= site_url('legal/privacy_policy') ?>" tabindex="-1">Privacy Policy</a></li>
                    <li><a href="<?= site_url('legal/cookie_policy') ?>" tabindex="-1">Cookie Policy</a></li>
                    <li><a href="terms-and-conditions.php" tabindex="-1">Terms And Conditions</a></li>
                    <li><a href="refund-policy.php" tabindex="-1">Refund Policy</a></li>
                </ul>
            <a href="#" id="back-top"></a>
            </div>
        </section>
    </div>
</footer>

	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- jQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

	<!-- bootstrap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<?php 
        if(isset($load_extra_js))
        {
            foreach($load_extra_js as $row)
            {
                echo '<script src="' . $row . '"></script>';
            }
        }
    ?>
    
</body>
</html>