<?php
// include the prizes.php
get_template_part( 'prizes' );

$prize = new Prizes();
//$prize->showallprizes();
add_action('admin_menu', 'prize_menu');


/**
 * Create dashboard admin menu and pages
 */
function prize_menu() {

    $admin = 'add_users';
	$contrib = 'edit_posts';
	
    $iconpath = get_bloginfo('template_directory') . "/functions/contest/images/small_prize.png";
	add_menu_page(__( 'prizes', 'prizes'), __('Prizes', 'prizes'), $contrib, 'prizes', 'prizes_page', $iconpath, 1 );
	add_submenu_page('prizes', __('Add Prize', 'add-prizes'), __('Add Prize', 'add-prizes'), $admin, 'add-prizes-page', 'add_prizes_page');
    add_submenu_page( 'prizes', __('Prize Calendar', 'calendar-prizes'), __('Prize Calendar', 'calendar-prizes'), 
																			$contrib, 'calendar-prizes-page', 'calendar_prizes_page' );}

function prizes_page() {

    $req_action = $_REQUEST['action']; // action: edit, delete, add
    switch ($req_action) {
	
        case ('delete-prize') : 
            global $wpdb;
            $prize_id = $_REQUEST['prize-id'];
            $sponsor_name = $_REQUEST['sponsor_name'];
            $cnt = $_REQUEST['cnt'];
            $cnt_remain = $_REQUEST['cnt_remain'];
            $prize_description = $_REQUEST['prize_description'];
            $twitter_url = $_REQUEST['twitter_url'];
            $type = $_REQUEST['type'];

            if ($_REQUEST['action'] == 'delete-prize') { 
				// beginning if action is delete from the delete link
			?>
                
				<div class="wrap">
                    <div class="icon32" id="icon-prize"><br /></div>

                    <h2><?php __( 'Delete A Prize' ); ?></h2>

                    <form method="post" action="" id="posts-filter">
                        
						<table cellspacing="0" class="widefat fixed">
						
                            <form method="post" action="admin.php" id="deleteform" />
                            <table class="form-table">
                                        <tr valign="top">
                                             <th scope="row">Sponsor: </th>
                                             <td>
                                                <input disabled type="text" id="sponsor_name" name="sponsor_name" value="<?php echo $sponsor_name; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Ttl Itm: #</th>
                                            <td>
                                                <input disabled type="text" id="cnt" name="cnt"  value="<?php echo $cnt; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Ttl Rm: #</th>
                                            <td>
                                                <input disabled type="text" id="cnt_remain" name="cnt_remain"  value="<?php echo $cnt_remain; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Description: </th>
                                            <td>
                                                <input disabled type="text" id="prize_description" name="prize_description"  value="<?php echo $prize_description; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Twitter Name: @</th>
                                            <td>
                                                <input disabled type="text" id="twitter_url" name="twitter_url"  value="<?php echo $twitter_url; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Type: </th>
                                            <td>
                                                <input disabled type="text" id="type" name="type" value="<?php echo $type; ?>" />
                                            </td>
                                        </tr>
                  </table>
				<p class="submit">
                                <input name="delete" type="submit" value="Delete Prize" />
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
            $prize_id = $_GET['prize-id'];
            $sponsor_name = $_GET['sponsor_name'];
            $cnt = $_GET['cnt'];
            $cnt_remain = $_GET['cnt_remain'];
            $prize_description = $_GET['prize_description'];
            $twitter_url = $_GET['twitter_url'];
            $type = $_GET['type'];

		?>
			
            <div class="wrap" >
				<div class="icon32" id="icon-prize"><br /></div>
					
			   <form method="post" action="" id="posts-filter" />
					<table cellspacing="0" class="widefat fixed">

						<h2><?php __( 'Edit Prize' ); ?></h2>
						<form method="post" action="admin.php" id="updateform" />

							<table class="form-table" id="prize-<?php echo $prize_id; ?>">
								<tr valign="top">
									<th scope="row" align="center">ID</th>
									<td>
									<input type="text" name="update-prize-id" id="update-prize-id" value="<?php if(!empty($prize_id)){echo $prize_id;} ?>" size="7" disabled="disabled" />
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Sponsor: </th>
									<td>
										<input type="text" name="update-sponsor-field" id="update-sponsor_field" value="<?php if(!empty($sponsor_name)){echo $sponsor_name;} ?>" />
									</td>                                    
								</tr>
								<tr valign="top">
									<th scope="row">Ttl. Itm: #</th>
									<td>
										<input type="text" name="update-prize-count-field" id="update-prize_count_field" value="<?php if(!empty($cnt)){echo $cnt;} ?>" />
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Ttl Rm: #</th>
									<td>
										<input type="text" name="update-cnt-remain-field" id="update-cnt_remain_field" value="<?php if(!empty($cnt_remain)){echo $cnt_remain;} ?>" />
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Description:</th>
									<td>
										<input type="text" name="update-prize-description-field" id="update-prize_description_field" value="<?php if(!empty($prize_description)){echo $prize_description;} ?>" />
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Twitter Name:</th>
									<td>
										<input type="text" name="update-twitter-url-field" id="update-twitter_url_field" value="<?php if(!empty($twitter_url)){echo $twitter_url;} ?>" />
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Type</th>
									<td>
										<input type="text" name="update-type-field" id="update-type_field" value="<?php if(!empty($type)){echo $type;} ?>" />
									</td>
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
							$prize_id = $_REQUEST['prize-id'];
                            //$prize_id = $_REQUEST['update-prize-id'];
                            $sponsor_name = $_REQUEST['update-sponsor-field'];
                            $cnt = $_REQUEST['update-prize-count-field'];
                            $cnt_remain = $_REQUEST['update-cnt-remain-field'];
                            $prize_description = $_REQUEST['update-prize-description-field'];
                            $twitter_url = $_REQUEST['update-twitter-url-field'];
                            $type = $_REQUEST['update-type-field'];
                            /**
							 * Update Prize
							 */
                            if ($_REQUEST['action'] == 'save') {
                                $update_sql = "UPDATE wp_prizes SET sponsor_name='{$sponsor_name}',
                                cnt='{$cnt}', cnt_remain='{$cnt_remain}', prize_description='{$prize_description}',
                                twitter_url='{$twitter_url}', type='{$type}' WHERE id = '{$prize_id}'";
                                $wpdb->query($update_sql);
                            }
                            /**
							 * Delete prize
							 */
                            if ($_REQUEST['action'] == 'delete') {							
								$deletesql = "DELETE FROM wp_prizes WHERE id = '". $prize_id ."'";	
								$wpdb->query($deletesql);  
								//$prize->deleteprize($prize_id);
                            }
                            /**
							 * Message notifaction divs
							 */
                            if ($_REQUEST['save'])
                                echo '<div id="message" class="updated fade"><p><strong>Prize settings saved.</strong></p></div>';
                            if ($_REQUEST['delete'])
                                echo '<div id="message" class="updated fade"><p><strong>Prize deleted.</strong></p></div>';



                            $current_screen = "prizes_page";
                            register_column_headers($current_screen, array(
                                'pid' => 'ID', 'sponsor_name' => 'Sponsor Name', 'prize_count' => 'Prize Count',
                                'prize_remaining' => 'Prize Count Left','prize_description' => 'Prize Description', 
								'twitter_url' => 'Twitter Url', 'type' => 'Type'
                            ));
							
						?>

                        <div class="wrap">
                        <div class="icon32" id="icon-prize"><br /></div>
                            <h2><?php _e('Available Prizes', 'wphonors'); ?></h2>
								<?php if (current_user_can( 'publish_posts' )) { ?>
	                                <a class="button add-new-h2" href="<?php echo admin_url("admin.php?page=add-prizes-page&action=new") ?>">Add New</a>
								<?php } ?>							

                            <form method="get" action="admin.php">

                                <table class="widefat fixed" cellspacing="0">
									<thead>
                                        <tr>
                                <?php print_column_headers($current_screen); ?>
										</tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                <?php print_column_headers($current_screen, false); ?>
										</tr>
                                    </tfoot>

                                    <tbody>
            		<?php
					global $wpdb;

					$viewallsql = "SELECT * FROM wp_prizes ORDER BY id DESC";
					$selected_row = $wpdb->get_results($viewallsql);
					
					foreach ($selected_row as $selecta) {
						$pid = $selecta->id;
						$sponsor_name = $selecta->sponsor_name;
						$cnt = $selecta->cnt;
						$cnt_remain = $selecta->cnt_remain;
						$prize_description = $selecta->prize_description;
						$twitter_url = $selecta->twitter_url;
						$type = $selecta->type;
						
						/**
						 * THE EDIT LINK FOR prizes
						 */
						$editlink = esc_url( add_query_arg( 'wp_http_referer', urlencode( esc_url( stripslashes( $_SERVER['REQUEST_URI'] )) ),"admin.php?page=prizes&prize-id=" . $pid . "&sponsor_name=" . $sponsor_name . "&cnt=" . $cnt . "&cnt_remain=" . $cnt_remain . "&prize_description=" . $prize_description . "&twitter_url=" . $twitter_url . "&type=" . $type . "&action=edit" ));
						
						/**
						 * THE DELETE LINK FOR prizes
						 */
						$deletelink = esc_url( add_query_arg( 'wp_http_referer', urlencode( esc_url( stripslashes( $_SERVER['REQUEST_URI'] )) ),"admin.php?page=prizes&prize-id=" . $pid . "&sponsor_name=" . $sponsor_name . "&cnt=" . $cnt . "&cnt_remain=" . $cnt_remain . "&prize_description=" . $prize_description . "&twitter_url=" . $twitter_url . "&type=" . $type ."&action=delete-prize" ));
						?>
						 
						<tr id="sponsor-<?php echo $pid; ?>">
							<td class="sponsor_name column-sponsor-name" style="width:20px!important;">
								<strong><?php echo $pid; ?></strong>
							</td>					
							<td class="sponsor_name column-sponsor-name" style="width:150px;">

								<?php if (current_user_can( 'publish_posts' )) { 
								// only allow those that can publish posts to edit prizes
								?>
									<a href="<?php echo $editlink; ?>"><?php echo $sponsor_name; ?></a>
								<br />
								<div class="row-actions">
									<span class='edit'><a href="<?php echo $editlink; ?> ">Edit</a> | </span>
									<span class='delete'><a class='submitdelete' href="<?php echo $deletelink; ?>">Delete</a></span>
								</div>

								<?php } else { echo $sponsor_name; } ?>
								
							</td>
							<td align="center" valign="middle" class="prize-count column-prize-count" style="background:#eee; width:20px;"><?php echo $cnt; ?></td>
							
							<td align="center" valign="middle" class="prize-remain column-prize-remaining" style="background:#fff8a4; width:20px;"><?php echo $cnt_remain; ?></td>
							
							<td class="prize-desc column-prize-desc" style="width:175px;"><?php echo $prize_description; ?></td>
							<td class="prize-remain column-prize-remaining"><a href="http://twitter.com/<?php echo $twitter_url; ?>" target="_blank">@<?php echo $twitter_url; ?></a></td>
							<td class="prize-remain column-prize-remaining"><?php echo $type; ?></td>
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
#icon-prize{ background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/functions/contest/images/prize.png"; echo $bigiconpath; ?>') no-repeat; }
</style>

<?php 
}

// END prizeS  PAGE

                function add_prizes_page() {
                    global $wpdb;
                    $prize_id = $_REQUEST['prize-id'];
                    $sponsor_name = $_REQUEST['sponsor_name'];
                    $cnt = $_REQUEST['cnt'];
                    $cnt_remain = $_REQUEST['cnt_remain'];
                    $prize_description = $_REQUEST['prize_description'];
                    $twitter_url = $_REQUEST['twitter_url'];
                    $type = $_REQUEST['type'];

                    if (!empty($sponsor_name) && !empty($cnt) && 
						!empty($cnt_remain) && !empty($prize_description) && 
						!empty($twitter_url) && !empty($type)) {
						
                        $wpdb->insert('wp_prizes', array('id' => NULL,
                            'sponsor_name' => $sponsor_name, 'cnt' => $cnt, 'cnt_remain' => $cnt_remain, 'prize_description' => $prize_description, 'twitter_url' => $twitter_url, 'type' => $type));
						if ($_REQUEST['save'])
                            echo '<div id="message" class="updated fade"><p><strong>Prize was created.</strong></p></div>';
                    }
					
                    if (empty($sponsor_name) || empty($cnt) || 
						empty($cnt_remain) || empty($prize_description) || 
						empty($twitter_url) || empty($type)) {
						
                        if ($_REQUEST['save'])
                            echo '<div id="message" class="error fade"><p><strong>Form had blank fields.</strong></p></div>';
                    }
?>
                    <div class="wrap">
                        <div class="icon32" id="icon-prize"><br /></div>

                        <h2><?php __( 'Create New Prize' ); ?></h2>

                        <form method="post" action="" id="posts-filter">

                            <table cellspacing="0" class="widefat fixed">
                                <form method="post" action="admin.php">

                                    <table class="form-table">
                                        <tr valign="top">
                                             <th align="right" scope="row">Sponsor:</th>
                                             <td>
                                                <input type="text" id="sponsor_name" name="sponsor_name" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th align="right" scope="row">Ttl Itm: # </th>
                                            <td>
                                                <input type="text" id="cnt" name="cnt" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th align="right" scope="row">Ttl Rm: # </th>
                                            <td>
                                                <input type="text" id="cnt_remain" name="cnt_remain" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th align="right" scope="row">Description: </th>
                                            <td>
                                                <input type="text" id="prize_description" name="prize_description" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th align="right" scope="row">Twitter: </th>
                                            <td>
                                                <input type="text" id="twitter_url" name="twitter_url" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th align="right" scope="row">Prize Type: </th>
                                            <td>
                                                <input type="text" id="type" name="type" />
                                            </td>
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
#icon-prize{ background:url('<?php $bigiconpath = get_bloginfo('template_directory') ."/functions/contest/prize.png"; echo $bigiconpath; ?>') no-repeat; }
</style>

<?php }

// END ADD prizeS  PAGE

function calendar_prizes_page() {
?>
<div class="wrap">
	<div class="icon32" id="icon-prize"><br></div>
	
	<h2><?php _e( 'Prize Giveaway Schedule' ); ?></h2>
	<p>We have enough prizes to give away 3 prizes every 4 days for the rest of the year!!</p>
	
	<form method="post" action="" id="posts-filter">
		<table cellspacing="0" class="widefat fixed">
			<h2>View Prize Dates</h2>
			<tr valign="top">
				<th scope="row" align="center"></th>
			</tr>
				<td>
			<iframe src="http://www.google.com/calendar/embed?src=gcpj1infmj91asl122sh5faofo%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
				</td>
			</tr>
		</table>
	</form>
</div>

<style type="text/css">
#icon-prize{ background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/functions/contest/images/prize.png"; echo $bigiconpath; ?>') no-repeat; }
</style>

<?php } 


/**
 *
 * Why not using the 'post_manage_columns' hook
 * to use and display custom post manage columns instead?
 *
 *
	// Create the columns and heading title text
	public function prize_edit_columns($columns) {
		$current_screen = "prizes_page";

		$columns = array(
			'cb' => '<input type="checkbox" />',
			'sponsor' => 'Sponsor',
			'cnt' => '#Prizes',
			'cnt_rem' => '#Left',
			'description' => 'Description',
			'prize_type' => 'Type',
		);
		return $columns;
	}
	// switching cases based on which $column we show the content of it
	public function prize_custom_columns($column) { 
		global $post;
		
		get_template_part( bloginfo('template_directory') . "/functions/posttypes" );
		$a = new TypeSites();
		
		switch ($column) {
			case 'sponsor' : the_title();
				break;
			case 'cnt': $b = $a->mshot(); echo '<a href="'.$b[0].'">'.$b[0].'</a>';
				break;
			case 'cnt_rem' : ;
				break;                
			case 'description' : ;
				break;
			case 'prize_type' : $b = $a->mshot(70); echo '<img src="'.$b[1].'" width="70" />';
				break;
		}
	}					
	add_filter( 'manage_posts_custom_column', 'prize_custom_columns' );
	add_action( 'manage_edit-prize_columns', 'prize_edit_columns' );

 *
 */

?>