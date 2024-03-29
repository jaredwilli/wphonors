<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" class="single">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php $t = new TypeThemes(); $a = $t->themeshot(400);  // var_dump($a[0]); ?>

		<div id="theme-<?php the_ID(); ?>" class="sites clearfix">
            
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
				<div class="fr"><?php echo twitter_button(); ?></div>
<a name="fb_share" type="button_count" share_url="<?php the_permalink();?>" href="http://www.facebook.com/sharer.php">Share</a>
            </div>

			<h1 class="post-title"><?= ucwords(get_post_type())?> Entry <a href="<?php echo $a[0]; ?>"><?php the_title(); ?></a></h1>
			<ul class="postinfo clearfix">
				<li class="pcomments"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></li>
			</ul>

			<div class="site-bigthumb fl">
				<a href="<?php echo $a[0]; ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $a[1]; ?>" alt="<?php the_title(); ?> Website" /></a>
			</div>

			<div class="honorentry">

				<div class="entry">
					<h2 class="post-title"><?php the_title(); ?></h2>
					<?php the_content( __( '(More ...)' )); ?>

					<div id="vote4me">
					  <p>This your plugin? <br />
					Add this sweet button to your site:<br />
						<a href="<?php the_permalink();?>"><img src="http://2010.wphonors.com/wp-content/buttons/wphonors3.png" alt="Vote4Me <?php the_title(); ?> at 2010.WPHonors.com" /></a></p>

					<textarea name="buttoncode" id="buttoncode" cols="20" onclick="this.focus(); this.select();" rows="1">&lt;!-- WPHonors Vote4Me Button --&gt;<?php echo "\n"?>&lt;a href="<?php the_permalink(); ?>"&gt;&lt;img src="http://2010.wphonors.com/wp-content/buttons/wphonors3.png" alt="Vote4Me <?php the_title(); ?> at 2010.WPHonors.com" /&gt;&lt;/a&gt;<?php echo "\n"?>&lt;!--//WPHonors Vote4Me Button --&gt;</textarea>

					</div>
				</div>
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
	<?php else: ?>
	<div id="message message_404">
		<h2 class="title">Not Found</h2>
		<p>There are no themes posted yet...</p>
	</div>
	<?php endif; ?>

	</div><!-- end #content-main -->
</div><!-- end #content -->
<?php get_footer(); ?>