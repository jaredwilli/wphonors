<?php get_template_part( 'branding' ); ?>

<div id="content" class="inner clearfix">
	<div id="content-main" class="single">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php 
			$p = new TypePersons();
			$twit = $p->twitshot();
			$webs = $p->pshot(240);
		?>

		<div id="person-<?php the_ID(); ?>" class="person user-id-<?php the_author_meta('ID'); ?> sites" >
            
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

			<h1 class="post-title"><?= ucwords(get_post_type())?> Entry <a href="<?php echo $webs[0]; ?>"><?php the_title(); ?></a></h1>

                <ul class="postinfo clearfix">
                    <li class="psite">
                        <a href="<?php echo $webs[0]; ?>" title="<?php the_title(); ?>'s Website" target="_blank">Website</a>
                    </li>
                    <li class="ptwit">
                        <a href="<?php echo $twit[0]; ?>" title="@<?php echo $twit[2];?>" target="_blank">Twitter</a>
                    </li>
                    <li class="ppcomments">
                        <?php comments_popup_link( __( '0 Comments' ), __( '1 Comment' ), __( '% Comments' )); ?>
                    </li>
	            <li class="post-tags">
        	        <?php the_tags( __( ' ' ), ' , ', ' ' ); ?>
		   </li>
                </ul>

<!--
			<div class="site-bigthumb fr">
				<a href="<?php echo $webs[0]; ?>" title="Visit <?php the_title(); ?>'s Website" target="_blank">
					<img src="<?php echo $webs[1]; ?>" alt="<?php the_title(); ?>'s Website" width="240" />
				</a>
			</div>
-->
			
			<div class="honorsentry">
				<div class="pavatar">
					<a href="<?php echo $twit[0]; ?>" title="@<?php echo $twit[2];?>" target="_blank">
					<div class="ppavatar" style="background:#000 url(<?php echo $twit[1];?>) no-repeat center center;"></div>
					</a>
				</div>
			</div>

		<div class="honorsentry">
			<div class="entry">
				<h2 class="post-title"><?php the_title(); ?></h2>

				<?php the_content( __( '(More ...)' )); ?>

					<div id="vote4me">
					  <p>This your sweet mug? <br />
					Add this sweet button to your site:<br />
						<a href="<?php the_permalink();?>"><img src="http://2010.wphonors.com/wp-content/buttons/wphonors3.png" alt="Vote4Me <?php the_title(); ?> at 2010.WPHonors.com" /></a></p>


					<textarea name="buttoncode" id="buttoncode" cols="20" onclick="this.focus(); this.select();" rows="1">&lt;!-- WPHonors Vote4Me Button --&gt;<?php echo "\n"?>&lt;a href="<?php the_permalink(); ?>"&gt;&lt;img src="http://2010.wphonors.com/wp-content/buttons/wphonors3.png" alt="Vote4Me <?php the_title(); ?> at 2010.WPHonors.com" /&gt;&lt;/a&gt;<?php echo "\n"?>&lt;!--//WPHonors Vote4Me Button --&gt;</textarea>

					</div>


			</div>

			<div class="edit-post" style="clear:both;">
				<?php edit_post_link( __( 'edit post' )); ?>
			</div>

</div>

	</div>
	<br style="clear:both"/>
	<?php comments_template(); ?>

	<?php endwhile; ?>
		<?php if( function_exists( 'wp_pagenavi' )) { wp_pagenavi(); } else { ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;'); ?></div>
		</div>
		<?php } ?>
	<?php else : ?>
	<div id="message message_404">
		<h2 class="title">Nothing found...</h2>
		<p>There are no people posted here yet.</p>
	</div>
	<?php endif; ?>

	</div><!-- end #content-main -->	
</div><!-- end #content -->
<?php get_footer(); ?>