<?php
// include the _judges_admin.php
get_template_part( '/functions/_judges_admin' );

$finalist = new Finalists();
add_action( 'admin_menu', 'finalists_menu' );


/**
 * Create dashboard admin menu and pages
 */
function finalists_menu() {
    $admin = 'add_users';
	$contrib = 'edit_posts';
	$author = 'publish_posts';
	$editor = 'edit_others_posts';
    $iconpath = get_bloginfo('template_directory') . "/images/ratingmedal.png";

	add_menu_page( __( 'Finalists', 'finalists' ), __( 'Judging Criteria', 'finalists' ), $editor, 'finalists', 'criteria_finalists_page', $iconpath, 3 );
		//add_submenu_page( 'finalists', __( 'Add Finalist' ), __( 'Add Finalist' ), $editor, 'add-finalist-page', 'add_finalists_page' );
		//add_submenu_page( 'finalists', __( 'Judging Criteria' ), __( 'Judging Criteria' ), $editor, 'criteria-finalist-page', 'criteria_finalists_page' );
}


/**
 * Create finalists page
 */
function finalists_page() {
    $req_action = $_REQUEST['action']; // action: edit, delete, add
    switch ($req_action) {
        case ('delete-finalist') : 
            global $wpdb;
            $finalist_id = $_REQUEST['finalist-id'];
            $finalist_name = $_REQUEST['finalist_name'];
            $cnt = $_REQUEST['cnt'];
            $cnt_remain = $_REQUEST['cnt_remain'];
            $finalist_description = $_REQUEST['finalist_description'];
            $finalist_url = $_REQUEST['finalist_url'];
            $ptype = $_REQUEST['ptype'];
            if ($_REQUEST['action'] == 'delete-finalist') { 
				// beginning if action is delete from the delete link
			?>
                
				<div class="wrap">
                    <div class="icon32" id="icon-prize"><br /></div>
                    <h2><?php __( 'Delete A Finalist' ); ?></h2>
                    <form method="post" action="" id="posts-filter">                        
						<table cellspacing="0" class="widefat fixed">
						
                            <form method="post" action="admin.php" id="deleteform" />
                            <table class="form-table">
								<tr valign="top">
									 <th scope="row">Finalist Suggestion: </th>
									 <td><input disabled type="text" id="finalist_name" name="finalist_name" value="<?php echo $finalist_name; ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Ttl Itm: #</th>
									<td><input disabled type="text" id="cnt" name="cnt"  value="<?php echo $cnt; ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Ttl Rm: #</th>
									<td><input disabled type="text" id="cnt_remain" name="cnt_remain"  value="<?php echo $cnt_remain; ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Description: </th>
									<td><input disabled type="text" id="finalist_description" name="finalist_description"  value="<?php echo $finalist_description; ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Submission URL: </th>
									<td><input disabled type="text" id="finalist_url" name="finalist_url"  value="<?php echo $finalist_url; ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Post Type: </th>
									<td><input disabled type="text" id="ptype" name="ptype" value="<?php echo $ptype; ?>" /></td>
								</tr>
						  </table>
						<p class="submit">
							<input name="delete" type="submit" value="Delete Finalist" />
							<input name="action" type="hidden" value="delete" />
						</p>
						</form>
					</table>
					</form>
				</div>
		<?php 
		} //end of if action is delete company 

            break;	
        case ('edit') :
            global $wpdb;
            $finalist_id = $_GET['finalist-id'];
            $finalist_name = $_GET['finalist_name'];
            $cnt = $_GET['cnt'];
            $cnt_remain = $_GET['cnt_remain'];
            $finalist_description = $_GET['finalist_description'];
            $finalist_url = $_GET['finalist_url'];
            $ptype = $_GET['ptype'];
		?>
			
            <div class="wrap">
				<div class="icon32" id="icon-prize"><br /></div>					
			   <form method="post" action="" id="posts-filter" />
					<table cellspacing="0" class="widefat fixed">

						<h2><?php __( 'Edit Finalist' ); ?></h2>
						<form method="post" action="admin.php" id="updateform" />

							<table class="form-table" id="finalist-<?php echo $finalist_id; ?>">
								<tr valign="top">
									<th scope="row" align="center">ID</th>
									<td><input type="text" name="update-finalist-id" id="update-finalist-id" value="<?php if(!empty($finalist_id)){echo $finalist_id;} ?>" size="7" disabled="disabled" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Finalist: </th>
									<td><input type="text" name="update-finalist-field" id="update-finalist_field" value="<?php if(!empty($finalist_name)){echo $finalist_name;} ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Ttl. Itm: #</th>
									<td><input type="text" name="update-finalist-count-field" id="update-finalist_count_field" value="<?php if(!empty($cnt)){echo $cnt;} ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Ttl Rm: #</th>
									<td><input type="text" name="update-cnt-remain-field" id="update-cnt_remain_field" value="<?php if(!empty($cnt_remain)){echo $cnt_remain;} ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Description:</th>
									<td><input type="text" name="update-finalist-description-field" id="update-finalist_description_field" value="<?php if(!empty($finalist_description)){echo $finalist_description;} ?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Submission URL: </th>
									<td><input type="text" name="update-finalist-url-field" id="update-finalist_url_field" value="<?php if(!empty($finalist_url)){echo $finalist_url;}?>" /></td>
								</tr>
								<tr valign="top">
									<th scope="row">Post Type: </th>
									<td><input type="text" name="update-ptype-field" id="update-ptype_field" value="<?php if(!empty($ptype)){echo $ptype;} ?>" /></td>
								</tr>
							</table>
							<p class="submit">
								<input name="save" type="submit" value="Save Changes" />
								<input type="hidden" name="action" value="save" />
							</p>
						</form>
					</table>
				</form>
			</div>
		<?php
			break;
		default:
			global $wpdb;				
			$finalist_id = $_REQUEST['finalist-id'];
			$finalist_name = $_REQUEST['update-finalist-field'];
			$cnt = $_REQUEST['update-finalist-count-field'];
			$cnt_remain = $_REQUEST['update-cnt-remain-field'];
			$finalist_description = $_REQUEST['update-finalist-description-field'];
			$finalist_url = $_REQUEST['update-finalist-url-field'];
			$ptype = $_REQUEST['update-ptype-field'];
			 
			
			/**
			 * Update finalist
			 */
			if ($_REQUEST['action'] == 'save') {
				$update_sql = "UPDATE wp_finalists 
							SET finalist_name='{$finalist_name}',
								cnt='{$cnt}', 
								cnt_remain='{$cnt_remain}', 
								finalist_description='{$finalist_description}',
								finalist_url='{$finalist_url}', 
								ptype='{$ptype}' 
							WHERE id = '{$finalist_id}'";
				$wpdb->query($update_sql);
			}
			
			/**
			 * Delete finalist
			 */
			if ($_REQUEST['action'] == 'delete') {							
				$deletesql = "DELETE FROM wp_finalists WHERE id = '".$finalist_id."'";	
				$wpdb->query($deletesql);  
			}
			
			/**
			 * Message notifaction divs
			 */
			if ($_REQUEST['save']) echo '<div id="message" class="updated fade"><p><strong>Finalist settings saved.</strong></p></div>';
			if ($_REQUEST['delete']) echo '<div id="message" class="updated fade"><p><strong>Finalist deleted.</strong></p></div>';

			$current_screen = "finalists_page";
			register_column_headers( $current_screen, array(
				'pid' => 'ID',							
				'finalist_name' => 'Finalist Name',
				'finalist_count' => 'Finalist Count',
				'finalist_remaining' => 'Finalist Count Left',
				'finalist_description' => 'Finalist Description',
				'finalist_url' => 'Submission URL',
				'ptype' => 'Post Type'
			));
			?>

			<div class="wrap">
			<div class="icon32" id="icon-prize"><br /></div>
				<h2><?php _e('Suggested Finalists', 'wphonors'); ?>
					<?php if (current_user_can( 'edit_others_posts' )) { ?>
						<a class="button add-new-h2" href="<?php echo admin_url("admin.php?page=add-finalist-page&action=new") ?>">Add New</a>
					<?php } ?>							
				</h2>
				
				<form method="get" action="admin.php">
				<table class="widefat fixed" cellspacing="0">
					<thead><tr><?php print_column_headers($current_screen); ?></tr></thead>	
					<tfoot><tr><?php print_column_headers($current_screen, false); ?></tr></tfoot>	
					<tbody>
				<?php
				global $wpdb;
				$viewallsql = "SELECT * FROM wp_finalists ORDER BY id DESC";
				$selected_row = $wpdb->get_results($viewallsql);
				
				foreach ($selected_row as $selecta) {
					$pid = $selecta->id;
					$finalist_name = $selecta->finalist_name;
					$cnt = $selecta->cnt;
					$cnt_remain = $selecta->cnt_remain;
					$finalist_description = $selecta->finalist_description;
					$finalist_url = $selecta->finalist_url;
					$ptype = $selecta->ptype;
					
					/**
					 * THE EDIT LINK FOR FINALISTS
					 */
					$editlink = esc_url( add_query_arg( 'wp_http_referer', urlencode( esc_url( stripslashes( $_SERVER['REQUEST_URI'] )) ),"admin.php?page=finalists&finalist-id=" . $pid . "&finalists_name=" . $finalists_name . "&cnt=" . $cnt . "&cnt_remain=" . $cnt_remain . "&finalist_description=" . $finalist_description . "&finalist_url=" . $finalist_url . "&ptype=" . $ptype . "&action=edit" ));
					
					/**
					 * THE DELETE LINK FOR FINALISTS
					 */
					$deletelink = esc_url( add_query_arg( 'wp_http_referer', urlencode( esc_url( stripslashes( $_SERVER['REQUEST_URI'] )) ),"admin.php?page=finalists&finalist-id=" . $pid . "&finalist_name=" . $finalist_name . "&cnt=" . $cnt . "&cnt_remain=" . $cnt_remain . "&finalist_description=" . $finalist_description . "&finalist_url=" . $finalist_url . "&ptype=" . $ptype ."&action=delete-finalist" ));
					?>
					 
					<tr id="finalist-<?php echo $pid; ?>">
						<td class="finalist_name column-finalist-name" style="width:20px!important;">
							<strong><?php echo $pid; ?></strong>
						</td>					
						<td class="finalist_name column-finalist-name" style="width:150px;">
						<?php if (current_user_can( 'edit_others_posts' )) { ?>
							<a href="<?php echo $editlink;?>"><?php echo $finalist_name;?></a>
							<br />
							<div class="row-actions">
								<span class="edit"><a href="<?php echo $editlink; ?>">Edit</a> | </span>
								<span class="delete"><a class="submitdelete" href="<?php echo $deletelink; ?>">Delete</a></span>
							</div>
						<?php } else { 
							echo $finalist_name; 
						} ?>								
						</td>
						<td align="center" valign="middle" class="finalist-count column-finalist-count" style="background:#eee; width:20px;"><?php echo $cnt; ?></td>							
						<td align="center" valign="middle" class="finalist-remain column-finalist-remaining" style="background:#fff8a4; width:20px;"><?php echo $cnt_remain; ?></td>
						<td class="finalist-desc column-finalist-desc" style="width:175px;"><?php echo $finalist_description; ?></td>
						<td class="finalist-remain column-finalist-remaining"><a href="<?php echo $finalist_url; ?>" target="_blank"><?php echo $finalist_name; ?></a></td>
						<td class="finalist-remain column-finalist-remaining"><?php echo $ptype; ?></td>
					</tr>
				 <?php } ?>
				</tbody>
			</table>
			
			</form>
		</div>

	<?php
		break;
	}
	?>

	<style type="text/css">
	#icon-prize{ background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/images/prize_winner.png"; echo $bigiconpath; ?>') no-repeat; }
	</style>

<?php } // END FINALISTS PAGE


