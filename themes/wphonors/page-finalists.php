<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" role="main">
	<?php
	$args1 = array( 'taxonomy' => 'category', 'term' => 'personal', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args2 = array( 'taxonomy' => 'category', 'term' => 'wordpress-related', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args3 = array( 'taxonomy' => 'category', 'term' => 'business', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args4 = array( 'taxonomy' => 'category', 'term' => 'free-plugins', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args5 = array( 'taxonomy' => 'category', 'term' => 'commercial-plugins', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args6 = array( 'taxonomy' => 'category', 'term' => 'free-themes', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args7 = array( 'taxonomy' => 'category', 'term' => 'commercial-themes', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args8 = array( 'taxonomy' => 'category', 'term' => 'theme-framework', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args9 = array( 'taxonomy' => 'category', 'term' => 'designer', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args10 = array( 'taxonomy' => 'category', 'term' => 'developer', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args11 = array( 'taxonomy' => 'category', 'term' => 'blog-author', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	$args12 = array( 'taxonomy' => 'category', 'term' => 'wp-community', 'post_type' => 'finalist', 'post_status' => 'publish', 'orderby' => 'rand' );
	?>
	
	<!-- ############## Personal Sites ################ -->
	<?php $s1 = new WP_Query( $args1 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Personal</h2>
	<div class="sites clearfix">
	<?php if ($s1->have_posts()) : while ($s1->have_posts()) : $s1->the_post(); ?>
	<?php $a = new TypeFinalists(); $b = $a->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b[3]; ?>" alt="<?php the_title();?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>				
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>


	<!-- ############## WordPress Sites ################ -->
	<?php $s2 = new WP_Query( $args2 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; WordPress Related</h2>
	<div class="sites clearfix">
	<?php if ($s2->have_posts()) : while ($s2->have_posts()) : $s2->the_post(); ?>
	<?php $a2 = new TypeFinalists(); $b2 = $a2->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b2[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b2[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b2[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>

	<!-- ############## Business Sites ################ -->
	<?php $s3 = new WP_Query( $args3 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Business</h2>
	<div class="sites clearfix">
	<?php if ($s3->have_posts()) : while ($s3->have_posts()) : $s3->the_post(); ?>
	<?php $a3 = new TypeFinalists(); $b3 = $a3->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b3[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b3[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b3[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>


	<!-- ############## Free Plugins ################ -->
	<?php $s4 = new WP_Query( $args4 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Free Plugins</h2>
	<div class="sites clearfix">
	<?php if ($s4->have_posts()) : while ($s4->have_posts()) : $s4->the_post(); ?>
	<?php $a4 = new TypeFinalists(); $b4 = $a4->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b4[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b4[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b4[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>

	<!-- ############## Commercial Plugins ################ -->
	<?php $s5 = new WP_Query( $args5 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Commercial Plugins</h2>
	<div class="sites clearfix">
	<?php if ($s5->have_posts()) : while ($s5->have_posts()) : $s5->the_post(); ?>
	<?php $a5 = new TypeFinalists(); $b5 = $a5->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b5[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b5[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b5[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>


	<!-- ############## Free Themes ################ -->
	<?php $s6 = new WP_Query( $args6 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Free Themes</h2>
	<div class="sites clearfix">
	<?php if ($s6->have_posts()) : while ($s6->have_posts()) : $s6->the_post(); ?>
	<?php $a6 = new TypeFinalists(); $b6 = $a6->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b6[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b6[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b6[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>
			
	<!-- ############## Commercial Themes ################ -->
	<?php $s7 = new WP_Query( $args7 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Commercial Themes</h2>
	<div class="sites clearfix">
	<?php if ($s7->have_posts()) : while ($s7->have_posts()) : $s7->the_post(); ?>
	<?php $a7 = new TypeFinalists(); $b7 = $a7->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b7[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b7[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b7[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>

	<!-- ############## Theme Frameworks ################ -->
	<?php $s8 = new WP_Query( $args8 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Theme Frameworks</h2>
	<div class="sites clearfix">
	<?php if ($s8->have_posts()) : while ($s8->have_posts()) : $s8->the_post(); ?>
	<?php $a8 = new TypeFinalists(); $b8 = $a8->mshot(200); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="site-thumbnail">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $b8[2]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b8[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $b8[3]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
			<div class="honorentry">
				<div class="entry"><?php the_excerpt( __( '(More ...)' )); ?></div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>



	<!-- ############## Designer Personalities ################ -->
	<?php $s9 = new WP_Query( $args9 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Designers</h2>
	<div class="sites clearfix">
	<?php if ($s9->have_posts()) : while ($s9->have_posts()) : $s9->the_post(); ?>
	<?php $a9 = new TypeFinalists(); $b9 = $a9->mshot(200); $c9 = $a9->twitshot(); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="pavatar">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $c9[0]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b9[0]; ?>" title="@<?php echo $c9[2];?>"><div class="ppavatar" style="background:#000 url(<?php echo $c9[1];?>) no-repeat center center;"></div></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>


	<!-- ############## Developer Personalities ################ -->
	<?php $s10 = new WP_Query( $args10 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Developers</h2>
	<div class="sites clearfix">
	<?php if ($s10->have_posts()) : while ($s10->have_posts()) : $s10->the_post(); ?>
	<?php $a10 = new TypeFinalists(); $b10 = $a10->mshot(200); $c10 = $a10->twitshot(); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="pavatar">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $c10[0]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b10[0]; ?>" title="@<?php echo $c10[2];?>"><div class="ppavatar" style="background:#000 url(<?php echo $c10[1];?>) no-repeat center center;"></div></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>				
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>


	<!-- ############## Blog Author Personalities ################ -->
	<?php $s11 = new WP_Query( $args11 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; Blog Authors</h2>
	<div class="sites clearfix">
	<?php if ($s11->have_posts()) : while ($s11->have_posts()) : $s11->the_post(); ?>
	<?php $a11 = new TypeFinalists(); $b11 = $a11->mshot(200); $c11 = $a11->twitshot(); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="pavatar">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $c11[0]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b11[0]; ?>" title="@<?php echo $c11[2];?>"><div class="ppavatar" style="background:#000 url(<?php echo $c11[1];?>) no-repeat center center;"></div></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>				
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>


	<!-- ############## WP Community Personalities ################ -->
	<?php $s12 = new WP_Query( $args12 ); ?>
		<h2 class="breadcrumb">Category &rsaquo; WP Community</h2>
	<div class="sites clearfix">
	<?php if ($s12->have_posts()) : while ($s12->have_posts()) : $s12->the_post(); ?>
	<?php $a12 = new TypeFinalists(); $b12 = $a12->mshot(200); $c12 = $a12->twitshot(); ?>	
		<div id="site-<?php the_ID(); ?>" class="finalists clearfix">
			<div class="pavatar">
				<div class="post-data">
					<h3 class="post-title"><a href="<?php echo $c12[0]; ?>"><?php the_title(); ?></a></h3>
					<a href="<?php echo $b12[0]; ?>" title="@<?php echo $c12[2];?>"><div class="ppavatar" style="background:#000 url(<?php echo $c12[1];?>) no-repeat center center;"></div></a>
					<div class="votebadge"><?php if( function_exists( 'getILikeThis' )) { getILikeThis('get'); } ?></div>
<!--
					<div class="tweet">
						<div class="fl"><?php echo twitter_button(); ?></div>
						<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
					</div>
-->				</div>				
			</div>
		</div>
	<?php wp_reset_query(); endwhile; endif; ?>
	</div>

	</div>
	<div id="content-sub"><?php get_sidebar(); ?></div>
</div>
<?php get_footer(); ?>