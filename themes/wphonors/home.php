<?php get_template_part( 'branding' ); ?>
<div id="homepage" class="inner clearfix">
	<div id="content-main">	
		
		<div class="homecta">
			<h1 class="home-title">It's Like the Oscars<sup>&reg;</sup> for WordPress<sup>&reg;</sup></h1>
			<img src="http://2010.wphonors.com./wp-content/themes/wphonors/images/trophy.png" alt="trophy" width="114" height="149" />			
			<p>Submit your favorite WordPress <a href="/themes">Theme</a>, <a href="/plugins">Plugin</a>, <a href="/sites">Site</a> or <a href="/personalities">Personality</a>, heck add yourself!. From all the submissions, Nominees will be chosen based on number of popular votes, and after a final round of voting the Winners will be awarded the "best of" honors for the year based on your votes and by our panel of judges. Did we mention our <a href="/sponsors">sponsors</a> are helping us with the most massive giveaway of WordPress goods; ever?</p>
		</div>

		<div class="homesplit clearfix">
			<div class="hleft">
				<ol class="homebox">
					<li class="active">
						<h3>1. Final Round of Voting
						<small>(Begins late Nov)</small></h3>
						 The final curated list of Nominations for each category will be chosen from all the submissions and a final round of voting will take place starting later this month. This separates the busta's from the tru playas. <em>We're kidding about the bustas, everyone is a winner right?</em>
					</li>
					<li class="closed">
						<h3>2. Call for Submissions <small>(Closed)</small></h3>
						All new submissions to be entered into the running for the chance to win Honors for 2010 are no longer being accepted. You may still <a href="/#TB_inline?height=300&amp;width=400&amp;inlineId=dialog" class="thickbox">Register</a>, and participate in the final round of voting as the deciding vote is cast for each category.
					</li>
					<li class="closed">
						<h3>3. Winners Announced <small>(Early Jan.)</small></h3>
						Winners from the pool of nominees will be chosen based on number of votes and input from our panel of judges. Winners will get the Glory and the honors of being the "Best of" for 2010.
					</li>
					<li>
						<h3>IMMA LET YOU FINISH</h3>
						VOTE TOTALS WILL NOT BE SHOWN for a very simple reason. Popularity contests are kinda stupid. Think of it like a secret ballot, this way everyone has a fair shake. Vote totals will be be revealed for the Winners come ceremony time.
					</li>
				</ol>
			</div>
			<div class="hright">
				<h2>Vote &amp; Win Stuff</h2>
				<p>From time to time prizes will be given away by our wonderful corporate sponsors to random members of this site. All you need to do is <a href="/#TB_inline?height=300&amp;width=400&amp;inlineId=dialog" class="thickbox">Register</a>, submit your faves, and VOTE. A tweet or 2 would not hurt your chances.</p>
				<h2>Pick the Winners?</h2>
				<p>You choose the winners for the most part, and a little help from our panel of judges. Popular Vote tallies will determine who makes it from the submission phase to the nomination phase. The final "best of" winners will be chosen based on a blend of the total number of your votes and judges ballot.</p>
				<h2>Who are the judges?</h2>
				<p>It's a surprise. The Honors judges come from all areas of the web industry. Some judges even work with WordPress on a daily basis but not all of them. Just to keep it squarzeey, no judge may cast a vote on a nomination in a category they or their business has an entry in. </p>

				<h2>Awards Gala</h2>
				<p>There will be an open invitation blue tuxedo awards gala in the new year to bestow the "best of" honors on all the winners. Location and Date TBD. </p>
			</div>
		</div><!--/homesplit -->
		
		<h1 style="font-size:1.8em;">5 Random Submissions (All Categories)</h1>
			
<!-- home page latest -->
<?php $posttype = array( 'site', 'plugin', 'theme', 'person' ); ?>
<?php query_posts(array( 'post_type' => $posttype, 'showposts' => '5', 'orderby' => 'rand' )); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
				<div id="site-<?php the_ID(); ?>" class="sites" style="width:590px; padding:10px 5px 10px 10px;">
			
					<?php if( get_post_type() == 'site' ) : ?>
						<?php $s = new TypeSites(); $a = $s->mshot(200); ?>
						<div class="site-thumbnail">
							<a href="<?php echo $a[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $a[1]; ?>" alt="<?php the_title(); ?>" width="200" /></a>
			
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
							</div>
						</div>
			
					<?php elseif( get_post_type() == 'plugin' ) : ?>
						<?php $pl = new TypePlugins(); $b = $pl->pluginshot(200); ?>
						<div class="site-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $b[1]; ?>" alt="<?php the_title(); ?>" width="200" />
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
							</div>
						</div>
			
					<?php elseif( get_post_type() == 'theme' ) : ?>
						<?php $t = new TypeThemes(); $c = $t->themeshot(200); ?>
						<div class="site-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $c[1]; ?>" alt="<?php the_title(); ?>" width="200" />
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
							</div>
						</div>
			
					<?php elseif( get_post_type() == 'person' ) : ?>
						<?php $p=new TypePersons(); $twit=$p->twitshot(); $webs=$p->pshot(200); ?>
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
			<?php endwhile; endif; ?>
			<!-- /home page latest -->
		</div><!-- /content-main-->

	<div id="content-sub">
		<div id="sidebar">
		<ul>
		<?php if(function_exists('dynamic_sidebar')) { dynamic_sidebar('HomePage'); } ?>
			<li><h2 class="home-latest">Latest Submissions</h2><ul>
			<?php rewind_posts(); $wpsnip = new WP_Query( array( 'post_type' => array( 'site', 'theme', 'plugin', 'person' ), 'showposts' => '10' )); ?>
				<?php if($wpsnip->have_posts()): while($wpsnip->have_posts()) : $wpsnip->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php $posttype = get_post_type( $post->ID ); if( $posttype) { echo '('.$posttype.')'; } ?></li>
			<?php wp_reset_query(); ?>
				
		<?php endwhile; endif; ?>
			</ul></li>
		</ul>
		</div><!--// sidebar -->
	</div>

</div><!--/homepage -->


<?php get_footer(); ?>