<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" class="sites clearfix">

			<div class="post-data fr" style="width: 200px; margin-left:5px;">
				<div class="fl"><?php echo twitter_button(); ?></div>
				<script src="http://www.stumbleupon.com/hostedbadge.php?s=1&r=<?php the_permalink(); ?>"></script><br />
				<div class="fl"><a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Like</a></div>
			</div>

			<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry clearfix">
				<?php the_content(__('Read more'));?>
			</div>
			<div class="edit-post">
				<?php edit_post_link( __( 'edit post' )); ?>
			</div>
		</div>

	<?php comments_template(); ?>
	<?php endwhile; ?>
	
		<?php if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
		<?php } ?>
				
	<?php else : ?>
		<div class="message message_404">
			<h2 class="post-title"><?php _e( 'Not found' ); ?></h2>
			<p><?php _e( 'There is nothing here to see. I wonder what happened to it.' ); ?></p>
		</div>
	<?php endif; ?>
	
	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>