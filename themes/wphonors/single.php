<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main">

	<?php if (have_posts()) : ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
	<?php while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

<div class="post-data fr" style="width: 275px; margin-left:5px;">
	<div class="" style="display: inline; float: right;"><a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Like</a></div>
	<div class="fl" style="display:inline; float:left;"><?php echo twitter_button(); ?></div>
	<script src="http://www.stumbleupon.com/hostedbadge.php?s=1&r=<?php the_permalink(); ?>"></script><br />
</div>

			<ul class="postinfo clearfix">
				<li class="pdate"><?php the_time('M j, Y'); ?></li>
				<li class="pcomments"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></li>
			</ul>

			<div class="entry clearfix">
				<?php the_content(__('Read more'));?>
				<div class="fl post-tags">
				<?php the_tags( __( ' ' ), ' , ', ' ' ); ?> 
			</div>
			<div class="edit-post">
				<?php edit_post_link( __( 'edit post' )); ?>
			</div>
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
			<h2 class="post-title"><?php _e( 'Imma Let You Finish...' ); ?></h2>
			<p><?php _e( 'But <a href="http://blippy.com/404" target="_blank">Blippy</a> has the best 404 page ever!!' ); ?></p>
		</div>
	<?php endif; ?>
	
	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>