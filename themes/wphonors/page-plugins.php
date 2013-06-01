<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main">

		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
		<?php query_posts( array( 'post_type' => 'plugin', 'caller_get_posts' => -1, 'orderby' => 'rand', 'paged' => $paged ) ); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $pl = new TypePlugins(); $b = $pl->pluginshot(200); ?>

			<div id="plugin-<?php the_ID(); ?>" class="sites clearfix user_id_<?php the_author_meta('ID'); ?>">
			
			<div class="site-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $b[1]; ?>" alt="<?php the_title(); ?>" width="200" /></a>

					<div class="post-data">

<?php if( !is_user_logged_in() ) { ?>
	<div id="login-vote">
		<a href="#TB_inline?height=300&amp;width=400&amp;inlineId=dialog" class="thickbox" title="Login"></a>
	</div>
<?php } else { ?>
	<div class="votebadge">
		<?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?>
	</div>
<?php } ?>

						<div class="tweet">
				<div class="fl"><?php echo twitter_button(); ?></div>

<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
						</div>
					</div>
				</div>
				
				<div class="honorentry">
		                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                    
    
		                    <div class="entry">
                		        <?php the_content( __( '(More ...)' )); ?>
		                    </div>
                		    <div class="fl post-tags">
		                        <?php the_tags( __( ' ' ), ' , ', ' ' ); ?> 
	               		    </div>
        		            <div class="edit-post">
                        		<?php edit_post_link( __( 'edit post' )); ?>
		                    </div>
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
	<div id="message message_404">
		<h2 class="title">Not Found</h2>
		<p>There are no plugins posted yet...</p>
	</div>
	<?php endif; ?>
	
	</div><!-- end #content-main -->
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div> <!-- end #content-sub -->

</div><!-- end #content -->
<?php get_footer(); ?>