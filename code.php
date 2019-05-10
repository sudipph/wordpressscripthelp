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

