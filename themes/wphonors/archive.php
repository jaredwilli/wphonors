<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" role="main">

<?php if (have_posts()) : ?>
<?php rewind_posts(); ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if ( is_category() ) { ?>
		<h3 class="breadcrumb"><?php bloginfo('name'); ?> &gt; <?php single_cat_title(); ?></h3>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3 class="breadcrumb">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h3>
	<?php /* If this is a daily archive */ } elseif ( is_day() ) { ?>
		<h3 class="breadcrumb">Archive for <?php the_time('F jS, Y'); ?></h3>
	<?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
		<h3 class="breadcrumb">Archive for <?php the_time(' F, Y'); ?></h3>
	<?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
		<h3 class="breadcrumb">Archive for <?php the_time('Y'); ?></h3>
	<?php /* If this is an author archive */ } elseif ( is_author() ) { ?>
		<h3 class="breadcrumb">Author Archive</h3>
	<?php /* If this is a paged archive */ } elseif ( isset($_GET['paged'] ) && !empty( $_GET['paged'] )) { ?>
		<h3 class="breadcrumb">Blog Archives</h3>
	<?php } ?>

		<?php if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
		<?php } ?>
	
	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">

			<div class="post-data">
				<div class="fr">
					<?php echo twitter_button(); ?>
				</div>
				<div class="votebadge">
					<?php if( function_exists( getILikeThis )) { getILikeThis('get'); } ?>
				</div>
			</div>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<ul class="postinfo clearfix">
				<li class="pdate"><?php the_time('M j, Y'); ?></li>
				<li class="pauthor"><?php the_author_posts_link();?></li>
				<li class="pcomments"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></li>
			</ul>
			<div class="entry clearfix">
				<?php the_content(__('Read more')); ?>
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