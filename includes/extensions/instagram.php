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
 * Instagram Shortcode
 */

add_action('init', 'fsn_init_instagram', 12);
function fsn_init_instagram() {

	if (function_exists('fsn_map')) {

		$instagram_params = array(
			array(
				'type' => 'text',
				'param_name' => 'instagram_shortcode',
				'label' => __('Instagram Shortcode', 'ampullate-fusion-extension-instagram'),
			),
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
			'description' => __('Add Instagram feed. Instagram feeds by user name are deprecated and shortcodes of type [instagram-feed feed="x"] should now be used.', 'ampullate-fusion-extension-instagram'),
			'icon' => 'photo',
			'disable_style_params' => array('text_align','text_align_xs','font_size','color'),
			'params' => $instagram_params
		));
	}
}

/**
 * Output Shortcode
 */
function fsn_instagram_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'instagram_name' => '',
		'instagram_shortcode' => ''
	), $atts ) );
	$instagram_shortcode = trim($instagram_shortcode);
	$instagram_name = trim($instagram_name);

	$instagram_id = uniqid();
	$output = '';
	$output .= '<div class="fsn-instagram '. fsn_style_params_class($atts) .'">';
	$output .= '	<div class="embed-container">';
	$output .= '		<div id="instagram_'. esc_attr($instagram_id) .'" class="instagram-js vjs-default-skin">';

	if (!$instagram_shortcode) {
		$output .= '			[instagram-feed type="user" user="' . $instagram_name . '"]';
	} else {
		extract( shortcode_atts( array(
			'feed' => '',
		), $atts ) );
		$feed = preg_replace('/["\']/', '', $feed);
		$output .= '			[instagram-feed feed=' . $feed . ']';
	}

	$output .= '		</div>';
	$output .= '	</div>';
	$output .= '</div>';

	return do_shortcode($output, false);
}
add_shortcode('fsn_instagram', 'fsn_instagram_shortcode');
