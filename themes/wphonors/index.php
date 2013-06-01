<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main">
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts( array( 'post_type' => 'post', 'caller_get_posts' => -1, 'paged' => $paged ) );
		if ( have_posts() ) : ?>
	
		<?php if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
		<?php } ?>	
	
	<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
			<div class="post-data" style="float:right; width:220px;">
				
			</div>

			<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<ul class="postinfo clearfix">
				<li class="pdate"><?php the_time('M j, Y'); ?></li>
				<li class="pauthor"><?php the_author_posts_link();?></li>
				<li class="pcomments"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></li>
				<li><?php echo twitter_button(); ?></li>
			
			</ul>
			<div class="entry clearfix">
				<?php the_content(__('Read more'));?>
			</div>
			<div class="fl post-tags">
				<?php the_tags( __( ' ' ), ' , ', ' ' ); ?> 
			</div>
			<div class="edit-post">
				<?php edit_post_link( __( 'edit post' )); ?>
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
		<div class="message message_404">
			<h2 class="post-title"><?php _e( 'Not Found' ); ?></h2>
			<p><?php _e( 'The page you were looking for did not win Honors today.' ); ?></p>
		</div>
	<?php endif; ?>
	
	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>