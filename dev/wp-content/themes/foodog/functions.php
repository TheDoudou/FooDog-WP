<?php
/**
 * FooDog functions and definitions
 *
 * @package FooDog
 * 
 */

 // Set size for picture
add_theme_support('post-thumbnails');

add_image_size('headerbig', 1000, 1000);
add_image_size('header', 180, 160);
add_image_size('latest', 270, 600);

add_image_size( 'foodog-masonry-image', 450, 9999, false );



/**
 * Add Admin category choice for nav view and order (header and footer)
 * 
 * @return html View html element
 * 
 */
function foodog_edit_category_field( $term ){

    $term_id = $term->term_id;
    $term_meta = get_option( "taxonomy_$term_id" );         
?>
    <tr class="form-field">
        <th scope="row">
            <label for="term_meta[headhide]"><?php echo _e('Header menu hide') ?></label>
            <td>
            	<select name="term_meta[headhide]" id="term_meta[headhide]">
                	<option value="0" <?=($term_meta['headhide'] == 0) ? 'selected': ''?>><?php echo _e('No'); ?></option>
                	<option value="1" <?=($term_meta['headhide'] == 1) ? 'selected': ''?>><?php echo _e('Yes'); ?></option>
            	</select>                   
            </td>
        </th>
    </tr>
    <tr class="form-field">
        <th scope="row">
            <label for="term_meta[headnumber]"><?php echo _e('Number of header order') ?></label>
            <td>
            	<select name="term_meta[headnumber]" id="term_meta[headnumber]">
                	<option value="0" <?=($term_meta['headnumber'] == 0) ? 'selected': ''?>><?php echo _e('No'); ?></option>
                	<option value="1" <?=($term_meta['headnumber'] == 1) ? 'selected': ''?>><?php echo _e('Yes'); ?></option>
            	</select>                   
            </td>
        </th>
    </tr>
    <tr class="form-field">
        <th scope="row">
            <label for="term_meta[foothide]"><?php echo _e('Footer menu hide') ?></label>
            <td>
            	<select name="term_meta[foothide]" id="term_meta[foothide]">
                	<option value="0" <?=($term_meta['foothide'] == 0) ? 'selected': ''?>><?php echo _e('No'); ?></option>
                	<option value="1" <?=($term_meta['foothide'] == 1) ? 'selected': ''?>><?php echo _e('Yes'); ?></option>
            	</select>                   
            </td>
        </th>
    </tr>
    <tr class="form-field">
        <th scope="row">
            <label for="term_meta[footnumber]"><?php echo _e('Number of footer order') ?></label>
            <td>
            	<select name="term_meta[footnumber]" id="term_meta[footnumber]">
                	<option value="0" <?=($term_meta['footnumber'] == 0) ? 'selected': ''?>><?php echo _e('No'); ?></option>
                	<option value="1" <?=($term_meta['footnumber'] == 1) ? 'selected': ''?>><?php echo _e('Yes'); ?></option>
            	</select>                   
            </td>
        </th>
    </tr>
<?php
} 

add_action( 'category_edit_form_fields', 'foodog_edit_category_field' ); 

/**
 * Save custom category field
 *
 **/
function foodog_save_term_meta( $term_id ){ 
  
    if ( isset( $_POST['term_meta'] ) ) {
         
        $term_meta = array();

        $term_meta['headhide'] = isset ( $_POST['term_meta']['headhide'] ) ? intval( $_POST['term_meta']['headhide'] ) : '';
        $term_meta['headnumber'] = isset ( $_POST['term_meta']['headnumber'] ) ? intval( $_POST['term_meta']['headnumber'] ) : '';
        $term_meta['foothide'] = isset ( $_POST['term_meta']['foothide'] ) ? intval( $_POST['term_meta']['foothide'] ) : '';
        $term_meta['footnumber'] = isset ( $_POST['term_meta']['footnumber'] ) ? intval( $_POST['term_meta']['footnumber'] ) : '';

        update_option( "taxonomy_$term_id", $term_meta );
 
    } 
}

add_action( 'edited_category', 'foodog_save_term_meta', 10, 2 ); 

/**
 * Add columns to category view admin
 *
 **/
function foodog_category_columns($columns)
{
    return array_merge($columns, 
              array('headhide' =>  __('Header hide'), 'headnumber' =>  __('Header order'), 'foothide' =>  __('Footer hide'), 'footnumber' =>  __('Footer order')));
}

add_filter('manage_edit-category_columns' , 'foodog_category_columns');

/**
 * Add value to columns in category view admin
 *
 **/
