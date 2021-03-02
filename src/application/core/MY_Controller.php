<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		// Checks if user is logged in, redirects if not
		function require_auth(){

			$url = base_url($_SERVER['REQUEST_URI']);

			if(!isset($_SESSION['logged_in'])){
				echo "require_auth";
				redirect('auth' . '?redirect=' .urlencode($url));
			}
            
		}

		// Checks if requests made via AJAX are cleared for access (user is logged in), responds with error if not
		function require_auth_ajax(){

			$url = base_url($_SERVER['REQUEST_URI']);

			if(!isset($_SESSION['logged_in'])){
				echo json_encode(array("response" => "require_auth"));
				exit();
			}
		}

		// Checks if a user is authorized to view a particular resource | Checks for admin priviliges
		function require_auth_admin($level = 1){

			$url = base_url($_SERVER['REQUEST_URI']);

			if(!isset($_SESSION['logged_in'])){
				echo "require_auth";
				redirect('auth' . '?redirect=' .urlencode($url));
			} else {
				if($_SESSION['access'] < 1) {
					echo "require_auth_admin";
					redirect('dashboard');
				}
			}
		}

		// Random string generator
		function random_str(
			int $length = 64,
			string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz'
		): string {
			if ($length < 1) {
				throw new RangeException("Length must be a positive integer");
			}
			$pieces = [];
			$max = mb_strlen($keyspace, '8bit') - 1;
			for ($i = 0; $i < $length; ++$i) {
				$pieces []= $keyspace[random_int(0, $max)];
			}
			return implode('', $pieces);
		}

		// Standard HTML-Email template
		function default_email_template($content) {
			
			$tophalf = '
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
			<title>Mailto</title>
			<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
			<style type="text/css">
			html { -webkit-text-size-adjust: none; -ms-text-size-adjust: none;}
			
				@media only screen and (min-device-width: 750px) {
					.table750 {width: 750px !important;}
				}
				@media only screen and (max-device-width: 750px), only screen and (max-width: 750px){
				  table[class="table750"] {width: 100% !important;}
				  .mob_b {width: 93% !important; max-width: 93% !important; min-width: 93% !important;}
				  .mob_b1 {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
				  .mob_left {text-align: left !important;}
				  .mob_soc {width: 50% !important; max-width: 50% !important; min-width: 50% !important;}
				  .mob_menu {width: 50% !important; max-width: 50% !important; min-width: 50% !important; box-shadow: inset -1px -1px 0 0 rgba(255, 255, 255, 0.2); }
				  .mob_center {text-align: center !important;}
				  .top_pad {height: 15px !important; max-height: 15px !important; min-height: 15px !important;}
				  .mob_pad {width: 15px !important; max-width: 15px !important; min-width: 15px !important;}
				  .mob_div {display: block !important;}
				 }
			   @media only screen and (max-device-width: 550px), only screen and (max-width: 550px){
				  .mod_div {display: block !important;}
			   }
				.table750 {width: 750px;}
			</style>
			</head>
			<body style="margin: 0; padding: 0;background:#ffffff;">
			
			<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#ffffff; min-width: 350px; font-size: 1px; line-height: normal;">
				 <tr>
				   <td align="center" valign="top">   			
					   <!--[if (gte mso 9)|(IE)]>
					 <table border="0" cellspacing="0" cellpadding="0">
					 <tr><td align="center" valign="top" width="750"><![endif]-->
					   <table cellpadding="0" cellspacing="0" border="0" width="750" class="table750" style="width: 100%; max-width: 750px; min-width: 350px; background: #f3f3f3;">
						   <tr>
						   <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
							   <td align="center" valign="top" style="background: #ffffff;">
			
							  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
								 <tr>
									<td align="right" valign="top">
									   <div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div>
									</td>
								 </tr>
							  </table>
			
							  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
								 <tr>
									<td align="left" valign="top">
									   <div style="height: 39px; line-height: 39px; font-size: 37px;">&nbsp;</div>
									   <a href="https://kebanas.com/" target="_blank" style="display: block; max-width: 128px;">
										  <img src="https://kebanas.com/resources/images/kebanas.png" alt="Kebanas Logo" width="128" border="0" style="display: block; width: 128px;" />
									   </a>
									</td>
								 </tr>
								 <tr>
									 <td>
										 <div style="height: 73px; line-height: 73px; font-size: 71px;">&nbsp;</div>
									 </td>
								 </tr>
							  </table>
			
							  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
								 <tr>
									<td align="left" valign="top">
									   <font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 52px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">
										  <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 52px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">Hello,</span>
									   </font>
									   <div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
									   <font face="\Source Sans Pro\', sans-serif" color="#585858" style="font-size: 24px; line-height: 32px;">
										  <span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 24px;">
			';

			$bottomhalf = '
								</span>
								</font>
								</td>
										</tr>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" width="90%" style="width: 90% !important; min-width: 90%; max-width: 90%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-bottom: none; border-left: none; border-right: none;">
										<tr>
											<td align="left" valign="top">
											<div style="height: 15px; line-height: 15px; font-size: 13px;">&nbsp;</div>
											</td>
										</tr>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
										<tr>
											<td align="center" valign="top">
											<div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
											<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
												
			   									<tr>
												   <div style="height: 73px; line-height: 73px; font-size: 71px;">&nbsp;</div>
												</tr>
												<tr>
													<td align="center" valign="top">
														<table cellpadding="0" cellspacing="0" border="0" width="78%" style="min-width: 300px;">
														<tr>
															<td align="center" valign="top" width="23%">                                             
																<a href="https://kebanas.com/docs" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																	<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																	<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">HELP&nbsp;CENTER</span>
																	</font>
																</a>
															</td>
															<td align="center" valign="top" width="10%">
																<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 17px; font-weight: bold;">
																	<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 17px; font-weight: bold;">&bull;</span>
																</font>
															</td>
															<td align="center" valign="top" width="23%">
																<a href="https://kebanas.com/contact" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																	<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																	<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">SUPPORT&nbsp;24/7</span>
																	</font>
																</a>
															</td>
															<td align="center" valign="top" width="10%">
																<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 17px; font-weight: bold;">
																	<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 17px; font-weight: bold;">&bull;</span>
																</font>
															</td>
															<td align="center" valign="top" width="23%">
																<a href="https://kebanas.com/dashboard" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																	<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">
																	<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none; white-space: nowrap; font-weight: bold;">ACCOUNT</span>
																	</font>
																</a>
															</td>
														</tr>
														</table>
														<div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
														<font face="\'Source Sans Pro\', sans-serif" color="#868686" style="font-size: 17px; line-height: 20px;">
														<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 17px; line-height: 20px;">Copyright &copy; 2020 Kebanas. All&nbsp;Rights&nbsp;Reserved.</span>
														</font>
														<div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
														<font face="\'Source Sans Pro\', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 20px;">
														<span style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="#" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">contact@kebanas.com</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Made With Love<a href="#" target="_blank" style="font-family: \'Source Sans Pro\', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Unsubscribe</a></span>
														</font>
														<div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
													</td>
												</tr>
											</table>
											</td>
										</tr>
									</table>  

								</td>
								<td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
								</tr>
							</table>
							<!--[if (gte mso 9)|(IE)]>
							</td></tr>
							</table><![endif]-->
						</td>
					</tr>
					</table>
					</body>
					</html>
			';

			return $tophalf . $content . $bottomhalf;
		}

    }

}
