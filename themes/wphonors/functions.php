<?php
define( 'WPH_FUNC_PATH',  get_template_directory() . '/functions' );
define( 'WPH_FUNC_URL', get_bloginfo('template_directory' ).'/functions' );
define( 'WPH_JS_PATH',  get_template_directory() . '/js' );
define( 'WPH_JS_URL', get_bloginfo('template_directory' ).'/js' );

$functionsdir = TEMPLATEPATH . '/functions';
get_template_part( 'functions/posttypes' );

get_template_part( 'functions/contest/prizes' );
get_template_part( 'functions/contest/prizes_admin' );

get_template_part( 'functions/judges_admin' );

add_action( 'admin_head', 'admin_register_head' );
add_action( 'get_header', 'redirect_to_first_child', 2 );

add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
add_action( 'wp_dashboard_setup', 'custom_dashboard_widgets' );

add_filter( 'admin_body_class', 'base_admin_body_class' );
add_filter( 'admin_footer_text', 'custom_admin_footer' );
add_filter( 'user_contactmethods','add_prof_field', 10, 1 );
add_action( 'login_head', 'custom_login_logo' );

add_action( 'wp_head', 'js_scripts' );
//add_filter( 'wp_list_pages','base_better_lists' );
add_filter( 'wp_list_categories','base_better_lists' );
// add_filter( 'get_the_excerpt', 'trim_excerpt' );
add_filter( 'the_generator', 'complete_version_removal' );

add_filter( 'the_search_query', 'searchAll' );
add_filter( 'request', 'custom_feed_request' );


// Add 3.0 Theme Supports
add_theme_support( 'menus' );
add_action( 'init', 'register_navmenus' );

function register_navmenus() {
	register_nav_menus( array(
		'Top' 		=> __( 'Top Navigation' ),
		'Header'	=> __( 'Header Navigation' ),
		'Footer'	=> __( 'Footer Navigation' ),
	));
}
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/* * * * * * * * * *  Functions and Stuff for Me * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/**
 * Search all post types
 */
function searchAll( $query ) {
	if ( $query->is_search ) { $query->set( 'post_type', array( 'site','plugin', 'theme','person' )); } 
	return $query;
}

/**
 * Url regex
 */
function checkUrl( $poststr ) {
	return preg_match( "/^((http(s)?)+:\/\/)?(www\d?.)?|([a-zA-Z0-9\.\-_])\.+)?([a-zA-Z0-9]+\-?)+(\.\w[2,6])+(\/?([a-zA-Z0-9]+?[\\\/\-\.\?&#%=_]+?\/))?$/", $poststr );
}


/**
 * Remove Dashboard Widgets
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	if ( !current_user_can( 'publish_posts' )) {
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	}
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
//	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}


/**
 * Get user Gravatar
 */
function member_get_avatar( $wpcom_user_id, $email, $size, $rating = '', $default = 'http://s.wordpress.com/i/mu.gif' ) {
	if( !empty( $wpcom_user_id ) && $wpcom_user_id !== false && function_exists('get_avatar')) {
		return get_avatar( $wpcom_user_id, $size );
	}
	elseif( !empty( $email ) && $email !== false ) {
		$default = urlencode( $default );
		$out = 'http://www.gravatar.com/avatar.php?gravatar_id=';
		$out .= md5( $email );
		$out .= "&amp;size={$size}";
		$out .= "&amp;default={$default}";
		if( !empty( $rating ) ) { $out .= "&amp;rating={$rating}"; }
		return "<img alt='' src='{$out}' class='avatar avatar-{$size}' height='{$size}' width='{$size}' />";
	} else { return "<img alt='' src='{$default}' />"; }
}

/**
 * Add custom post types to feed
 */
function custom_feed_request( $vars ) {
	if (isset($vars['feed']) && !isset($vars['post_type']))
		$vars['post_type'] = array( 'post', 'site', 'plugin', 'theme', 'person' );
	return $vars;
}


/**
 * Add Twitter profile field and remove Yahoo IM 
 */
