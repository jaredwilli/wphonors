	<div id="tabs">
		<ul>
			<li><a href="#login">Login</a></li>
			<li><a href="#signup">Register</a></li>
			<li><a href="#passwd">Lost Password</a></li>
		</ul>

		<div id="login">
			<h3 class="nominate">User Login</h3>
			<?php wp_login_form(); ?>
		</div>

		<div id="signup">
			<h3 class="nominate">Register</h3>
			<form name="registerform" id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">			
				<p>
					<label><?php _e( 'Username' ) ?><br />
					<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" /></label>
				</p>
				<p>
					<label><?php _e( 'Email' ) ?><br />
					<input type="text" name="user_email" id="user_email" class="input" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" /></label>
				</p>
				
				<?php do_action('register_form'); ?>
				
				<p id="reg_passmail">
					<?php _e('A password will be e-mailed to you.') ?>
				</p>
				<br class="clear" />
				<input type="hidden" name="redirect_to" value="<?php home_url('/'); ?>" />
				
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register'); ?>" />
				</p>
			</form>
		</div>			

		<div id="passwd">
			<h3 class="nominate">Reset Password</h3>
			<form name="lostpasswordform" id="lostpasswordform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post">				
				<p>
					<label><?php _e('Username or E-mail:') ?><br />
					<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" tabindex="10" /></label>
				</p>

				<?php do_action('lostpassword_form'); ?>
				
				<input type="hidden" name="redirect_to" value="<?php home_url('/'); ?>" />
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Get New Password'); ?>" tabindex="100" />
				</p>				
			</form>	
		</div>		
	</div>