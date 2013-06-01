<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" role="main">

	<?php //if ( post_type_exists(array( 'site','plugin', 'theme','person' )) {
	$t1 = array( 'Sites','Personal','WordPress Related','Business' );
	$t2 = array( 'Plugins','Free Plugins','Commercial Plugins' );
	$t3 = array( 'Themes','Free Themes','Commercial Themes','Theme Framework' );
	$t4 = array( 'Personalities','Designer','Developer','Blog Author','WP Community' );
	
	$cat = get_the_category_by_ID(get_query_var('cat')); // echo $cat;
	
	if ( $cat == $t1[0] || $cat == $t1[1] || $cat == $t1[2] || $cat == $t1[3] || $cat == $t1[4] ) : 
		$posttype = 'site';
	elseif ( $cat == $t2[0] || $cat == $t2[1] || $cat == $t2[2] ) : 
		$posttype = 'plugin';
	elseif ( $cat == $t3[0] || $cat == $t3[1] || $cat == $t3[2] || $cat == $t3[3] ) : 
		$posttype = 'theme';
	elseif ( $cat == $t4[0] || $cat == $t4[1] || $cat == $t4[2] || $cat == $t4[3] || $cat == $t4[4] ) : 
		$posttype = 'person';
	endif;
	//echo $posttype;
wp_reset_query();
	?>
	
	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
	<?php query_posts( array( 'taxonomy' => 'category', 'term' => $cat, 'post_type' => $posttype, 'post_status' => 'publish', 'showposts' => '150', 'orderby' => 'rand', 'paged' => $paged )); ?>

	<h2 class="breadcrumb">
		<?php echo ucwords( $posttype ); ?> &rsaquo; <a href="<?php site_url('/'.$posttype.'/'. get_the_category('nicename') .'/'); ?>"><?php echo $cat; ?></a>
	</h2>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="site-<?php the_ID(); ?>" class="sites clearfix">

		<?php if( $posttype == 'site' ) : ?>

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

		<?php elseif( $posttype == 'plugin' ) : ?>
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

		<?php elseif( $posttype == 'theme' ) : ?>
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

		<?php elseif( $posttype == 'person' ) : ?>

			<?php $p=new TypePersons(); $twit=$p->twitshot(); $webs=$p->pshot(200); ?>

				<div class="pavatar">
					<a href="<?php the_permalink(); ?>" title="@<?php echo $twit[2];?>">
						<div class="ppavatar" style="background:#000 url(<?php echo $twit[1];?>) no-repeat center center;"></div>
					</a>
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

		<?php// if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
		<div class="navigation clearfix">
			<div id="next" class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
		<?php // } ?>
		
	<?php else : ?>
		<div class="message message_404">
			<h2 class="post-title"><?php _e( 'No Posts Found' ); ?></h2>
			<p><?php _e( 'Apparently no posts submitted any posts yet.' ); ?></p>
		</div>
	<?php endif; ?>

	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>