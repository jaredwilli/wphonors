<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main">

	<h2 class="breadcrumb">
	<?php $allsearch = &new WP_Query("s=$s&showposts=-1"); 
	$key = esc_html($s, 1); 
	$count = $allsearch->post_count; 
	echo $count . ' Search Results Found for <span class="search-terms">&ldquo;' . $key . '&rdquo;</span>'; 
	wp_reset_query(); ?>
	</h2>
 	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="site-<?php the_ID(); ?>" class="sites clearfix">

		<?php if( get_post_type() == 'site' ) : ?>
			<?php $s = new TypeSites(); $a = $s->mshot(200); ?>
			<div class="site-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $a[1]; ?>" alt="<?php the_title(); ?>" /></a>

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

		<?php elseif( get_post_type() == 'plugin' ) : ?>
			<?php $pl = new TypePlugins(); $b = $pl->pluginshot(200); ?>
			<div class="site-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $b[1]; ?>" alt="<?php the_title(); ?>" /></a>
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

		<?php elseif( get_post_type() == 'theme' ) : ?>
		<?php $t = new TypeThemes(); $c = $t->themeshot(200); ?>
			<div class="site-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $c[1]; ?>" alt="<?php the_title(); ?>" /></a>
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

		<?php elseif( get_post_type() == 'person' ) : ?>
		<?php 
		$p = new TypePersons(); 
		$twit=$p->twitshot(); 
		$webs=$p->pshot(200); 
		?>
				<div class="pavatar">
					<a href="<?php the_permalink(); ?>" title="@<?php echo $twit[2];?>"><div class="ppavatar" style="background:#000 url(<?php echo $twit[1];?>) no-repeat center center;"></div></a>

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

		<?php endif; ?>

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
		<div class="message message_404">
			<h2 class="post-title"><?php _e( 'Nothing Found' );?></h2>
			<p><?php _e( 'There were no results found for the keywords entered. Please try searching again.' ); ?></p>
		</div>
	<?php endif; ?>

	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>