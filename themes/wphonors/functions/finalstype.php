<?php
// Initialize the Class and add the action
add_action('init', 'pTypesInits');
function pTypesInits() {
    global $finalists;
    $finalists = new TypeFinalists();
}

/* * * * * * * * *  Best Products  Post Type Class  * * * * * * * * * * * * * */
/**
 * Create a post type class for 'Product' posts
 */
class TypeFinalists {

    // Store the data
    public $prod_meta_fields = array( 
		'title', 'description', 'ptype', 'pcat', 'posturl', 'judgedby', 'twitname'
	);	
	
    // The post type constructor
    public function TypeFinalists() {
		$iconpath = get_bloginfo('template_directory') . "/images/ratingmedal.png";
        $finalistArgs = array(
            'labels' => array(
                'new_item' => __( 'New Finalist' ),
                'view_item' => __( 'View Finalist' ),
                'edit_item' => __( 'Edit Finalist' ),
                'search_items' => __( 'Search Finalists' ),
                'add_new_item' => __( 'Add New Finalist' ),
                'add_new' => __( 'Add New Finalist', 'finalist' ),
                'not_found' =>  __( 'No finalists found in search' ),
                'name' => __( 'Finalists', 'post type general name' ),
                'not_found_in_trash' => __( 'No finalists found in Trash' ),
                'singular_name' => __( 'Finalist', 'post type singular name' ),
            ),
            'public' => true, 
            'show_ui' => true,
            '_builtin' => false,
			'menu_position' => 1,			
            'hierarchical' => false,
			'menu_icon' => $iconpath,
            'query_var' => 'finalist',
            'capability_type' => 'post',
			'exclude_from_search' => false,
            'taxonomies' =>  array( 'category' ),
            'supports' => array( 'title','editor', ) 
            'rewrite' => array( 'slug' => 'finalist' ),
        );
        register_post_type( 'finalist', $finalistArgs );    
	
        // Initialize the methods
        add_action( 'admin_init', array( &$this, 'finalist_meta_boxes' ));
        add_action( 'template_redirect', array( &$this, 'template_redirect' ));
        add_action( 'wp_insert_post', array( &$this, 'wp_insert_post' ), 10, 2 );

        add_filter( 'manage_posts_custom_column', array( &$this, 'finalist_custom_columns' ));
        add_action( 'manage_edit-finalist_columns', array( &$this, 'finalist_edit_columns' ));
    }

    // Create the columns and heading title text
    public function finalist_edit_columns($columns) {
        $columns = array(
            'cb' 		=> '<input type="checkbox" />',
            'title' 	=> 'Finalist Title',
            'ptype' 	=> 'Post Type',
            'pcat' 		=> 'Category',
			'judgedby' 	=> 'Judged By',
			'posturl' 	=> 'Submission URL'
        );
        return $columns;
    }
    // switching cases based on which $column we show the content of it
    public function finalist_custom_columns($column) { 
        global $post, $ptype, $pcat, $judgedby, $posturl;

        switch ($column) {
            case 'title' : the_title();
                break;
            case 'ptype' : echo $ptype;
                break;
            case 'pcat' : echo $pcat;
                break;                
            case 'judgedby' : echo $judgedby;
				break;
			case 'posturl' : echo $posturl;
				break;
        }
    }

    // Template redirect for custom templates
    public function template_redirect() {
        global $wp_query;
        if ( $wp_query->query_vars['post_type'] == 'finalist' ) {
            get_template_part( 'single-finalist' ); // a custom page-slug.php template
            die();
        }
    }
    // For inserting new 'finalist' post type posts
    public function wp_insert_post($post_id, $post = null) {
        if ($post->post_type == 'finalist') {
            foreach ($this->prod_meta_fields as $key) {
                $value = @$_POST[$key];
                if (empty($value)) {
                    delete_post_meta($post_id, $key);
                    continue;
                }
                if (!is_array($value)) {
                    if (!update_post_meta($post_id, $key, $value)) {
                        add_post_meta($post_id, $key, $value);
                    }
                } else {
                    delete_post_meta($post_id, $key);
                    foreach ($value as $entry) add_post_meta($post_id, $key, $entry);
                }
            }
        }
    }

    /**
	 * Add finalist meta boxes
	 */
    function finalist_meta_boxes() {
		wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.4.4.min.js' );
		//add_meta_box( 'finalists-box', 'Finalist Info', array( &$this, 'finalist_list_box' ), 'finalists', 'normal', 'high' );
        add_meta_box( 'person-meta', 'Twitter Name', array( &$this, 'twit_options' ), 'finalist', 'normal', 'high' );

    }

    // Admin twit contents
    public function twit_options() {
        global $post, $twitname;
        $twiturl = '';
        $twitname = get_post_meta( $post->ID, 'twitname', true );
        if ( $twitname != '' ) {
            // Check if url has http:// or not so works either way
            $twiturl  = 'http://twitter.com/'. $twitname;
            $twitimg = 'http://img.tweetimag.es/i/'. $twitname .'_o';
        } ?>

        <div style="float:right; overflow:hidden; height:90px;"><?php echo '<a href="' . $twiturl . '"><img src="' . $twitimg . '" width="73" height="73" /></a>'; ?></div>
        <div style="height:75px; "><label>Persons Twitter handle: @<input id="twitname" size="30" name="twitname" value="<?php echo $twitname; ?>" /></label></div>

    <?php
    } // end meta options

    public function twitshot() {
        global $post, $twitname;
        $twiturl = '';
        $twitimg = '';
        $twitname = get_post_meta($post->ID, 'twitname', true);
        if ( $twitname != '' ) {
            $twiturl  = 'http://twitter.com/'. $twitname;
            $twitimg = 'http://img.tweetimag.es/i/'. $twitname .'_o';
            $twitname = $twitname;
        }
        
        return array( $twiturl, $twitimg, $twitname );
    }

} // end of TypeProducts{} class

?>