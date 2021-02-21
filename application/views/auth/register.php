<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content auth-page">

	<div class="container">

		<div class="text-center">
			<h5 class="mb-5">Sign Up</h5>
		</div>
			
		<?php echo form_open('auth/register_action', array('id' => 'loginForm'));?>

		<div class="well shadow">
			<div class="row">
				
				<div class="col-md-4">
					<div id="personal-details" class="form-horizontal">
						<div class="mb-4">
							<b>Personal Details</b>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-4" for="title">Title</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('title'); ?></span>
								<select class="form-control" name="title"><option value="Mr.">Mr</option>
								<option value="Ms.">Ms</option>
								<option value="Mrs.">Mrs</option>
								<option value="Other">Other</option>
								</select> 
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="fname">First Name</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('fname'); ?></span>
								<input class="form-control" type="text" required name="fname" placeholder="First Name" value="<?php if($this->input->post('fname') != null) echo $this->input->post('fname') ?>" />
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="lname">Last Name</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('lname'); ?></span>
								<input class="form-control" type="text" required name="lname" placeholder="Last Name" value="<?php if($this->input->post('lname') != null) echo $this->input->post('lname') ?>" />
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="email">Email</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('email'); ?></span>
								<input class="form-control" type="email" required name="email" placeholder="you@domain.com" value="<?php if($this->input->post('email') != null) echo $this->input->post('email') ?>" />
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="mb-4">
						<b>Contact Details</b>
					</div>

					<div class="form-group required row">
						<label class="control-label col-md-4" for="phone">Telephone</label>
						<div class="col-md-8">
							<span class="form-error"><?php echo form_error('phone'); ?></span>
							<input class="form-control" type="number" required name="phone" placeholder="5554459290" minlength="10" value="<?php if($this->input->post('phone') != null) echo $this->input->post('phone') ?>" />
						</div>
					</div>

					<div class="form-group required row">
						<label class="control-label col-md-4" for="company">Company Name</label>
						<div class="col-md-8">
							<span class="form-error"><?php echo form_error('company'); ?></span>
							<input class="form-control" type="text" required name="company" placeholder="Name of the business" value="<?php if($this->input->post('company') != null) echo $this->input->post('company') ?>" />
						</div>
					</div>

					<div class="address-entry-address-fields ">
						<div class="form-group required row">
							<label class="control-label col-md-4" for="company">Address</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('address'); ?></span>
								<input class="form-control" type="text" required name="address" placeholder="Address" value="<?php if($this->input->post('address') != null) echo $this->input->post('address') ?>" />
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="PersonalContactDetails_Address_FirstLine">Country</label>
							<div class="col-md-8 col-sm-8">
								<span id="inter_origin" style="display: block;"> 
								<select onchange="print_state('state', this.selectedIndex);" id="country" required  name ="country" class="fa-glass booking_form_dropdown form-control"></select> </span> 											
								<script language="javascript">print_country("country");</script>	
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-4" for="PersonalContactDetails_Address_SecondLine">State</label>
							<div class="col-md-8 col-sm-8">
								<select  name ="state" required  id ="state" class="fa-glass booking_form_dropdown form-control"><option value="">Select state</option></select>    
								<span class="field-validation-valid text-danger" ></span>
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="company">City</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('city'); ?></span>
								<input class="form-control" type="text" required name="city" placeholder="City" value="<?php if($this->input->post('city') != null) echo $this->input->post('city') ?>" />
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="zip">Zipcode</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('zip'); ?></span>
								<input class="form-control" type="text" required name="zip" placeholder="000000" value="<?php if($this->input->post('zip') != null) echo $this->input->post('zip') ?>" />
							</div>
						</div>	
					</div>
				</div>

				<div class="col-md-4">
					<div id="personall-account-details" class="form-horizontal">
						<div class="mb-4">
							<b>Account Details</b>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="password">Username</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('username'); ?></span>
								<input class="form-control" type="text" required name="username" placeholder="Username" value="<?php if($this->input->post('username') != null) echo $this->input->post('username') ?>" />
							</div>
						</div>
						
						<div class="form-group required row">
							<label class="control-label col-md-4" for="password">Password</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('password'); ?></span>
								<input class="form-control" type="password" required name="password" placeholder="password" value="<?php if($this->input->post('password') != null) echo $this->input->post('password') ?>" />
							</div>
						</div>

						<div class="form-group required row">
							<label class="control-label col-md-4" for="password">Confirm Password</label>
							<div class="col-md-8">
								<span class="form-error"><?php echo form_error('confirm-password'); ?></span>
								<input class="form-control" type="password" required name="confirm-password" placeholder="Confirm Password" value="<?php if($this->input->post('confirm-password') != null) echo $this->input->post('confirm-password') ?>" />
							</div>
						</div>

						<div class="form-group row">
							
							<div class="col-md-12 terms-check">
								<p class="text-muted">By continuing you are accepting our <a href="terms-and-conditions.php" target="_blank">terms &amp; conditions.</a></p>     
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<input type="submit" value="Sign up" class="btn btn-primary btn-full signup-btn" />
							</div>
						</div>

					</div>
				</div>

			</div> <!-- row -->
		</div> <!-- well -->

		</form>	

	</div>
	
</div>

<div class="spacer-50"></div>