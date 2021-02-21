<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

	<div class="container">
		<div class="box auth-box">
			<div class="spacer"></div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo form_open('auth/login', array('id' => 'loginForm', 'style' => 'margin: 0 auto; max-width:500px;'));?>
						<div class="text-center">
							<h5>Account Recovery</h5>
						</div>
						<?php if(isset($error_message)){ ?>
							<div class="alert alert-danger text-center">
							  	<strong><?= $error_message ?></strong>
							</div>
						<?php } ?>
						<div class="form-group">
							<p>
								Please enter the email address that you used when creating your account.
							</p>
						</div>
						<div class="form-group">
							<span class="form-error"><?php echo form_error('email'); ?></span>
							<label for="email">Email Address</label>
							<input type="email" name="email" class="form-control" value="<?php if($this->input->post('email') != null) echo $this->input->post('email') ?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
			<div class="spacer"></div>
		</div>
	</div>
	
</div>