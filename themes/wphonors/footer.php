	<div id="footer">
		<div id="site-info" class="inner clearfix">
	
			<?php wp_nav_menu( array( 'menu' => 'Footer', 'class' => 'footer-menu', 'container' => false, 'theme_location' => 'Footer Navigation' )); ?>
			
		  <p id="copyright">
				&copy;<?php echo date("Y"); ?> <a href="<?php home_url('/'); ?>"><?php bloginfo('name'); ?></a> - WordPress v.<?php bloginfo('version');?><br />
				Developed by <a href="http://twitter.com/jaredwilli" target="_blank">Jared Williams</a> of <a href="http://new2wp.com" rel="bookmark" target="_blank">New2WP.com</a> <a title="WordPress Hosting" href="http://page.ly">WordPress Hosting</a> by Page.ly.
			<br />
			This site is not endorsed by WordPress in any way.
			</p>
		</div>

	</div>
</div><!--// end #wrapper -->

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>

<div id="dialog" style="display:none;">
<?php 
if( !is_user_logged_in() ) { 
	get_template_part( 'functions/userForm' ); 
} else { 
	//get_template_part( 'post-form' );
} 
?>
</div>

<?php wp_footer(); ?>

<link rel="stylesheet" type="text/css" href="http://jquery.com/demo/thickbox/thickbox-code/thickbox.css" media="screen" />
<script type="text/javascript" src="http://jquery.com/demo/thickbox/thickbox-code/thickbox-compressed.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>

<?php if (is_page(150)) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.validationEngine.js"></script>
<!--<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.jqtransform.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/contactscript.js"></script>
-->
<?php } ?>


<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/global.js"></script>

<?php if ( !is_404() || !is_home() || !is_page() ) { ?>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<?php } ?>

<?php if (is_404()) { ?>
<div style="background: url(http://2010.wphonors.com/wp-content/themes/wphonors/images/kanye.png) no-repeat; width:460px; height:652px; z-index:1000;position:absolute;top:185px;right:0px;"></div>
<?php } ?>

<?php if (is_singular()) { wp_enqueue_script( 'comment-reply' ); } ?>
<?php wp_enqueue_script( 'suggest' ); ?>
<?php // wp_enqueue_script( 'json-form' ); ?>


<!--<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.infinitescroll.js"></script>
<script type="text/javascript">
$(function(){
	$('#content-main').infinitescroll({
		navSelector  : "#next",
		nextSelector : "a.nextpostslink",
		itemSelector : ".sites",
	});
});
</script>
-->
</body>
</html>
