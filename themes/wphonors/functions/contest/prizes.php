<?php

class Prizes {

    function __construct() {
        
        global $wpdb;
        /*
         $start_sql = "
                       SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
                       CREATE TABLE IF NOT EXISTS `wp_prizes` (
                      `id` BIGINT(60) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      `sponsor_name` VARCHAR(255) NOT NULL, 
                      `cnt` BIGINT(60) NOT NULL,
                      `cnt_remain` BIGINT(60) NOT NULL,
                      `prize_description` VARCHAR(255) NOT NULL, 
                      `twitter_url` VARCHAR(255) NOT NULL,
                      `type` VARCHAR(255) NOT NULL
                      ) ENGINE = MyISAM ;


                        INSERT INTO `wp_prizes` (
                        `id` ,
                        `sponsor_name` ,
                        `cnt` ,
                        `cnt_remain` ,
                        `prize_description` ,
                        `twitter_url` ,
                        `type`
                        )
                        VALUES (
                        NULL , 'Authority Labs', '2', '1', 'Free Basic Accounts', '@authoritylabs', 'Account (Basic)'
                        ), (
                        NULL , 'Page.ly', '2', '1', 'Free Page.ly Personal Account', '@pagely', 'Account (Personal)'
                        ), (
                        NULL , 'Sucun', '1', '1', 'Free Premium Account', '@sucuri_security', 'Account (Premium)'
                        ), (
                        NULL , 'JumpBox', '1', '1', 'Free Pro account', '@jumpbox', 'Account (Pro)'
                        ), (
                        NULL , 'WordPress for Dummies', '3', '2', 'Free Copies of “WordPress for Dummies”', '@LisaSabinWilson', 'Book'
                        ), (
                        NULL , 'WordPress Professional', '3', '3', 'Free Copies ‘Professional WordPress Development’', '@williamsba', 'Book'
                        ), (
                        NULL , 'WP|Classroom', '3', '3', 'Free Double Classes', '@wpclassroom', 'Classes'
                        ), (
                        NULL , 'Crowd Favorite', '1', '1', 'Free Carrington Build Business license', '@crowdfavorite', 'License'
                        ), (
                        NULL , 'Gravity Forms', '3', '2', 'Free Gravity Forms licenses', '@rocketgenius', 'License'
                        ), (
                        NULL , 'Backup Buddy', '3', '3', 'Free Backup Buddy licenses', '@pluginbuddy', 'License'
                        ), (
                        NULL , 'PHPurchase', '3', '3', 'Free licenses for PHPurchase', '@phpurchase', 'License'
                        ), (
                        NULL , 'Event Espresso', '3', '3', 'Support Licenses of Event Espresso', '@eventespresso', 'License'
                        ), (
                        NULL , 'WooThemes', '3', '3', 'Free 1-Year Developer Subscriptions', '@woothemes', 'Subscription'
                        ), (
                        NULL , 'Press75', '3', '3', 'Free Themes', '@press75', 'Theme'
                        ), (
                        NULL , 'StudioPress', '3', '3', 'Free Genesis + child themes', '@studiopress', 'Theme'
                        ), (
                        NULL , 'Graph Paper Press', '3', '2', 'Free Themes', '@graphpaperpress', 'Theme'
                        ), (
                        NULL , 'upThemes', '3', '3', 'Free Themes', '@upthemes', 'Theme'
                        ), (
                        NULL , 'Mojo Themes', '3', '3', 'Free Themes', '@mojothemes', 'Theme'
                        ), (
                        NULL , 'Museum Themes', '3', '3', 'Free Themes', '@arcanethemes', 'Theme'
                        ), (
                        NULL , 'WPMU', '3', '3', 'Free annual memberships', '@wpmuorg', 'Annual Membership'
                        ), (
                        NULL , 'Headway Themes', '3', '3', 'Free theme licenses', '@headwaythemes', 'License'
                        ), (
                        NULL , 'Startbox', '3', '3', 'Free frameworks', '@wpstartbox', 'Framework'
                        );
          ";
        $wpdb->query($sqlquickie);
         * 
         */
    }


    function addprize($sponsor_name, $cnt, $cnt_remain, $prize_description, $twitter_url, $type){
        global $wpdb;
        $table = "wp_prizes";
        $data = "NULL , '$sponsor_name', '$cnt', '$cnt_remain', '$prize_description', '$twitter_url', '$type'";
        $format =  array( '%s', '%d', '%d', '%s', '%s', '%s' );
        $insert = $wpdb->insert( $table, $data, $format );
        return $insert  or die("Adding Prize Failed!");
    }

    function deleteprize($prize_id) {
        $deletesql = "DELETE FROM wp_prizes WHERE id = '" . $prize_id . "'";
        global $wpdb;
	$delete = $wpdb->query($deletesql);
        return $delete or die ("Deleting Prize Failed!");
    }

    function showallprizes(){
        global $wpdb;
        $data ="SELECT * FROM wp_prizes;";
        $prizes = $wpdb->get_results($data, OBJECT_K);
        var_dump($prizes);
    }



    function  __destruct() {
        /*
        global $wpdb;
        $end_sql = "DROP TABLE `wp_prizes` ;";
        $result  = $wpdb->query($end_sql);
        return $result;
         */
    }

}


?>