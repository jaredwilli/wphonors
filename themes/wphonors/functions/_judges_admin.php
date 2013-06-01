<?php

class Finalists {

    function __construct() { global $wpdb; }

    function add_finalist( $finalist_name, $cnt, $cnt_remain, $finalist_description, $finalist_url, $ptype ) {
        global $wpdb;
        $table = "wp_finalists";
        $data = "NULL , '$finalist_name', '$cnt', '$cnt_remain', '$finalist_description', '$finalist_url', '$ptype'";
        $format =  array( '%s', '%d', '%d', '%s', '%s', '%s' );
        $insert = $wpdb->insert( $table, $data, $format );
        return $insert  or die("Adding Finalist Failed!");
    }

    function delete_finalists($finalist_id) {
        $deletesql = "DELETE FROM wp_finalists WHERE id = '" . $finalist_id . "'";
        global $wpdb;
	$delete = $wpdb->query($deletesql);
        return $delete or die ("Deleting Finalist Failed!");
    }

    function showall_finalists(){
        global $wpdb;
        $data ="SELECT * FROM wp_finalists;";
        $finalists = $wpdb->get_results($data, OBJECT_K);
        var_dump($finalists);
    }

    function  __destruct() {
        /*
        global $wpdb;
        $end_sql = "DROP TABLE `wp_finalists` ;";
        $result  = $wpdb->query($end_sql);
        return $result;
         */
    }
}
?>