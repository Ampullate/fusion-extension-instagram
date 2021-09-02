<?php
/**
 * @package Fusion_Extension_Instagram
 */

/**
 * Instagram Fusion Extension.
 *
 * Function for adding a Instagram element to the Fusion Engine
 *
 * @since 1.0.0
 */

/**
 * Map Shortcode
 */

add_action('init', 'fsn_init_instagram', 12);
function fsn_init_instagram() {

	if (function_exists('fsn_map')) {

		$instagram_params = array(
			array(
				'type' => 'text',
				'param_name' => 'instagram_name',
				'label' => __('Instagram Username', 'ampullate-fusion-extension-instagram'),
			),
		);

		//filter instagram params
		$instagram_params = apply_filters('fsn_instagram_params', $instagram_params);

		fsn_map(array(
			'name' => __('Instagram', 'ampullate-fusion-extension-instagram'),
			'shortcode_tag' => 'fsn_instagram',
			'description' => __('Add Instagram feed. Instagram feeds by user name are supported.', 'ampullate-fusion-extension-instagram'),
			'icon' => 'photo',
			'disable_style_params' => array('text_align','text_align_xs','font_size','color'),
			'params' => $instagram_params
		));
	}
}

function get_filtered_instagram_feed_options($options_provided=[]) {
	$options_provided['type'] = 'user';
// 	$options_provided['layout'] = 'carousel';
// 	$options_provided['carouselrows'] = 1;
// 	$options_provided['imagepadding'] = 0;
// 	$options_provided['cols'] = 4;
// 	$options_provided['num'] = 6;
// 	$options_provided['mobilecols'] = 2;
// 	$options_provided['mobilenum'] = 4;

	$filtered_imploded_options = [];
	foreach ($options_provided as $key=>$value) {
		$filtered_imploded_options[] = $key . '=' . $value;
	}
	return $filtered_imploded_options;
}

/**
 * Output Shortcode
 */

function fsn_instagram_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'instagram_name' => '',
	), $atts ) );

	$instagram_name = trim($instagram_name);

	//plugin
	wp_enqueue_script('fsn_instagram');

	$shortcode_start_marker = '[instagram-feed ';
	if ($instagram_name) {
		$filtered_instagram_feed_options = get_filtered_instagram_feed_options(['user'=>"'$instagram_name'"]);
	} else {
		$filtered_instagram_feed_options = get_filtered_instagram_feed_options([]);
	}
	$instagram_shortcode = $shortcode_start_marker . implode(' ', $filtered_instagram_feed_options) . ']';
	$instagram_feed = do_shortcode($instagram_shortcode);

	$output = '';

	$output .= '<div class="fsn-instagram '. esc_attr($instagram_name ? $instagram_name : 'default-feed') .' '. fsn_style_params_class($atts) .'">';
	//action executed before the instagram output
	ob_start();
	do_action('fsn_before_instagram', $atts);
	$output .= ob_get_clean();

	$instagram_id = uniqid();

	$output .= '	<div class="embed-container">';
	$output .= '		<div id="instagram_'. esc_attr($instagram_id) .'" class="instagram-js vjs-default-skin">';
	$output .= '			' . $instagram_feed;
	$output .= '		</div>';
	$output .= '	</div>';

	//action executed after the instagram output
	ob_start();
	do_action('fsn_after_instagram', $atts);
	$output .= ob_get_clean();

	$output .= '</div>';

	return $output;
}
add_shortcode('fsn_instagram', 'fsn_instagram_shortcode');

?>
