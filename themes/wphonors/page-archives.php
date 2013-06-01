<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" class="single">
	
		<div id="post-<?php the_ID(); ?>" class="sites clearfix">

		    <div class="post-data fr" style="width:200px;margin:5px;">
        		<div class="fr"><?php echo twitter_button(); ?></div>
	                <a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
		    </div>        

			<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry clearfix">
				<?php wp_get_archives('daily'); ?>
			</div>
			<div class="edit-post">
				<?php edit_post_link( __( 'edit post' )); ?>
			</div>
		</div>

	<?php comments_template(); ?>
	
	</div>
</div>
<?php get_footer(); ?>