function add_prof_field($contactmethods) {
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	return $contactmethods;
}


/**
 * Twitter Button
 */
function new_twitter_button() { ?>
	<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="jaredwilli">Tweet</a>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php 
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/* * * * * * * * * Functions and Custom Settings * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

//Add 'first' and 'last' classes to ends of wp_list_pages and wp_list_categories
/*
function base_better_lists($content) {
	$pattern = '/<li class="/is';
	$content = preg_replace($pattern, '<li class="first ', $content, 1);
	$pattern = '/<li class="(?!.*<li class=")/is';
	$content = preg_replace($pattern, '<li class="last ', $content, 1);
	return $content;
}
*/

// Redirect parent pages to first child
function redirect_to_first_child(){
	global $post; 
	# UNCOMMENT THE LINE BELOW TO DISABLE FOR CHILD PAGES (ie not to level pages)
	//if($post->post_parent != 0) return;
	if( !empty( $post->ID ) ) {
		$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
		if( function_exists('pods_menu') ) {
			if (is_pod_page()) {
				break;
			}
		} 
		if (!get_post_meta($post->ID, 'dont_redirect', true) && $pagekids && !isset($_GET['s']) && is_page()) {
			$firstchild = $pagekids[0];
			wp_redirect(get_permalink($firstchild->ID));
		}
	}
}

/**
 * Additional Admin Styles and custom Branding
 */
function admin_register_head() { $url = get_bloginfo('template_directory') . '/css/admin.css'; echo '<link rel="stylesheet" type="text/css" href="' . $url . '" />'; ?>

<script type="text/javascript">var _gaq=_gaq||[];_gaq.push(['_setAccount','UA-17980655-1']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s)})();</script>

<?php }
/***/
function custom_admin_footer() { echo '<a href="http://new2wp.com">Theme created by New2WP.com</a>'; }
/** Login logo */
function custom_login_logo() {
	echo '<style type="text/css">#login h1 { position: relative; top:10px; height:113px; } 
	#login h1 a{ background-image:url(http://2010.wphonors.com/wp-content/uploads/wphonors11.png) !important; height:113px; } 
	#loginform { background: #eee; border:1px solid #ccc; }
	.updated,.login .message { background-color: #eee; border-color: #ccc; }</style>';
}


/**
 * Load Scripts
	jQuery 1.4.2	-	jquery
	jQuery UI Core	-	jquery-ui-core
	jQuery UI Tabs 	-	jquery-ui-tabs
	jQuery Thickbox	-	thickbox
	jQuery Tools 	-	jqtools
**/	 
function js_scripts() {
	if( !is_admin() ){
		wp_deregister_script( 'jquery' );
		wp_register_script	( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, '1.4.2', true );
		wp_register_script	( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js', false, '1.8.2', true );
		wp_register_script	( 'jqtools', 
'http://cdn.jquerytools.org/1.2.3/jquery.tools.min.js' );
		wp_enqueue_script	( 'jquery' );
		wp_enqueue_script	( 'jqueryui' );
		wp_enqueue_script	( 'thickbox' );
		// load a JS file from my theme: js/theme.js
		wp_print_scripts ( 'globaljs', get_bloginfo('template_url').'/js/global.js', 
				  	array	( 'jquery', 'jqueryui', 'thickbox' ), '1.0', true);
	}
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/* * * * * * * * * Useful Functions and Features * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// remove [...] from excerpts
function trim_excerpt($text) { return rtrim($text,'[...]'); }

// remove version info from head and feeds
function complete_version_removal() { return ''; }

/**
 * Add support for post thumbnails and add thumb 
 * image to coloumn to post manage page
 *
 * @param, since 2.9
**/
// Add support for post thumbnails, and show them in edit post list

if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) { 
	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ));
	
	function fb_AddThumbColumn($cols) { $cols['thumbnail'] = __('Thumbnail'); return $cols; }
	function fb_AddThumbValue( $column_name, $post_id ) { 
		$width = (int) 90;
		$height = (int) 90;

		if ( 'thumbnail' == $column_name ) {
			// thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			// image from gallery
			$attachments = get_children( array(
				'post_parent' => $post_id, 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image'
				)
			);
			
			if ( $thumbnail_id ) $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ( $attachments ) { foreach ( $attachments as $attachment_id => $attachment ) { $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true ); } }
			if ( isset($thumb) && $thumb ) { echo $thumb; } else { echo __('None'); }
		}
	}
	// post thumbnails column on posts manage page
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
 
	// page thumbnails on pages manage page
	add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}