function foodog_category_columns_values( $deprecated, $column_name, $term_id) {
 
	if($column_name === 'headhide'){ 
		
		$term_meta = get_option( "taxonomy_$term_id" );
		
		if($term_meta['headhide'] === 1){
			
			echo _e('Yes');
		}else{
			echo _e('No');
		}	
	} else if($column_name === 'headnumber'){ 
		
		$term_meta = get_option( "taxonomy_$term_id" );
		
		if($term_meta['headnumber'] === 1){
			
			echo _e('Yes');
		}else{
			echo _e('No');
		}	
    } else if($column_name === 'foothide'){ 
		
		$term_meta = get_option( "taxonomy_$term_id" );
		
		if($term_meta['foothide'] === 1){
			
			echo _e('Yes');
		}else{
			echo _e('No');
		}	
	} else if($column_name === 'footnumber'){ 
		
		$term_meta = get_option( "taxonomy_$term_id" );
		
		if($term_meta['footnumber'] === 1){
			
			echo _e('Yes');
		}else{
			echo _e('No');
		}	
	}
}
 
add_action( 'manage_category_custom_column' , 'foodog_category_columns_values', 10, 3 );

add_action( 'category_add_form_fields', 'foodog_edit_category_field' );
add_action( 'create_category', 'foodog_save_term_meta', 10, 2 );   

/**
 *  End cat field
 */

/**
 * Update count view by post
 *
 * @param int $pid Post ID
 * 
 * @return null Update count post
 * 
 */
function foodog_post_update_count( $pid ) {

    $countKey = '_foodog_post_views_count';
    $count = get_post_meta($pid, $countKey, true);

    if($count == '') {
        $count = 1;
        delete_post_meta($pid, $countKey);
    } else
        $count++;
        
    update_post_meta($pid, $countKey, $count);

}

/**
 * Add Side bar zone :
 * - Side bar global
 * - Side bar single page
 * - Footer
 * 
 */

add_action( 'widgets_init', 'theme_foodog_sidebar_widgets_init' );
add_action( 'widgets_init', 'theme_foodog_sidebar_single_widgets_init' );
add_action( 'widgets_init', 'theme_foodog_last_insta_post_init' );


function theme_foodog_sidebar_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'theme-foodog' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-foodog' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

function theme_foodog_sidebar_single_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Single Sidebar', 'theme-foodog' ),
        'id' => 'sidebar-2',
        'description' => __( 'Widgets in this area will be shown on single page.', 'theme-foodog' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

function theme_foodog_last_insta_post_init() {
    register_sidebar( array(
        'name' => __( 'Footer', 'theme-foodog' ),
        'id' => 'sidebar-3',
        'description' => __( 'Widgets in this area will be shown on footer.', 'theme-foodog' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

/**
 * Register and load the widget
 * 
 */
function wpb_load_widget() {
    register_widget( 'FDInstaGetPicWidget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
/**
 * Creating the Instagram get picture widget
 * 
 */ 
class FDInstaGetPicWidget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
        
            // Base ID of your widget
            'FDInstaGetPicWidget', 
            
            // Widget name will appear in UI
            __('Instagram Picture', 'FDInstaGetPicWidget_domain'), 
            
            array( 'description' => __( 'Get last Instagram picture', 'FDInstaGetPicWidget_domain' ), ) 
        );
    }
    
    // Front-end
    public function widget( $args, $instance ) {
        $account = apply_filters( 'widget_account', $instance['account'] );
        $number = apply_filters( 'widget_number', $instance['number'] );
        
        echo $args['before_widget'];
        if ( ! empty( $account ) ) {


            $url_insta = file_get_contents('https://www.instagram.com/'.$account);

            $arr_insta = explode('window._sharedData = ',$url_insta);
            $arr_insta = explode(';</script>',$arr_insta[1]);
            $arr_insta = json_decode($arr_insta[0] , true);

            //print("<pre>".print_r($arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][0],true)."</pre>");

            echo '<a href="https://www.instagram.com/'.$account.'/" target="_blank"><h3 class="h3-title"> INSTAGRAM </h3></a>';
            echo '<div class="row">';

            for ($i = 0; $i < $number; $i++) {
                $src = $arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i]['node']['thumbnail_resources'][1]['src'];
                $href = $arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i]['node']['display_url'];

                echo '<div class="col-xs-4">
                    <a href="'.$href.'" target="_blank"><img class="img-instagram" src="'.$src.'"></a>
                </div>"';
            }
            echo '</div>';
            echo $args['before_title'] . $url . $args['after_title'];
        }
        // This is where you run the code and display the output
        echo $args['after_widget'];
    }
            
    // Back-end 
    public function form( $instance ) {

        if ( isset( $instance[ 'account' ] ) ) {
            $account = $instance[ 'account' ];
            $number = $instance[ 'number' ];
        }
        else {
            $account = __( '', 'FDInstaGetPicWidget_domain' );
            $number = __( '9', 'FDInstaGetPicWidget_domain' );
        }

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'account' ); ?>"><?php _e( 'Account name :' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" type="text" value="<?php echo esc_attr( $account ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'How many (max 12) :' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['account'] = ( ! empty( $new_instance['account'] ) ) ? strip_tags( $new_instance['account'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends