<?php
get_template_part( '/functions/contest/prizes.php' );

$prize = new Prizes();
//$prize->showallprizes();
add_action('admin_menu', 'prize_menu');

function prize_menu() {
    // START CREATE MENU
    $prize_allowed_group = 'create_users';
    $iconpath = get_bloginfo('template_directory') . "/functions/contest/images/small_prize.png";
    //$iconpath = TEMPLATEPATH . '/functions/contest/prize.png';

    add_menu_page(__( 'prizes', 'prizes'), __('Prizes', 'prizes'), $prize_allowed_group, 'prizes', 'prizes_page', $iconpath, 4 );
    add_submenu_page('prizes', __('Add Prize', 'add-prizes'), __('Add Prize', 'add-prizes'), $prize_allowed_group, 'add-prizes-page', 'add_prizes_page');
    add_submenu_page('prizes', __('Prize Calender', 'calender-prizes'), __('Prize Calender', 'calender-prizes'), $prize_allowed_group, 'calender-prizes-page', 'calender_prizes_page');

}

function prizes_page() { //START PRIZES PAGE

    $req_action = $_REQUEST['action'];
    switch ($req_action) {
        case ('delete-prize') : //START OF CASE EDIT
?>
<?php
            global $wpdb;
            $prize_id = $_REQUEST['prize-id'];
            $sponsor_name = $_REQUEST['sponsor_name'];
            $cnt = $_REQUEST['cnt'];
            $cnt_remain = $_REQUEST['cnt_remain'];
            $prize_description = $_REQUEST['prize_description'];
            $twitter_url = $_REQUEST['twitter_url'];
            $type = $_REQUEST['type'];

            if ($_REQUEST['action'] == 'delete-prize') { // beginning if action is delete from the delete link
?>
                <div class="wrap">
                    <div class="icon32" id="icon-prize"><br></div>

                    <h2>Delete A Prize</h2>

                    <form method="post" action="" id="posts-filter">
                        <table cellspacing="0" class="widefat fixed">
                            <h2>Delete prize</h2>
                            <form method="post" action="admin.php" id="deleteform" />
                            <table class="form-table">
                                        <tr valign="top">
                                             <th scope="row">Sponsor Name</th>
                                            <td>
                                                <input disabled type="text" id="sponsor_name" name="sponsor_name" value="<?php echo $sponsor_name; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Count</th>
                                            <td>
                                                <input disabled type="text" id="cnt" name="cnt"  value="<?php echo $cnt; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Count Left</th>
                                            <td>
                                                <input disabled type="text" id="cnt_remain" name="cnt_remain"  value="<?php echo $cnt_remain; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Description</th>
                                            <td>
                                                <input disabled type="text" id="prize_description" name="prize_description"  value="<?php echo $prize_description; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Twitter Url</th>
                                            <td>
                                                <input disabled type="text" id="twitter_url" name="twitter_url"  value="<?php echo $twitter_url; ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Type</th>
                                            <td>
                                                <input disabled type="text" id="type" name="type"  value="<?php echo $type; ?>" />
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
<?php } //end of if action is delete company ?>
<?php
            break;
        case ('edit') : //START OF CASE EDIT
?>
<?php
            global $wpdb;
            /*
            $prize_id = $_REQUEST['prize-id'];
            $sponsor_name = $_REQUEST['sponsor_name'];
            $cnt = $_REQUEST['cnt'];
            $cnt_remain = $_REQUEST['cnt_remain'];
            $prize_description = $_REQUEST['prize_description'];
            $twitter_url = $_REQUEST['twitter_url'];
            $type = $_REQUEST['type'];
            */
            /*
            $prize_id = $_POST['prize-id'];
            $sponsor_name = $_POST['sponsor_name'];
            $cnt = $_POST['cnt'];
            $cnt_remain = $_POST['cnt_remain'];
            $prize_description = $_POST['prize_description'];
            $twitter_url = $_POST['twitter_url'];
            $type = $_POST['type'];
            */
            $prize_id = $_GET['prize-id'];
            $sponsor_name = $_GET['sponsor_name'];
            $cnt = $_GET['cnt'];
            $cnt_remain = $_GET['cnt_remain'];
            $prize_description = $_GET['prize_description'];
            $twitter_url = $_GET['twitter_url'];
            $type = $_GET['type'];
           
?>
            <div class="wrap" >
                    <div class="icon32" id="icon-prize"><br></div>
                    <h2>Edit Prize Details</h2>
                   <form method="post" action="" id="posts-filter" />
                        <table cellspacing="0" class="widefat fixed">
                            <h2>Edit prize</h2>
                            <form method="post" action="admin.php" id="updateform" />
                                <table class="form-table" id="prize-<?php echo $prize_id; ?>">
                                    <tr valign="top">
                                        <th scope="row">Prize ID</th>
                                        <td>
                                        <input type="text" disabled name="update-prize-id" id="update-prize-id" value="<?php if(!empty($prize_id)){echo $prize_id;} ?>" />
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Sponsor Name</th>
                                        <td>
                                            <input type="text" name="update-sponsor-field" id="update-sponsor_field" value="<?php if(!empty($sponsor_name)){echo $sponsor_name;} ?>" />
                                        </td>                                    
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Prize Count</th>
                                        <td>
                                            <input type="text" name="update-prize-count-field" id="update-prize_count_field" value="<?php if(!empty($cnt)){echo $cnt;} ?>" />
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Prize Count Left</th>
                                        <td>
                                            <input type="text" name="update-cnt-remain-field" id="update-cnt_remain_field" value="<?php if(!empty($cnt_remain)){echo $cnt_remain;} ?>" />
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Prize Description</th>
                                        <td>
                                            <input type="text" name="update-prize-description-field" id="update-prize_description_field" value="<?php if(!empty($prize_description)){echo $prize_description;} ?>" />
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Twitter Url</th>
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
                    <input name="save" type="submit" value="Save changes" />
                    <input type="hidden" name="action" value="save" />
                </p>
                        </form>
        </table>
    </form>
</div>
<?php


       
                            break;
                        default:
?>
<?php
                            global $wpdb;
                            $prize_id = $_REQUEST['prize-id'];
                            //$prize_id = $_REQUEST['update-prize-id'];
                            $sponsor_name = $_REQUEST['update-sponsor-field'];
                            $cnt = $_REQUEST['update-prize-count-field'];
                            $cnt_remain = $_REQUEST['update-cnt-remain-field'];
                            $prize_description = $_REQUEST['update-prize-description-field'];
                            $twitter_url = $_REQUEST['update-twitter-url-field'];
                            $type = $_REQUEST['update-type-field'];
                             
                            
                            // UPDATE prize //////////////////////////////////////////
                            if ($_REQUEST['action'] == 'save') {
     
                                $update_sql = "UPDATE wp_prizes SET sponsor_name='{$sponsor_name}',
                                cnt='{$cnt}', cnt_remain='{$cnt_remain}', prize_description='{$prize_description}',
                                twitter_url='{$twitter_url}', type='{$type}' WHERE id = '{$prize_id}'";
                                $wpdb->query($update_sql);
                              
                            }
                            // DELETE prize //////////////////////////////////////////
                            if ($_REQUEST['action'] == 'delete') {
                             $deletesql = "DELETE FROM wp_prizes WHERE id = '" . $prize_id . "'";
                             $wpdb->query($deletesql);  
                            //$prize->deleteprize($prize_id);
                            }
                            //NOTIFICATION DIVS
                            if ($_REQUEST['save'])
                                echo '<div id="message" class="updated fade"><p><strong> prize settings saved.</strong></p></div>';
                            if ($_REQUEST['delete'])
                                echo '<div id="message" class="updated fade"><p><strong> prize deleted.</strong></p></div>';

                            $current_screen = "prizes_page";
                            register_column_headers($current_screen, array(
                                'sponsor_name' => 'Sponsor Name', 'prize_count' => 'Prize Count',
                                'prize_remaining' => 'Prize Count Left','prize_description' => 'Prize Description', 'twitter_url' => 'Twitter Url',
                                'type' => 'Type'
                            ));
?>

                        <div class="wrap">
                        <div class="icon32" id="icon-prize"><br></div>
                            <h2><?php _e('Available Prizes', 'wphonors'); ?>
                                <a class="button add-new-h2" href="<?php echo admin_url("admin.php?page=add-prizes-page&action=new") ?>">Add New</a>
                            </h2>

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
                                
                                // THE EDIT LINK FOR prizes
                                $editlink = esc_url(add_query_arg('wp_http_referer', 
                                urlencode(esc_url(stripslashes($_SERVER['REQUEST_URI']))),
                                "admin.php?page=prizes&prize-id=" . $pid . "&sponsor_name=" . $sponsor_name .
                                 "&cnt=" . $cnt . "&cnt_remain=" . $cnt_remain . "&prize_description=" .
                                 $prize_description . "&twitter_url=" . $twitter_url . "&type=" . $type . "&action=edit"));
                                
                                // THE DELETE LINK FOR prizes
                                $deletelink = esc_url(add_query_arg('wp_http_referer', 
                                urlencode(esc_url(stripslashes($_SERVER['REQUEST_URI']))),
                                "admin.php?page=prizes&prize-id=" . $pid . "&sponsor_name=" . $sponsor_name .
                                 "&cnt=" . $cnt . "&cnt_remain=" . $cnt_remain . "&prize_description=" .
                                 $prize_description . "&twitter_url=" . $twitter_url . "&type=" . $type . "&action=delete-prize"));

             ?>
                                <tr id='sponsor-<?php echo $pid; ?>'>
                                    <td class="sponsor_name column-sponsor-name">
                                        <strong><a href="" ><?php echo $sponsor_name; ?></a></strong>
                                        <br />
                                        <div class="row-actions">
                                            <span class='edit'><a href="<?php echo $editlink; ?> ">Edit</a> | </span>
                                            <span class='delete'><a class='submitdelete' href="<?php echo $deletelink; ?>">Delete</a></span>
                                        </div>
                                    </td>
                                    <td class="prize-count column-prize-count"><?php echo $cnt; ?></td>
                                    <td class="prize-remain column-prize-remaining"><?php echo $cnt_remain; ?></td>
                                    <td class="prize-desc column-prize-desc"><?php echo $prize_description; ?></td>
                                    <td class="prize-remain column-prize-remaining"><?php echo $twitter_url; ?></td>
                                    <td class="prize-remain column-prize-remaining"><?php echo $type; ?></td>
                                </tr>
             <?php
                            }
              ?>
                                        </tbody>
                        </table>
                    </form>
                </div>

<?php
                            break;
                    }
