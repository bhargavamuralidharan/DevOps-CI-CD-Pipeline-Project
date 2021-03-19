<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-content">

	<div class="container">
		<div class="box auth-box">
			<div class="spacer"></div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo form_open('auth/login', array('id' => 'loginForm', 'style' => 'margin: 0 auto; max-width:500px;'));?>
						<div class="text-center">
							<h5>Login</h5>
							<div style="height: 50px;"></div>
						</div>
						<?php if(isset($_SESSION['account_created'])) { ?>
							<div class="alert alert-success">
								<?= $_SESSION['account_created'] ?>
							</div>
						<?php } ?>
						<?php if(isset($error_message)){ ?>
							<div class="danger-alert text-center">
							  	<strong><?= $error_message ?></strong>
							</div>
						<?php } ?>
						<div class="form-group">
							<span class="form-error"><?php echo form_error('username'); ?></span>
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" value="<?php if($this->input->post('username') != null) echo $this->input->post('username') ?>">
						</div>
						<div class="form-group">
							<span class="form-error"><?php echo form_error('password'); ?></span>
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Login</button>
							<div class="auth-meta">
								<a class="auth-metas" href="<?= site_url('auth/register') ?>">New Account</a>
								 | 
								<a class="auth-metas" href="<?= site_url('auth/account_recovery') ?>">Forgot Password?</a>
							</div>
							
						</div>
					</form>
				</div>
			</div>
			<div class="spacer"></div>
		</div>
	</div>
	
</div>