// List the terms for Categories taxonomy
function category_terms_list() { // list Categories taxonomy
	wp_list_categories( array( 'style' => 'list', 'hide_empty' => 0, 'taxonomy' => 'category', 'hierarchical' => true, 'title_li' => __( 'Categories' ) ) ); return;
}
// List the terms for Tags taxonomy
function tags_terms_list() { // list Tags taxonomy
	wp_list_categories( array( 'style' => 'list', 'hide_empty' => 0, 'taxonomy' => 'post_tags', 'hierarchical' => true, 'title_li' => __( 'Tags' ) )); return; 
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


// admin classes
function base_admin_body_class( $classes ) {
	if (is_admin() && isset($_GET['action'])) { $classes .= 'action-'.$_GET['action']; }
	if (is_admin() && isset($_GET['post'])){ $classes .= ' '; $classes.='post-'.$_GET['post']; }
	// Return the $classes array
	return $classes;
}

// Generates semantic classes for BODY element
function base_body_class( $print = true ) {
	global $wp_query, $current_user;
	// It's surely a WordPress blog, right?
	$c = array('wordpress');
	// Applies the time- and date-based classes (below) to BODY element
	thematic_date_classes( time(), $c );
	// Generic semantic classes for what type of content is displayed
	is_front_page()	? $c[] = 'home' 		: null; // For the front page, if set
	is_home() 		? $c[] = 'blog' 		: null; // For the blog posts page, if set
	is_archive() 	? $c[] = 'archive' 		: null;
	is_date() 		? $c[] = 'date' 		: null;
	is_search() 	? $c[] = 'search' 		: null;
	is_paged() 		? $c[] = 'paged' 		: null;
	is_page()		? $c[] = 'page'			: null;
	is_single()		? $c[] = 'post'			: null;
	is_attachment()	? $c[] = 'attachment' 	: null;
	is_404() 		? $c[] = 'four04' 		: null; // CSS doesnt allow a digit as first char		
	is_tax() 		? $c[] = 'taxonomy' 	: null;
	
	// Special classes for BODY element when a singular post
	if (is_singular()) { $c[] = 'singular'; } else { $c[] = 'not-singular'; }
	// Special classes for BODY element when on a single post
	if (is_single()) {
		$postID = $wp_query->post->ID;
		the_post();
		// Adds post slug class, prefixed by 'slug-'
		$c[] = 'slug-' . $wp_query->post->post_name;
		// Adds 'single' class and class with the post ID
		$c[] = 'single postid-' . $postID;
		// Adds classes for the month, day, and hour when the post was published
		if (isset( $wp_query->post->post_date ))
			thematic_date_classes( mysql2date( 'U', $wp_query->post->post_date ), $c, 's-' );
		// Adds category classes for each category on single posts
		if ($cats = get_the_category()) foreach ($cats as $cat) $c[] = 's-category-'.$cat->slug;
		// Adds tag classes for each tags on single posts
		if ($tags = get_the_tags()) foreach ($tags as $tag) $c[] = 's-tag-'.$tag->slug;
		// Adds taxonomy classes for each tax on single posts
		$taxonomy = get_taxonomy( get_query_var( 'taxonomy' )); 
		$tax = $wp_query->get_queried_object();
		if ($tax = $wp_query->get_queried_object()) 
			foreach ($tax as $taxi) $c[] = 's-tax-'.$taxi->slug;
		// Adds MIME-specific classes for attachments
		if (is_attachment()) {
			$mime_type = get_post_mime_type();
			$mime_prefix=array('application/', 'image/', 'text/', 'audio/', 'video/', 'music/');
			$c[] = 'attachmentid-' . $postID . ' attachment-' . str_replace( $mime_prefix, "", "$mime_type" );
		}
		// Adds author class for the post author
		$c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author_meta('login')));
		rewind_posts();
		// For posts with excerpts
		if (has_excerpt()) $c[] = 's-has-excerpt';
		// For posts with comments open or closed
		if (comments_open()) { $c[] = 's-comments-open'; } else { $c[] = 's-comments-closed'; }
		// For posts with pings open or closed
		if (pings_open()) { $c[] = 's-pings-open'; } else { $c[] = 's-pings-closed'; }
		// For password-protected posts
		if ($post->post_password) $c[] = 's-protected';
		// For sticky posts
		if (is_sticky()) $c[] = 's-sticky';	 
	} // end IF is_single()
	// Author name classes for BODY on author archives
	elseif (is_author()) {
		$author = $wp_query->get_queried_object();
		$c[] = 'author';
		$c[] = 'author-' . $author->user_nicename;
	}
	// Taxonomy name classes for BODY on category archvies
	elseif (is_category() || is_tag() || is_tax() ) {
		global $wp_query;
		$term = $wp_query->get_queried_object();
		return locate_template( array( "taxonomy-{$term->taxonomy}-{$term->slug}.php", "taxonomy-{$term->taxonomy}.php", 'taxonomy.php', 'archive.php' ) );
	}
	
	// Page author for BODY on 'pages'
	elseif (is_page()) {
		$pageID = $wp_query->post->ID;
		$page_children = wp_list_pages("child_of=$pageID&echo=0");
		the_post();
		// Adds post slug class, prefixed by 'slug-'
		$c[] = 'slug-' . $wp_query->post->post_name;
		$c[] = 'page pageid-' . $pageID;
		// Checks to see if the page has children and/or is a child page; props to Adam
		if ($page_children) $c[] = 'page-parent';
		if ($wp_query->post->post_parent) $c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;
		// For pages with excerpts
		if (has_excerpt()) $c[] = 'page-has-excerpt';
		// For pages with comments open or closed
		if (comments_open()) { $c[] = 'page-comments-open';	} 
			else { $c[] = 'page-comments-closed'; }
		// For pages with pings open or closed
		if (pings_open()) { $c[] = 'page-pings-open'; } else { $c[] = 'page-pings-closed'; }
		// For password-protected pages
		if ($post->post_password) $c[] = 'page-protected';
		// Checks to see if the page is using a template	
		if (is_page_template() & !is_page_template('default'))
			$c[] = 'page-template page-template-' . str_replace( '.php', '-php', get_post_meta( $pageID, '_wp_page_template', true ) );
		rewind_posts();
	}

	// Search classes for results or no results
	elseif (is_search()) { the_post();
		if ( have_posts() ) { $c[] = 'search-results'; } else { $c[] = 'search-no-results'; }
		rewind_posts();
	}
	// For when a visitor is logged in while browsing
	if ( $current_user->ID ) $c[] = 'loggedin';
	// Paged classes; for 'page X' classes of index, single, etc.
	if ( (( $page = $wp_query->get( 'paged' )) || ( $page = $wp_query->get( 'page' )) ) && $page > 1 ) {
	
	// Thanks to Prentiss Riddle, twitter.com/pzriddle, for the security fix below.
	// Ensures that an integer (not some dangerous script) is passed for the variable
		$page = intval($page);	
		$c[] = 'paged-' . $page;
		if ( is_single()) 		{ $c[] = 'single-paged-' . $page; } 
		elseif ( is_page()) 	{ $c[] = 'page-paged-' . $page; }
		elseif ( is_category()) { $c[] = 'category-paged-' . $page; }
		elseif ( is_tag())	 	{ $c[] = 'tag-paged-' . $page; }
		elseif ( is_tax()) 		{ $c[] = 'tax-paged-' . $page; }
		elseif ( is_date()) 	{ $c[] = 'date-paged-' . $page; }
		elseif ( is_author()) 	{ $c[] = 'author-paged-' . $page; }
		elseif ( is_search()) 	{ $c[] = 'search-paged-' . $page; }
	}
	
	// A little Browser detection shall we?
	$browser = $_SERVER[ 'HTTP_USER_AGENT' ];
	// Mac, PC ...or Linux
	if ( preg_match( "/Mac/", $browser ))		 { $c[] = 'mac'; }
	elseif ( preg_match( "/Windows/", $browser)) { $c[] = 'windows'; }
	elseif ( preg_match( "/Linux/", $browser ))  { $c[] = 'linux'; }
	else { $c[] = 'unknown-os'; }
	
	// Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
	if (preg_match( "/Chrome/", $browser )) { $c[] = 'chrome'; 		/* CHROME */
		preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
		$ch_version = 'ch' . str_replace( '.', '-', $matches[1] );			
		$c[] = $ch_version; } 
	elseif (preg_match( "/Safari/", $browser )) { $c[] = 'safari';	/* SAFARI */
			preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
			$sf_version = 'sf' . str_replace( '.', '-', $matches[1] );			
			$c[] = $sf_version; }
	elseif (preg_match( "/Opera/", $browser )) { $c[] = 'opera';	/* OPERA */
			preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
			$op_version = 'op' . str_replace( '.', '-', $matches[1] );			
			$c[] = $op_version; }
	elseif (preg_match( "/MSIE/", $browser )) { $c[] = 'msie';		/* IE */
		if (preg_match( "/MSIE 6.0/", $browser)) { $c[] = 'ie6'; }	/* IE 6.0 */
		elseif (preg_match("/MSIE 7.0/",$browser)) { $c[] = 'ie7';}	/* IE 7.0 */
		elseif (preg_match("/MSIE 8.0/",$browser)) { $c[] = 'ie8';} /* IE 8.0 */
	}
	elseif (preg_match( "/Firefox/", $browser ) && 
			preg_match("/Gecko/", $browser )) { $c[] = 'firefox';	/* FIREFOX */
			preg_match( "/Firefox\/(\d)/si", $browser, $matches);
			$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
			$c[] = $ff_version; }
	else { $c[] = 'unknown-browser'; }								/* UNKNOWN BROWSER */
	// Separates classes with a single space, collates classes for BODY
	$c = join( ' ', apply_filters( 'body_class', $c ) ); // Available filter: body_class
	// And tada!
	return $print ? print($c) : $c;
}

// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
function thematic_date_classes( $t, &$c, $p = '' ) {
	$t = $t + ( get_option('gmt_offset') * 3600 );
	$c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
	$c[] = $p . 'm' . gmdate( 'm', $t ); // Month
	$c[] = $p . 'd' . gmdate( 'd', $t ); // Day
	$c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
}

// Multiple Sidebars
if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
		'name'=>'HomePage',
		'before_widget' => '<li id="%1$s" class="callout">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name'=>'Blog',
		'before_widget' => '<li id="%1$s" class="%2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name'=>'Page',
		'before_widget' => '<li id="%1$s" class="callout">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));

}

// Wordpress 2.7 Legacy Comments
function base_comment($comment, $args, $depth) {
	 $GLOBALS['comment'] = $comment; ?>
	 <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="author-data">
				<?php echo get_avatar( $comment, $size='40', $default='<path_to_url>' ); ?>
				<?php printf( __( '<h3 class="author">%s</h3>' ), get_comment_author_link() );?>
				<div class="comment-meta commentmetadata">
					<?php printf( __('%1$s at %2$s'), get_comment_date(), get_comment_time() ); ?>
					<?php edit_comment_link( __('(Edit)'),' ',''); ?>
				</div>
			</div>
<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.') ?></em>
<?php endif; ?>
			<div class="comment-entry">
				<?php comment_text() ?>
			</div>
			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	</li>
<?php
}

