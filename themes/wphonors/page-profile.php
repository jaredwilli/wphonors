<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
			<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
			<?php // show user info
			if( !is_user_logged_in() ) { $url = site_url('wp-login.php'); } else {
				global $current_user;
				get_currentuserinfo(); ?>
		
				<div class="pavatar"><?php echo member_get_avatar( $current_user->ID, get_the_author_meta('user_email'), 110 ); ?></div>
				<div class="meta">
					<h2 class="post-title"> <?php echo $current_user->user_firstname .' '. $current_user->user_lastname; ?></h2>
					<p><strong>Username:</strong> <?php echo $current_user->user_login; ?></p>
					<p><strong>Display name: </strong><?php echo $current_user->display_name; ?></p>
					<p><strong>Email: </strong><?php echo $current_user->user_email; ?></p>											
					<!--
					<p><strong>User ID:</strong> <?php $current_user->ID; ?></p>
					<p><strong>User level: </strong><?php echo $current_user->user_level; ?></p>
					-->
				</div>
		
			<?php } ?>
		
			<div class="entry clearfix">
				<?php the_content(__('Read more'));?>
			</div>
		</div>
			
	<?php endwhile; ?>

		<?php if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
		<?php } ?>
		
	<?php else : ?>
		<div class="error message message_404">
			<h2 class="title"><?php _e( 'O_o Great Googly Moogly! Not Found!!' ); ?></h2>
			<p><?php _e( 'What did you lose this time?' ); ?></p>
		</div>
	<?php endif; ?>
	
	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>