?>


<style type="text/css">
    #icon-prize{
        background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/functions/contest/images/prize.png"; echo $bigiconpath; ?>') no-repeat;
}
</style>


<?php }

// END prizeS  PAGE
?>
<?php

                function add_prizes_page() {  //START ADD prizeS PAGE
?>

<?php
                    global $wpdb;
                    $prize_id = $_REQUEST['prize-id'];
                    $sponsor_name = $_REQUEST['sponsor_name'];
                    $cnt = $_REQUEST['cnt'];
                    $cnt_remain = $_REQUEST['cnt_remain'];
                    $prize_description = $_REQUEST['prize_description'];
                    $twitter_url = $_REQUEST['twitter_url'];
                    $type = $_REQUEST['type'];

                    if (!empty($sponsor_name) && !empty($cnt) && !empty($cnt_remain) && !empty($prize_description) && !empty($twitter_url) && !empty($type)) {
                        $wpdb->insert('wp_prizes', array('id' => NULL,
                            'sponsor_name' => $sponsor_name, 'cnt' => $cnt, 'cnt_remain' => $cnt_remain,
                            'prize_description' => $prize_description, 'twitter_url' => $twitter_url, 'type' => $type));
                        if ($_REQUEST['save'])
                            echo '<div id="message" class="updated fade"><p><strong>prize was created.</strong></p></div>';
                    }
                    if (empty($sponsor_name) || empty($cnt) || empty($cnt_remain) || empty($prize_description) || empty($twitter_url) || empty($type)) {
                        if ($_REQUEST['save'])
                            echo '<div id="message" class="error fade"><p><strong> Form had blank fields.</strong></p></div>';
                    }
?>
                    <div class="wrap">
                        <div class="icon32" id="icon-prize"><br></div>

                        <h2>Create New Prize</h2>

                        <form method="post" action="" id="posts-filter">
                            <table cellspacing="0" class="widefat fixed">
                                <h2>Create prize</h2>
                                <form method="post" action="admin.php">
                                    <table class="form-table">
                                        <tr valign="top">
                                             <th scope="row">Sponsor Name</th>
                                            <td>
                                                <input type="text" id="sponsor_name" name="sponsor_name" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Count</th>
                                            <td>
                                                <input type="text" id="cnt" name="cnt" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Count Left</th>
                                            <td>
                                                <input type="text" id="cnt_remain" name="cnt_remain" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Prize Description</th>
                                            <td>
                                                <input type="text" id="prize_description" name="prize_description" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Twitter Url</th>
                                            <td>
                                                <input type="text" id="twitter_url" name="twitter_url" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">Type</th>
                                            <td>
                                                <input type="text" id="type" name="type" />
                                            </td>
                                        </tr>
                                    </table>
                            <p class="submit">
                                <input name="save" type="submit" value="Save changes" />
                                <input type="hidden" name="action" value="save" />
                            </p>
                        </table>
                    </form>
                </div>
<style type="text/css">
    #icon-prize{
        background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/functions/contest/prize.png"; echo $bigiconpath; ?>') no-repeat;
}
</style>

<?php }

// END ADD prizeS  PAGE

function calender_prizes_page() {  //START ADD prizeS PAGE
?>
<div class="wrap">
<div class="icon32" id="icon-prize"><br></div>

<h2>Prize Calender</h2>
<form method="post" action="" id="posts-filter">
<table cellspacing="0" class="widefat fixed">
<h2>View Prize Dates</h2>
</table>
<tr valign="top">
<th scope="row">Calender</th>
<td>
<iframe src="http://www.google.com/calendar/embed?src=gcpj1infmj91asl122sh5faofo%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
</td>
</tr>
</form>
</div>
<style type="text/css">
    #icon-prize{
        background:url('<?php $bigiconpath = get_bloginfo('template_directory') . "/functions/contest/images/prize.png"; echo $bigiconpath; ?>') no-repeat;
}
</style>
<?php } ?>