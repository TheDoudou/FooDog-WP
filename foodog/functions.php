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
add_image_size('like', 200, 200);

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
add_action( 'widgets_init', 'theme_foodog_responsive_init' );


function theme_foodog_sidebar_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'theme-foodog' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-foodog' ),
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}

function theme_foodog_sidebar_single_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Single Sidebar', 'theme-foodog' ),
        'id' => 'sidebar-2',
        'description' => __( 'Widgets in this area will be shown on single page.', 'theme-foodog' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}

function theme_foodog_last_insta_post_init() {
    register_sidebar( array(
        'name' => __( 'Footer', 'theme-foodog' ),
        'id' => 'sidebar-3',
        'description' => __( 'Widgets in this area will be shown on footer.', 'theme-foodog' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

function theme_foodog_responsive_init() {
    register_sidebar( array(
        'name' => __( 'Responsive', 'theme-foodog' ),
        'id' => 'sidebar-4',
        'description' => __( 'View element with responsive display.', 'theme-foodog' ),
        'before_widget' => '<div class="responsive_view align-self-center">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

/**
 * Register and load the widget
 * 
 */
function wpb_load_widget() {
    register_widget( 'FDInstaGetPicWidget' );
    register_widget( 'FDSocialNetworkWidget' );
    register_widget( 'FDDivInOut' );
}

add_action( 'widgets_init', 'wpb_load_widget' );
 
/**
 * Creating the Instagram get picture widget
 * 
 * @class FDInstaGetPicWidget()
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

            echo '<a href="https://www.instagram.com/'.$account.'/" target="_blank" rel="noreferrer"><h3 class="h3-title"> INSTAGRAM </h3></a>';
            echo '<div class="row insta_center_footer">';

            for ($i = 0; $i < $number; $i++) {
                $src = $arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i]['node']['thumbnail_resources'][1]['src'];
                $href = $arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i]['node']['display_url'];

                echo '<div class="col-xs-4">
                    <a href="'.$href.'" target="_blank" rel="noreferrer"><img class="img-instagram" src="'.$src.'" alt="Instagram picture"></a>
                </div>';
            }
            echo '</div>';
            //echo $args['before_title'] . $url . $args['after_title'];
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
} // Class FDInstaGetPicWidget ends

/**
 * Creating the facebook link widget
 * 
 * @class FDSocialNetworkWidget()
 */ 
class FDSocialNetworkWidget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
        
            // Base ID of your widget
            'FDSocialNetworkWidget', 
            
            // Widget name will appear in UI
            __('Social Network Link', 'FDSocialNetworkWidget_domain'), 
            
            array( 'description' => __( 'Link to social page', 'FDSocialNetworkWidget_domain' ), ) 
        );
    }
    
    // Front-end
    public function widget( $args, $instance ) {
        $account = apply_filters( 'widget_account', $instance['account'] );
        $type = apply_filters( 'widget_type', $instance['type'] );
        $class = apply_filters( 'widget_type', $instance['class'] );
        $apiKey = apply_filters( 'widget_type', $instance['api'] );
        $txt1 = 'LIKE';
        $txt2 = 'Fans';

        if ($class == 'twitter' || $class == 'instagram') {
            $txt1 = 'FOLLOW';
            $txt2 = 'Followers';
        }

        echo $args['before_widget'];
        if ( ! empty( $account ) ) {

            $get_json = file_get_contents(''.$account);
            $sidebar = "sidebar_nav2";

            if ( $type == "extend") {
                $sidebar = "sidebar_nav";

                if ($class == 'facebook') {
                    $url = "https://facebook.com/".$account;
                    $count = getFBCount($account, $apiKey);

                    
                }
                else if ($class == 'twitter') {
                    $url = "https://twitter.com/".$account;
                    $count = getTwitterCount($account);
                }
                else if ($class == 'instagram') {
                    $url = "http://instagram.com/".$account;
                    $count = getInstaCount($account);
                }

                $view = '<a href="'.$url.'" class="sidebar_link" target="_blank" rel="noreferrer"><li class="sidebar_link sidebar_link_'.$class.'"><i class="fa fa-'.$class.' sidebar_'.$class.' p-2"></i><p class="sidebar_follow_number p-1">'.$count.' '.$txt2.'</p><p class="sidebar_follow ml-auto p-2">'.$txt1.'</p></li></a>';
            } else {
                $view = '<a href="'.$url.'" class="icon_'.$class.'" target="_blank" rel="noreferrer"><i class="fa fa-'.$class.'"></i></a>';
            }

            if ($type == 'extend')
                echo '<div class="sidebar_global">';
            else
                echo '<div class="sidebar_single">';
                    
            echo '<ul class="'.$sidebar.'">';
            echo $args['before_view'] . $view . $args['after_view'];
            echo '</ul>
                </div>';
        }
        // This is where you run the code and display the output
        echo $args['after_widget'];
    }
            
    // Back-end 
    public function form( $instance ) {
        if ( isset( $instance[ 'account' ] ) ) {
            $account = $instance[ 'account' ];
            $type = $instance[ 'type' ];
            $class = $instance[ 'class' ];
            $apiKey = $instance[ 'api' ];
        }
        else {
            $account = __( '', 'FDSocialNetworkWidget_domain' );
            $type = __( 'simple', 'FDSocialNetworkWidget_domain' );
            $class = __( '', 'FDSocialNetworkWidget_domain' );
            $apiKey = __( '', 'FDSocialNetworkWidget_domain' );
        }

        // Widget admin form
        ?>
        <p>
            <label for="<?= $this->get_field_id( 'class' ); ?>"><?php _e( 'Social Network :' ); ?></label> 
            <select id="<?= $this->get_field_id( 'class' ); ?>" name="<?= $this->get_field_name( 'class' ); ?>">
                <option value="facebook" <?= ($class == 'facebook')?'selected':null;?>>Facebook</option>
                <option value="twitter" <?= ($class == 'twitter')?'selected':null;?>>Twitter</option>
                <option value="instagram" <?= ($class == 'instagram')?'selected':null;?>>Instagram</option>
                <option value="pinterest" <?= ($class == 'pinterest')?'selected':null;?>>Pinterest</option>
            </select>
        </p>
        <p>
            <label for="<?= $this->get_field_id( 'account' ); ?>"><?php _e( 'Page name :' ); ?></label> 
            <input class="" id="<?= $this->get_field_id( 'account' ); ?>" name="<?= $this->get_field_name( 'account' ); ?>" type="text" value="<?= esc_attr( $account ); ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id('type'); ?>">
                <?php _e('Simple '); ?>
                <input class="" id="<?= $this->get_field_id( 'type' ); ?>" name="<?=$this->get_field_name( 'type' ); ?>" type="radio" value="simple" <?= ( esc_attr( $type ) == 'simple' ? ' checked' : '') ?> />
            </label>
            <label for="<?= $this->get_field_id('type'); ?>">
                <?php _e('Extended '); ?>
                <input class="" id="<?= $this->get_field_id( 'type' ); ?>" name="<?= $this->get_field_name( 'type' ); ?>" type="radio" value="extend" <?= ( esc_attr( $type ) == 'extend' ? ' checked' : '') ?> />
            </label>
        </p>
        <p>
            <label class="api_hide" for="<?= $this->get_field_id('api'); ?>">
                <?php _e('Api Key '); ?>
                <input class="" id="<?= $this->get_field_id( 'api' ); ?>" name="<?= $this->get_field_name( 'api' ); ?>" type="text" value="<?= esc_attr( $apiKey ); ?>" />
            </label>
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        $instance['account'] = ( ! empty( $new_instance['account'] ) ) ? strip_tags( $new_instance['account'] ) : '';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : '';
        $instance['class'] = ( ! empty( $new_instance['class'] ) ) ? strip_tags( $new_instance['class'] ) : '';
        return $instance;
    }
} // Class FDFacebookLinkWidget ends

class FDDivInOut extends WP_Widget {
    function __construct() {
        parent::__construct(
        
            // Base ID of your widget
            'FDDivInOut', 
            
            // Widget name will appear in UI
            __('Div Open Close', 'FDDivInOut_domain'), 
            
            array( 'description' => __( 'Add Open and close div', 'FDDivInOut_domain' ), ) 
        );
    }

    // Front-end
    public function widget( $args, $instance ) {
        $class = apply_filters( 'widget_account', $instance['class'] );
        $type = apply_filters( 'widget_type', $instance['type'] );

        if ($type == 'open')
            echo '<div class="'.$class.'">';
        if ($type == 'close')
            echo '</div>';
    }

    // Back-end 
    public function form( $instance ) {
        if ( isset( $instance[ 'type' ] ) ) {
            $type = $instance[ 'type' ];
            $class = $instance[ 'class' ];
        }
        else {
            $type = __( 'open', 'FDSocialNetworkWidget_domain' );
            $class = __( '', 'FDSocialNetworkWidget_domain' );
        }

        // Widget admin form
        ?>
        <p>
            <label for="<?= $this->get_field_id('type'); ?>">
                <?php _e('Open '); ?>
                <input class="" id="<?= $this->get_field_id( 'type' ); ?>" name="<?= $this->get_field_name( 'type' ); ?>" type="radio" value="open" <?= ( esc_attr( $type ) == 'open' ? ' checked' : '') ?> />
            </label>
            <label for="<?= $this->get_field_id('type'); ?>">
                <?php _e('Close '); ?>
                <input class="" id="<?= $this->get_field_id( 'type' ); ?>" name="<?= $this->get_field_name( 'type' ); ?>" type="radio" value="close" <?= ( esc_attr( $type ) == 'close' ? ' checked' : '') ?> />
            </label>
        </p>
        <p>
            <label class="api_hide" for="<?= $this->get_field_id('class'); ?>">
                <?php _e('Api Key '); ?>
                <input class="" id="<?= $this->get_field_id( 'class' ); ?>" name="<?= $this->get_field_name( 'class' ); ?>" type="text" value="<?= esc_attr( $class ); ?>" />
            </label>
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : '';
        $instance['class'] = ( ! empty( $new_instance['class'] ) ) ? strip_tags( $new_instance['class'] ) : '';
        return $instance;
    }
}


function getFBCount($acc, $api) {


    return '65432';
}

function getTwitterCount($acc) {
    // get page
    $ch = file_get_contents('https://twitter.com/'. $acc .'?lang=fr');

    $doc = new DOMDocument();
    $doc->loadHTML($ch);
    
    $finder = new DomXPath($doc);
    
    $classname="ProfileNav-stat";
    $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
    
    // translate followers in each lang to replace it
    preg_match_all('!\d+!', $nodes[2]->textContent, $matches);

    return $matches[0][0];
}

function getInstaCount($acc) {
    $url_get = file_get_contents('https://www.instagram.com/'.$acc);

    $arr_insta = explode('window._sharedData = ',$url_get);
    
    $arr_insta = explode(';</script>',$arr_insta[1]);
    
    $arr_insta = json_decode($arr_insta[0] , true);
    //print("<pre>".print_r($arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'],true)."</pre>"); //['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][0]

    return $arr_insta['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'];

}