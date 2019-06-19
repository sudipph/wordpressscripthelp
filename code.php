<?php

/**date Picke */

function wpse_enqueue_datepicker() {
	// Load the datepicker script (pre-registered in WordPress).
	wp_enqueue_script( 'jquery-ui-datepicker' );

	// You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
	wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_style( 'jquery-ui' );  
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker' );
?>

<script>
    jQuery(document).ready(function($) {
        $("#datepicker").datepicker();
    });
</script>
<?php





/**custom field option Group */
function social_networking_link(){

	$variable = get_field('social', 'option');
	$sl = '';
	$tot_sl = count($variable);
	
	if($tot_sl > 0){
		$sl .= '<ul class="inline-list">';
		foreach($variable as $vl){
			$contitle = strtolower($vl['title']);
			if($contitle == 'facebook'){
				$contitle = 'facebook-f';
			}else if($contitle == 'linkedin'){
				$contitle = 'linkedin-in';
			}
			$sl .= '<li><a rel="'.$vl['title'].'" href="'.$vl['url'].'"><i class="fab fa-'.$contitle.'"></i></a></li>';
		}
		$sl .= '</ul>';
	}
	return $sl;
//	var_dump($variable);
}

/** disable widget  */

  add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );

function override_woocommerce_widgets() {
  

  if ( class_exists( 'WP_Widget_Custom_HTML' ) ) {
    unregister_widget( 'WP_Widget_Custom_HTML' );

   

    register_widget( 'WP_Widget_Custom_HTML_new' );
  }

}
/** admin head  */

	function disable_link_title() {
		echo '<style>.wp-link-text-field{display: none !important;}</style>';
	}
	add_action( 'admin_head', 'disable_link_title' );


	/**js Localize */

	add_action('init', 'my_init');
	add_action( 'wp', 'test_js' );
	
	function my_init() {
	 wp_enqueue_script( 'jquery' );
	}
	
	function test_js() {
	
	   wp_register_script ('testjs', plugins_url('jstest.js', __FILE__));
	   wp_enqueue_script ('testjs');
	   $my_arr = array('my array',
		 'name' => 'Test',
	   );
	   $my_json_str = json_encode($my_arr); 
	
	   $params = array(
		 'my_arr' => $my_json_str,
	   );
	
	
	   wp_localize_script('testjs', 'php_params', $params);
	}
	
	add_action('wp_footer','footertestjs');
	
	function footertestjs(){
		?>
		<script>
		  jQuery(document).ready(function() {
			alert ('test');
			var my_json_str = php_params.my_arr.replace(/&quot;/g, '"');
			var my_php_arr = jQuery.parseJSON(my_json_str);
			alert(php_params);    
		  });
		</script>
		<?php
	}

?>

	jQuery(document).ready(function() {
		alert ('test');
		var my_json_str = php_params.my_arr.replace(/&quot;/g, '"');
		var my_php_arr = jQuery.parseJSON(my_json_str);
		alert(php_params);    
	  });
	  
	/**turnary operator */
	$tt_button_link = vc_build_link($tt_button_link);

	target="'.($banner_b_link1['target']!=''?$banner_b_link1['target']:'').'" href="'.($banner_b_link1['url']!=''?$banner_b_link1['url']:'#').'"


	$ii = wp_get_attachment_image_src( $image_id, 'full' );

	textarea_raw_html >>>> rawurldecode(base64_decode($tt_mm_content));
/**CAF Custom Field get data by ID */
	$date_cc = get_post_meta(get_the_ID(),'event_date');
	get_the_post_thumbnail( get_the_ID(), array( 100, 100) );



	override_function














	?>
	<script>
	/**default binding */
/**call and apply */

	</script>
<?php
	/*code pre_get_posts*/
	add_filter('pre_get_posts','better_editions_archive');

function better_editions_archive( $query ) {

    if ( $query->is_tax( 'edition' ) && $query->is_main_query() ) {
        $terms = get_terms( 'edition', array( 'fields' => 'ids' ) );
        $query->set( 'post_type', array( 'post' ) );
        $query->set( 'tax_query', array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'edition',
                'field' => 'id',
                'terms' => $terms,
                'operator' => 'NOT IN'
            )
        ) );
    }

    return $query;
}

/*code pre_get_posts*/




function crunchify_social_sharing_buttons($content) {
	global $post;
	if(is_singular() || is_home()){
	
		// Get current page URL 
		$crunchifyURL = urlencode(get_permalink());
 
		// Get current page title
		$crunchifyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
		// $crunchifyTitle = str_replace( ' ', '%20', get_the_title());
		
		// Get Post Thumbnail for pinterest
		$crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
		$googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$crunchifyURL.'&amp;text='.$crunchifyTitle;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$crunchifyURL.'&amp;title='.$crunchifyTitle;
		//https://wa.me/?text=[post-title] [post-url]
		//whatsapp://send?text=<?php echo urlencode
		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;
 
		// Add sharing button at the end of page/page content
		$content .= '<!-- Implement your own superfast social sharing buttons without any JavaScript loading. No plugin required. Detailed steps here: http://crunchify.me/1VIxAsz -->';
		$content .= '<div class="crunchify-social">';
		$content .= '<h5>SHARE ON</h5> <a class="crunchify-link crunchify-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a>';
		$content .= '<a class="crunchify-link crunchify-facebook" href="'.$facebookURL.'" target="_blank">Facebook</a>';
		$content .= '<a class="crunchify-link crunchify-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
		$content .= '<a class="crunchify-link crunchify-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
		$content .= '<a class="crunchify-link crunchify-linkedin" href="'.$linkedInURL.'" target="_blank">LinkedIn</a>';
		$content .= '<a class="crunchify-link crunchify-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pin It</a>';
		$content .= '</div>';
		
		return $content;
	}else{
		// if not a post/page then don't include sharing button
		return $content;
	}
};
add_filter( 'the_content', 'crunchify_social_sharing_buttons');

/**refer code */

YITH_WC_Points_Rewards()->get_option( 'enable_points_upon_sales');

$points   = get_user_meta( get_current_user_id(), '_ywpar_user_total_points', true );
$points   = ( $points == '' ) ? 0 : $points;

    $singular = YITH_WC_Points_Rewards()->get_option( 'points_label_singular' );
    $plural   = YITH_WC_Points_Rewards()->get_option( 'points_label_plural' );
    var_dump($plural);
    $history = YITH_WC_Points_Rewards()->get_history( get_current_user_id() );
		var_dump($points);
		

		db host name:- db01.developer24x7.com
db user name:- sudippodder
db user password:-  Wrt!7&^3321$##py



cat /var/log/apache2/error.log


Woocommerce setting add options

https://docs.woocommerce.com/document/adding-a-section-to-a-settings-tab/

Abstract class : combining multiple smaller operations into a single unit that can be referred to by name.
Encapsulation(information hiding)- separating implementation from interfaces.
Inheritance : defining objects data types as extensions and/or restrictions of other object data types.
Polymorphism : using the same name to invoke different operations on objects of different data types.


