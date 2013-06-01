<?php get_header(); ?>

<div id="wrapper">
	<div id="header">
		<div id="topnav">
			<ul class="menu-top">
			<?php if (is_user_logged_in()) { ?>			
			<?php global $current_user; get_currentuserinfo(); ?>
				<li><a href="<?php echo admin_url('/'); ?>">Dash</a></li>
				<li><a href="<?php echo admin_url('/profile.php'); ?>">Profile</a></li>
				<li><a href="<?php echo site_url('author/') . $current_user->user_nicename; ?>">My Posts</a></li>
				<li><a href="#TB_inline?height=440&amp;width=500&amp;inlineId=dialog" class="thickbox" title="Submit">Submit</a></li>
				<li><a href="<?php echo wp_logout_url(home_url('/')); ?>">Logout</a></li>

			<?php } else { ?>
				<li><a href="#TB_inline?height=300&amp;width=400&amp;inlineId=dialog" class="thickbox" title="Login">Login / Register</a></li>
			<?php } ?>
			</ul>
		</div>
		<div id="branding" class="inner clearfix">
			<div class="top">
				<h1><a class="logo" href="<?php echo home_url('/'); ?>"></a></h1>
				<h3 class="tagline"><?php bloginfo('description'); ?></h3>
			</div>
		</div>
	
	<div class="stars"></div>
	<div id="navigation">
		<div class="lside"></div>
		<div class="rside"></div>
		<div class="skip-link">
			<a href="#content" title="Skip navigation to the content">Skip to content</a>
		</div>

		<?php wp_nav_menu(array('menu'=>'Header','container'=>false)); ?>
	</div>
	
	<div class="s2010"></div>
		

	<ul id="social">		
		<li id="facebook"><a href="http://www.facebook.com/pages/WP-Honors/156721411023526" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/icons/facebook32.png" alt="Like Us" title="Like Us" /></a></li>
		<li id="twitter"><a href="http://twitter.com/wphonors" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/icons/twitter32.png" alt="Follow Us" title="Follow Us" /></a></li>
		<li id="rss"><a href="http://feeds.feedburner.com/WPHonors"><img src="<?php bloginfo('template_directory'); ?>/images/rss_32.png" alt="Subscribe" title="Subscribe" /></a></li>
		<li id="email"><a href="http://feedburner.google.com/fb/a/mailverify?uri=WPHonors&width=600&height=400" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/email.png" alt="Get Emails" title="Get Emails" /></a></li>
	</ul>

	</div><!-- end header -->