// Add is_child() comment Conditional
function is_child($parent) {
	global $wp_query;
	if ($wp_query->post->post_parent == $parent) { $return = true; } else { $return = false; }
	return $return;
}




/**
 * Custom Dashboard Widget
 */
function custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'wph_latest_posts_id', __( 'Last 20 Submissions' ), 'wph_latest_posts' );
	wp_add_dashboard_widget( 'wph_post_types_id', __( 'Site Navigation' ), 'wph_post_types' );

	if (current_user_can('edit_others_posts')) {
		wp_add_dashboard_widget( 'widget_most_voted_posts_id', __( 'Top Most Voted Posts' ), 'most_voted_posts' );
	}
}

function most_voted_posts() {
	global $wpdb;

	$request = "SELECT ID, post_title, meta_value FROM $wpdb->posts, $wpdb->postmeta WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND post_status = 'publish' AND meta_key = '_liked' ORDER BY $wpdb->postmeta.meta_value + 0 DESC";
	$posts = $wpdb->get_results($request);
	
	if ( current_user_can('edit_others_posts') ) {
	?>
		<table width="100%" border="0" cellspacing="5" cellpadding="5" style="padding:5px;">
			<tr>
				<th align="left"><strong>Title</strong></th>
				<th align="center"><strong>Post Type</strong></th>
				<th align="center"><strong>Votes</strong></th>
			</tr>

		<?php
		foreach ($posts as $post) {
			$post_title = stripslashes($post->post_title);
			$permalink = get_permalink($post->ID);
			$post_count = $post->meta_value;
			$posttype = get_post_type( $post->ID );
			?>
	
			<tr>
				<td><a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></td>	
				<td align="center"><?php if ($posttype == 'finalist') { echo '<strong>'. $posttype .'</strong>'; } else { echo $posttype; } ?></td>
				<td align="center"><?php echo $post_count; ?></td>
			</tr>
	<?php } ?>
		</table>
<?php }
}

