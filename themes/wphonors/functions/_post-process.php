<?php
require_once('../../../../wp-config.php');

global $wpdb;

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

if( $_POST['post_type'] == 'site' ) {

	$title = $_POST['title'];
	$desc = $_POST['description'];
	$siteurl = $_POST['siteurl'];
	$cat = array( $_POST['cat'] );
	$tags = trim( $_POST['tags'] );
	
	if(!isset($title)) { echo '<div class="error">Title required.</div>'; }
	if(!isset($desc)) { echo '<div class="error">Description required.</div>'; }
	if(!isset($siteurl)) { echo '<div class="error">URL required.</div>'; }
	if($cat == -1) { echo '<div class="error">Select a category.</div>'; }
	if(!isset($tags)) { echo '<div class="error">Must use at least one tag.</div>'; }

	if (!current_user_can( 'publish_posts')) { $poststatus = 'draft'; } else { $poststatus = 'publish'; } 

	//$insert = new TypeSites();
		$post = array(
			'post_title'	=> $title,
			'post_content'	=> $desc,
			'siteurl'	=> $siteurl,
			'post_category'	=> $cat,
			'tags_input'	=> $tags,
			'post_status'	=> $poststatus,
			'post_type'	=> 'site'
		);
		wp_insert_post( $post );
	// $insert->wp_insert_post( $post_id, $post );	
	wp_redirect( site_url('sites/') );

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
} elseif( $_POST['post_type'] == 'plugin' ) {

	$title = $_POST['title'];
	$desc = $_POST['description'];
	$pluginurl = $_POST['pluginurl'];
	$cat = array( $_POST['cat'] );
	$tags = trim( $_POST['tags'] );

	if (!current_user_can( 'publish_posts')) { $poststatus = 'draft'; } else { $poststatus = 'publish'; } 

	$insert = new TypePlugins();
		$post = array(
			'post_title'	=> $title,
			'post_content'	=> $desc,
			'pluginurl'	=> $pluginurl,
			'post_category'	=> $cat,
			'tags_input'	=> $tags,
			'post_status'	=> $poststatus,
			'post_type'	=> 'plugin'
		);
		wp_insert_post( $post );
	$insert->wp_insert_post( $post );
	wp_redirect(site_url('plugins/'));

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
} elseif( $_POST['post_type'] == 'theme' ) {

	$title = $_POST['title'];
	$desc = $_POST['description'];
	$themeurl = $_POST['themeurl'];
	$cat = array( $_POST['cat'] );
	$tags = trim( $_POST['tags'] );
	
	if (!current_user_can( 'publish_posts')) { $poststatus = 'draft'; } else { $poststatus = 'publish'; } 

	$insert = new TypeThemes();
		$post = array(
			'post_title'	=> $title,
			'post_content'	=> $desc,
			'themeurl'	=> $themeurl,
			'post_category'	=> $cat,
			'tags_input'	=> $tags,
			'post_status'	=> $poststatus,
			'post_type'	=> 'theme'
		);
		wp_insert_post( $post );
	$insert->wp_insert_post( $post );
	wp_redirect(site_url('themes/'));

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
} elseif( $_POST['post_type'] == 'person' ) {

	$title = $_POST['title'];
	$desc = $_POST['description'];
	$personurl = $_POST['personurl'];
	$twit = $_POST['twitname'];
	$cat = array( $_POST['cat'] );
	$tags = trim( $_POST['tags'] );

	if (!current_user_can( 'publish_posts')) { $poststatus = 'draft'; } else { $poststatus = 'publish'; } 

	$insert = new TypePersons();
		$post = array(
			'post_title'	=> $title,
			'post_content'	=> $desc,
			'personurl'	=> $personurl,
			'twitname'	=> $twit,
			'post_category'	=> $cat,
			'tags_input'	=> $tags,
			'post_status'	=> $poststatus,
			'post_type'	=> 'person'
		);
		wp_insert_post( $post );
	$insert->wp_insert_post( $post );	
	wp_redirect(site_url('personalities/'));

} // end IF()

?>