function add_finalists_page() {
	global $wpdb;
	$finalist_id = $_REQUEST['finalist-id'];
	$finalist_name = $_REQUEST['finalist_name'];
	$cnt = $_REQUEST['cnt'];
	$cnt_remain = $_REQUEST['cnt_remain'];
	$finalist_description = $_REQUEST['finalist_description'];
	$finalist_url = $_REQUEST['finalist_url'];
	$ptype = $_REQUEST['ptype'];

	if (!empty($finalist_name) && !empty($cnt) && 
		!empty($cnt_remain) && !empty($finalist_description) && 
		!empty($finalist_url) && !empty($ptype)) {
		$wpdb->insert('wp_finalists', array('id' => NULL, 'finalist_name' => $finalist_name, 'cnt' => $cnt, 'cnt_remain' => $cnt_remain, 'finalist_description' => $finalist_description, 'finalist_url' => $finalist_url, 'ptype' => $ptype));
		if ($_REQUEST['save']) echo '<div id="message" class="updated fade"><p><strong>Finalist was created.</strong></p></div>';
	}	

	if (empty($finalist_name) || empty($cnt) || empty($cnt_remain) || empty($finalist_description) || empty($finalist_url) || empty($ptype)) {	
		if ($_REQUEST['save']) echo '<div id="message" class="error fade"><p><strong>Form had blank fields.</strong></p></div>';
	}
	?>
	
	<div class="wrap">
		<div class="icon32" id="icon-prize"><br /></div>
		<h2><?php _e( 'Create New Finalist' ); ?></h2>
		<form method="post" action="" id="posts-filter">
		<table cellspacing="0" class="widefat fixed">

			<form method="post" action="admin.php">
			<table class="form-table">
				<tr valign="top">
					 <th align="right" scope="row">Finalist:</th>
					 <td><input type="text" id="finalist_name" name="finalist_name" /></td>
				</tr>
				<tr valign="top">
					<th align="right" scope="row">Ttl Itm: # </th>
					<td><input type="text" id="cnt" name="cnt" /></td>
				</tr>
				<tr valign="top">
					<th align="right" scope="row">Ttl Rm: # </th>
					<td><input type="text" id="cnt_remain" name="cnt_remain" /></td>
				</tr>
				<tr valign="top">
					<th align="right" scope="row">Description: </th>
					<td><input type="text" id="finalist_description" name="finalist_description" /></td>
				</tr>
				<tr valign="top">
					<th align="right" scope="row">Submission URL: </th>
					<td><input type="text" id="finalist_url" name="finalist_url" /></td>
				</tr>
				<tr valign="top">
					<th align="right" scope="row">Post Type: </th>
					<td><input type="text" id="ptype" name="ptype" /></td>
				</tr>
			</table>
			<p class="submit">
				<input name="save" type="submit" value="Save Changes" />
				<input type="hidden" name="action" value="save" />
			</p>
		</table>
		</form>
	</div>				
	<style type="text/css">
	#icon-prize{ background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/images/prize_winner.png"; echo $bigiconpath; ?>') no-repeat; }
	</style>

<?php } // END ADD FINALISTS PAGE