function wph_latest_posts() {
	global $post;
	echo '<ul>';
	rewind_posts(); 
	$wpsnip = new WP_Query( array( 'post_type' => array( 'site', 'theme', 'plugin', 'person' ), 'showposts' => '20' ));
	if($wpsnip->have_posts()): while($wpsnip->have_posts()) : $wpsnip->the_post(); ?>
		<li><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong> 
		<?php $posttype = get_post_type( $post->ID ); if( $posttype) { echo '('.$posttype.')'; } ?></li>

	<?php wp_reset_query(); 
	endwhile; endif; 
	echo '</ul>';
}

function wph_show_latest($howmany) {
	global $post;
	echo '<ul>';
	rewind_posts(); 
	$wpsnip = new WP_Query( array( 'post_type' => array( 'site', 'theme', 'plugin', 'person' ), 'showposts' => $howmany ));
	if($wpsnip->have_posts()): while($wpsnip->have_posts()) : $wpsnip->the_post(); 
?>
		<li><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong> 
		<?php $posttype = get_post_type( $post->ID ); if( $posttype) { echo '('.$posttype.')'; } ?></li>

	<?php wp_reset_query(); 
	endwhile; endif; 
	echo '</ul>';
}


/**
 * Post Types and Categories Widget
 */
function wph_post_types() { ?>
	<ul>
		<li><strong><a href="/">Home</a></strong></li>
		<li><strong><a href="/sites/">Sites</a></strong></li>
		<li><strong><a href="/plugins/">Plugins</a></strong></li>
		<li><strong><a href="/themes/">Themes</a></strong></li>
		<li><strong><a href="/personalities/">Personalities</a></strong></li>
		<li><strong><a href="/sponsors/">Sponsors</a></strong></li>
		<li><strong><a href="/blog/">Blog</a></strong></li>
		<li><strong><a href="/contact/">Contact</a></strong></li>
	</ul>
<?php
}

/**
 * Remove dashboard menu items for Contributors
 */
