<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html lang="en-US"> <!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8" />
	<!-- Mobile Specific Metas -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?=base_url('resources/images/favicon.png')?>">

	<!-- Bootstrap -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('resources/css/bootstrap-theme.min.css')?>">

	<!-- FontAwesome -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/solid.min.css">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('resources/css/style.css')?>">

	<!-- style -->
<?php /*    <link href="<?=base_url('resources/css/deprixa_components/content/cssefe4.css')?>" rel="stylesheet"/>
    <link href="<?=base_url('resources/css/deprixa_components/styles/track-order.css')?>" rel="stylesheet" />	
	<script src="deprixa_components/hub/scripts/bootstrap.min.js"></script>
	<script src="deprixa_components/hub/scripts/jquery-validate.min.js"></script>
	<script src="deprixa_components/hub/scripts/jquery-validate-unobtrusive.min.js"></script>
	<script src="process/countries.js"></script> 		
	<link rel="stylesheet" href="<?=base_url('resources/css/deprixa_components/hub/css/global.css')?>" />
	<link rel="stylesheet" href="<?=base_url('resources/css/deprixa_components/hub/css/services.css')?>" />
	<link rel="stylesheet" href="<?=base_url('resources/css/deprixa_components/hub/css/dSwiper.css')?>" />
	<link rel="stylesheet" href="<?=base_url('resources/css/deprixa_components/hub/css/bootstrap-mpd.css')?>" />				
    <link href="<?=base_url('resources/css/deprixa_components/styles/home1d2d.css')?>" rel="stylesheet"/>
	<link href="<?=base_url('resources/css/deprixa_components/styles/nivo-slider.css')?>" rel="stylesheet"/>
	<link rel="stylesheet" href="<?=base_url('resources/css/deprixa_components/styles/default.css')?>" /> 
*/ ?>
	<!-- countries dropdown -->
	<script src="<?=base_url('resources/js/countries.js')?>"></script>

	<!-- Page Title -->
	<title><?php if(isset($title)) echo $title . " | "; ?> DevOps-CI</title>

	<?php 
        if(isset($load_extra_css))
        {
            foreach($load_extra_css as $row)
            {
                echo '<link href="' . $row . '">';
            }
        }

        if(isset($load_extra_js_header))
        {
            foreach($load_extra_js_header as $ejsh)
            {
                echo '<script src="' . $ejsh . '"></script>';
            }
        }
    ?>

	<meta name="description" content="" />

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light shadow">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>">Logo</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url() ?>">Track My Courier <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							About Us
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('contact') ?>">Contact Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Get a Quote</a>
					</li>
				</ul>
				<?php if(isset($this->session->logged_in)) { ?>
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?= $_SESSION['username'] ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="<?= base_url('dashboard') ?>">My Account</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?=base_url('auth/logout')?>">Sign Out</a>
						</div>
					</li>
				</ul>
				<?php } else { ?>
				<ul class="navbar-nav">
					<li><a class="nav-link" href="<?=base_url('auth')?>">Login</a></li>
					<li><a class="nav-link" href="<?=base_url('auth/register')?>">Signup</a></li>
				</ul>
				<?php } ?>
			</div>
		</div>
	</nav>