<div id="sidebar">
	<ul>
		<?php if(function_exists('dynamic_sidebar')) { dynamic_sidebar('HomePage'); } ?>

	<?php if( !is_home() || !is_404() ) { ?>
	<li><h2 class="home-latest">Latest Submissions</h2>
		<ul>
		<?php $wpsnip = new WP_Query( array( 'post_type' => array( 'site', 'theme', 'plugin', 'person' ), 'showposts' => 15 )); ?>

			<?php if($wpsnip->have_posts()): while($wpsnip->have_posts()) : $wpsnip->the_post(); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php $posttype = get_post_type( $post->ID ); if( $posttype) { echo '('.$posttype.')'; } ?></li>
			<?php endwhile; endif; ?>
		</ul>
	</li>
	<?php } ?>

<?php function showDefault() { // Default Sidebar Content ?>
<!--
	<li id="searchbox"><?php get_search_form(); ?></li>
	<li id="nav-level-3">
-->		
		<?php /*
		global $wp_query;
		$post = $wp_query->post;
		$ancestors = get_post_ancestors($post);
		print_r($ancestors);
		if (empty($post->post_parent)) {
			$parent = $post->ID;
		} else {
			$parent = end($ancestors);
		}
		// If the page is more than 1 level deep build the subnav (don't show on the homepage)
		if($ancestors) {
			// If a page is 3 or more levels deep
			if(count($ancestors) > 1) {
				$section_ID = $ancestors[0];
			// If a page is 2 levels deep
			} else { 
				$section_ID = $post->ID;
			}
			$subnav = wp_list_pages('sort_column=menu_order&title_li=&child_of='.$section_ID.'&echo=0');
		}
		// If the subnav has been built display it
		if ($subnav) {	
			echo $subnav;
		}
		*/?>
<!--
	</li>
-->	
		
	
<?php } ?>
	
<?php // Load Dynamic Sidebars
if(!function_exists('dynamic_sidebar')) { 
	showDefault();
} else { 
	if(is_page()) {
		if(!dynamic_sidebar('Page')) {
			showDefault();
		}
	} else {
		if(!dynamic_sidebar('Blog')) {
				showDefault();	
		}
	}
}
?>
</ul><!-- end #sidebar -->
</div>