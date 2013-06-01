<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" class="error-404 sites" role="main">

		<div id="searchform404">
			<form method="get" id="searchform" action="<?php site_url(); ?>">
				<input type="text" value="Search to finish" name="s" id="s" value="Search" onFocus="this.value=''" size="40" />
				<input type="submit" id="searchsubmit" value="Find It" />
			</form>
		</div>

		<h1><?php _e( 'Yo WP Honors!!' ); ?></h1>
		<h3><?php _e( 'Imma let you finish, <span id="wp" class="wordpress">WordPress</span> has the <span class="best">best</span> community of all time.' ); ?></h3>
		<h2><?php _e( 'OF ALL TIME!!!' ); ?></h2>


	</div>
	<div id="content-sub">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>