function remove_menus() {
	global $menu;
	$restricted = array( 'Posts', 'Media', 'Comments', 'Tools', 'Settings' );
	end ( $menu );
	
	if (current_user_can('contributor')) {
		while ( prev( $menu )) {
			$value = explode( ' ', $menu[key( $menu )][0] );
			if ( in_array( $value[0] != NULL ? $value[0] : "" , $restricted )) { 
				unset( $menu[key( $menu )] ); 
			}
		}
	}
}
add_action( 'admin_menu', 'remove_menus' );


/* Add custom post types to Right Now dashboard widget */
add_action( 'right_now_content_table_end' , 'ucc_right_now_content_table_end' );
function ucc_right_now_content_table_end() {
	$args = array(
		'public' => true ,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	
	$post_types = get_post_types( $args , $output , $operator );
	
	foreach( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
			$text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
		echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
	}
	
	$taxonomies = get_taxonomies( $args , $output , $operator );
	
	foreach( $taxonomies as $taxonomy ) {
		$num_terms  = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ) );
		if ( current_user_can( 'manage_categories' ) ) {
			$num = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num</a>";
			$text = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
		echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
	}
}


$posttypes = get_post_types(array('site','plugin','theme','person'));
add_filter( 'getarchives_where' , "WHERE post_type = '$posttypes' AND post_status = 'publish'", 10 , 2 );
function ucc_getarchives_where_filter( $where , $r ) {
	$args = array(
		'public' => true ,
		'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	
	$post_types = get_post_types( $args , $output , $operator );
	$post_types = array_merge( $post_types , array( 'post' ) );
	$post_types = "'" . implode( "' , '" , $post_types ) . "'";
	
	return str_replace( "post_type = 'post'" , "post_type IN ( $post_types )" , $where );
}



add_action('manage_users_columns', 'wph_manage_users_columns');
add_action('manage_users_custom_column', 'wph_manage_users_custom_column', 10, 3);

function wph_manage_users_columns($column_headers) {
	unset($column_headers['posts']);
	$column_headers['custom_posts'] = 'Assets';
	return $column_headers;
}

function wph_manage_users_custom_column($custom_column, $column_name, $user_id) {
	if ($column_name == 'custom_posts') {
		$counts = _wph_get_author_post_type_counts();
		$custom_column = array();

		if (isset($counts[$user_id]) && is_array($counts[$user_id]))
			foreach($counts[$user_id] as $count) {
				$link = admin_url() . "edit.php/?post_type=" . $count['type'] . "&author=" . $user_id;
				$custom_column[] = "\t<tr><td>{$count['label']}</td><td><a href={$link}>{$count['count']}</</td></tr>";
		}
		$custom_column = implode("\n",$custom_column);

		if (empty($custom_column))
			$custom_column = "<td>0</td>";
		$custom_column = "<table>\n{$custom_column}\n</table>";
	}
	return $custom_column;
}

function _wph_get_author_post_type_counts() {
	static $counts;
	if (!isset($counts)) {
		global $wpdb, $wp_post_types;
		$sql = <<<SQL
		SELECT post_type, post_author, COUNT(*) AS post_count
		FROM {$wpdb->posts} WHERE 1 = 1
		AND post_type NOT IN ('revision', 'nav_menu_item')
		AND post_status IN ('publish', 'pending', 'draft')
		GROUP BY post_type, post_author
SQL;
		$posts = $wpdb->get_results($sql);
		foreach($posts as $post) {

			$post_type_object = $wp_post_types[$post_type = $post->post_type];
			if (!empty($post_type_object->label))
				$label = $post_type_object->label;
			else if (!empty($post_type_object->labels->name))
				$label = $post_type_object->labels->name;
			else
				$label = ucfirst(str_replace(array('-','_'),' ',$post_type));

			if (!isset($counts[$post_author = $post->post_author]))

			$counts[$post_author] = array();
			$counts[$post_author][] = array(
				'label' => $label,
				'count' => $post->post_count,
				'type' => $post->post_type,
			);
		}
	}
	return $counts;
}

?>