/**
 * Create judging criteria info page
 */
function criteria_finalists_page() { ?>
	<div class="wrap">
		<div class="icon32" id="icon-prize"><br/></div>
		
		<h2><?php _e( 'Judging Criteria for Choosing Finalists' ); ?></h2>
		<p>Below is the criteria what each category of submissions should be judged based on. Use your best judgement, and try to remain nuetral in your final decisions for what you think should be chosen as a final nominee.</p>
		<p style="color:red; font-size:11px; width:500px; border:1px solid #999; padding:5px;">NOTE: When choosing finalists please keep in mind that the number of votes a particular submission has should be one of the last deciding factors to consider for each category which chosen finalists are picked from.</p>
		
		<h2><?php _e( 'The Judges' ); ?></h2>
		<table width="90%" align="center" cellpadding="5" cellspacing="0" style="padding: 5px; border:1px solid #ccc;">
			<tr>
				<td align="center"><a href="http://wpcandy.com" target="_blank">Ryan Imel</a> - <a href="http://twitter.com/wpcandy" target="_blank">@WPCandy</a></td>
				<td align="center"><a href="http://chuckreynolds.us" target="_blank">Chuck Reynolds</a> - <a href="http://twitter.com/ChuckReynolds" target="_blank">@ChuckReynolds</a></td>
			</tr><tr>
				<td align="center"><a href="http://page.ly" target="_blank">Joshua Strebel</a> - <a href="http://twitter.com/strebel" target="_blank">@strebel</a></td>
				<td align="center"><a href="http://wpbeginner.com" target="_blank">Syed Balkhi</a> - <a href="http://twitter.com/syedbalkhi" target="_blank">@syedbalkhi</a></td>
			</tr>
			<tr>
				<td align="center"><a href="http://lisasabin-wilson.com" target="_blank">Lisa Sabin Wilson</a> - <a href="http://twitter.com/LisaSabinWilson" target="_blank">@LisaSabinWilson</a></td>
				<td align="center"><a href="http://9seeds.com" target="_blank">Shayne Sanderson</a> - <a href="http://twitter.com/shaynesanderson" target="_blank">@ShayneSanderson</a></td>
			</tr>
			<tr>
				<td align="center"><a href="http://wardandrews.com" target="_blank">Ward Andrews</a> - <a href="http://twitter.com/wardandrews" target="_blank">@wardandrews</a></td>
				<td align="center"><a href="http://webdevstudios.com/" target="_blank">Brad Williams</a> - <a href="http://twitter.com/williamsba" target="_blank">@williamsba</a></td>
			</tr>
			<tr>
				<td align="center"></td>
				<td align="center"></td>
			</tr>
	  </table>

		<h2><?php _e( 'Judging Criteria' ); ?></h2>
		<p>You can use the checkboxes to check off things as you go if you want to. If that makes it easier to keep track of things.</p>
		<p>If you have anything submitted to any of the categories, you are not allowed to judge any of the entries in that category. Just to be fair.</p>
		<p>You can view the number of votes all the submissions have with the custom dashboard widget on the main dashboard page.</p>
		<p>Submit your finalist choices to the Finalists post type, and specify the category it is in, the post type, post title, a short description in the excerpt and the URL to the original submission.</p>
		<p>Contact me if you have any questions at <a href="mailto:jaredwilli@gmail.com">jaredwilli@gmail.com</a></p>
		<p><strong>Please try to get all your votes in by Saturday, November 27th, thanks.</strong></p>

		<table width="100%" border="0" align="center" cellpadding="7" cellspacing="0">
			<tr>
				<th bgcolor="#fff200">Sites</th>
				<th bgcolor="#3dd9f0">Plugins</th>
			</tr><tr>
				<td valign="top" bgcolor="#f8fc8e">
					<div>
					<h4>Personal Sites</h4>
					<ul>
						<li><input type="checkbox" /> Is powered by WordPress</li>
						<li><input type="checkbox" /> Creative/Unique/Extended use of WordPress</li>
					  <li><input type="checkbox" /> Is powered by WordPress</li>
						<li><input type="checkbox" /> Usefulness</li>
					  <li><input type="checkbox" /> Navigation and appearance</li>
					</ul>			
					</div>
					<div>
					<h4>Business Sites</h4>
					<ul>
						<li><input type="checkbox" /> WordPress products/services</li>
						<li><input type="checkbox" /> Makes use of WordPress</li>
						<li><input type="checkbox" /> Quality of product/service</li>
						<li><input type="checkbox" /> Support</li>
						<li><input type="checkbox" /> Usefulness</li>
						<li><input type="checkbox" /> Appearance</li>
						<li><input type="checkbox" /> Qaulity of branding and consistency</li>
					</ul>
					</div>
					<div>
					<h4>WordPress Related</h4>
					<ul>
						<li><input type="checkbox" /> Uses WordPress</li>
						<li><input type="checkbox" /> Relates to WordPress</li>
						<li><input type="checkbox" /> Originality</li>
						<li><input type="checkbox" /> Usefulness</li>
						<li><input type="checkbox" /> Navigation and appearance</li>
					</ul>
				</div>
			  </td>
			  <td valign="top" bgcolor="#dceefc">
					<h4>Free Plugins</h4>
					<ul>
						<li><input type="checkbox" /> Functionality</li>
						<li><input type="checkbox" /> Ease of use</li>
						<li><input type="checkbox" /> Serves a useful purpose</li>						
						<li><input type="checkbox" /> Coding standards</li>
						<li><input type="checkbox" /> WordPress best practices</li>
						<li><input type="checkbox" /> Is updated regularly</li>
					</ul>
					<h4>Commercial Plugins</h4>
					<ul>
						<li><input type="checkbox" /> Functionality</li>
						<li><input type="checkbox" /> Ease of use</li>
						<li><input type="checkbox" /> Serves a useful purpose</li>						
						<li><input type="checkbox" /> Coding standards</li>
						<li><input type="checkbox" /> WordPress best practices</li>
						<li><input type="checkbox" /> Reasonable pricing</li>
						<li><input type="checkbox" /> Support</li>
						<li><input type="checkbox" /> Is updated regularly</li>
						<li><input type="checkbox" /> Documentation</li>
						<li><input type="checkbox" /> Features/Options</li>
						<li><input type="checkbox" /> Security</li>
					</ul>					
			  </td>
			</tr><tr>
				<th bgcolor="#3df056">Themes</th>
				<th bgcolor="#f75dbb">Personalities</th>
			</tr><tr>
				<td valign="top" bgcolor="#bcffc2">
					<h4>Free Themes</h4>
					<ul>
						<li><input type="checkbox" /> Functionality</li>
					  <li><input type="checkbox" /> Ease of use</li>
						<li><input type="checkbox" /> Look and feel</li>
						<li><input type="checkbox" /> Coding standards</li>
						<li><input type="checkbox" /> WordPress best practices</li>
						<li><input type="checkbox" /> Is updated regularly</li>
					</ul>			
					<h4>Commercial Themes</h4>
					<ul>
						<li><input type="checkbox" /> Functionality</li>
						<li><input type="checkbox" /> Ease of use</li>
						<li><input type="checkbox" /> Look and feel</li>
						<li><input type="checkbox" /> Mutliple styles</li>
						<li><input type="checkbox" /> Image source files</li>						
						<li><input type="checkbox" /> Coding standards/commenting</li>
						<li><input type="checkbox" /> WordPress best practices</li>
						<li><input type="checkbox" /> Reasonable pricing</li>
						<li><input type="checkbox" /> Support</li>
						<li><input type="checkbox" /> Is updated regularly</li>
						<li><input type="checkbox" /> Documentation</li>
						<li><input type="checkbox" /> Features/Options</li>
						<li><input type="checkbox" /> Security</li>
					</ul>			
					<h4>Theme Frameworks</h4>
					<ul>
						<li><input type="checkbox" /> Functionality</li>
						<li><input type="checkbox" /> Ease of use</li>
						<li><input type="checkbox" /> Look and feel</li>
						<li><input type="checkbox" /> Coding standards/commenting</li>
						<li><input type="checkbox" /> WordPress best practices</li>
						<li><input type="checkbox" /> Is updated regularly</li>
						<li><input type="checkbox" /> Documentation</li>
						<li><input type="checkbox" /> Features/Options</li>
						<li><input type="checkbox" /> Security</li>
					</ul>										
			  </td>
				<td valign="top" bgcolor="#fcd0da">
					<h4>Designers</h4>
					<ul>
						<li><input type="checkbox" /> Has designed themes/WP UIs</li>
					  <li><input type="checkbox" /> Originality</li>
						<li><input type="checkbox" /> Professional appearance</li>
						<li><input type="checkbox" /> Quality of work</li>
						<li><input type="checkbox" /> Attitude and interaction</li>
						<li><input type="checkbox" /> Value of contributions towards WP design community</li>
					</ul>
					<h4>Developers</h4>					
					<ul>
						<li><input type="checkbox" /> Has made themes/plugins</li>
						<li><input type="checkbox" /> Level of complexity with codes developed</li>
						<li><input type="checkbox" /> Attitude and interaction</li>
						<li><input type="checkbox" /> Value of contributions towards WordPress development</li>
					</ul>
					<h4>Blog Authors</h4>
					<ul>
						<li><input type="checkbox" /> Writing quality (grammar, spelling, formatting)</li>
						<li><input type="checkbox" /> Posts frequently</li>
						<li><input type="checkbox" /> Originality of posts</li>
						<li><input type="checkbox" /> Useful/helpful content</li>
						<li><input type="checkbox" /> Responds actively to comments</li>
						<li><input type="checkbox" /> Thorough with detailed explanations</li>
					</ul>
					<h4>WP Community</h4>
					<ul>
						<li><input type="checkbox" /> Qaulity of contributions to community</li>
						<li><input type="checkbox" /> Level of impact in community</li>
						<li><input type="checkbox" />
				         Helpfulness</li>
					</ul>
			  </td>
			</tr>
	  </table>

	</div>
	
	<style type="text/css">
	#icon-prize{ background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/images/prize_winner.png"; echo $bigiconpath; ?>') no-repeat; }
	</style>

<?php } ?>