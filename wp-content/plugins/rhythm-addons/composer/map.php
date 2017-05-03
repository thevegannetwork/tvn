<?php
/*
* Visual Composre Map File
*/

function rs_get_current_post_type() {

	$type = false;

	if( isset( $_GET['post'] ) ) {
		$id = $_GET['post'];
		$post = get_post( $id );

		if( is_object( $post ) && $post->post_type == 'portfolio' ) {
			$type = true;
		}

	} elseif ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'portfolio' ) {
		$type = true;
	}

	return $type;

}

include_once( RS_ROOT .'/composer/helpers.php' );
include_once( RS_ROOT .'/composer/params.php' );

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
}

// Extras
// ------------------------------------------------------------------------------------------
$vc_map_animation = array(
	'type'        => 'dropdown',
	'heading'     => 'Animation',
	'param_name'  => 'animation',
	'admin_label' => true,
	'value'       => rs_get_animations(),
	'group'       => 'Animation'
);

$vc_map_animation_delay = array(
	'type'               => 'textfield',
	'heading'            => 'Animation Delay',
	'param_name'         => 'animation_delay',
	'edit_field_class'   => 'vc_col-md-6 vc_column',
	'value'              => '',
	'dependency'         => array( 'element' => 'animation', 'not_empty' => true ),
	'group'              => 'Animation'
);

$vc_map_animation_duration = array(
	'type'               => 'textfield',
	'heading'            => 'Animation Duration',
	'param_name'         => 'animation_duration',
	'edit_field_class'   => 'vc_col-md-6 vc_column',
	'value'              => '',
	'dependency'         => array( 'element' => 'animation', 'not_empty' => true ),
	'group'              => 'Animation'
);


$vc_column_width_list = array(
	'1 column - 1/12'     => '1/12',
	'2 columns - 1/6'     => '1/6',
	'3 columns - 1/4'     => '1/4',
	'4 columns - 1/3'     => '1/3',
	'5 columns - 5/12'    => '5/12',
	'6 columns - 1/2'     => '1/2',
	'7 columns - 7/12'    => '7/12',
	'8 columns - 2/3'     => '2/3',
	'9 columns - 3/4'     => '3/4',
	'10 columns - 5/6'    => '5/6',
	'11 columns - 11/12'  => '11/12',
	'12 columns - 1/1'    => '1/1'
);

$vc_map_extra_id = array(
	'type'        => 'textfield',
	'heading'     => 'Extra ID',
	'param_name'  => 'id',
	'group'       => 'Extras'
);

$vc_map_extra_class = array(
	'type'        => 'textfield',
	'heading'     => 'Extra Class',
	'param_name'  => 'class',
	'group'       => 'Extras'
);

$vc_map_match_height = array(
	'type'        => 'dropdown',
	'heading'     => 'Match Height',
	'param_name'  => 'match_height',
	'description' => 'Select yes, if you want to match columns heights which are in the same row',
	'value'       => array(
		'No'  => 'no',
		'Yes' => 'yes'
	),
	'group'       => 'Extras'
);

// ==========================================================================================
// VC ROW
// ==========================================================================================
vc_map( array(
	'name'                    => 'Row',
	'base'                    => 'vc_row',
	'icon'                    => 'fa fa-plus-square-o',
	'is_container'            => true,
	'show_settings_on_create' => false,
	'description'             => 'Place content elements inside the section',
	'params'                  => array(

		// Background
		// ------------------------------------------------------------------------------------------
		array(
			'type'                => 'colorpicker',
			'heading'             => 'Background Color',
			'param_name'          => 'bgcolor',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Overlay Style',
			'param_name'  => 'overlay_style',
			'value'       => array(
				'Select Overlay'       => '',
				'Dark With Opacity 30' => 'bg-dark-alfa-30',
				'Dark With Opacity 50' => 'bg-dark-alfa-50',
				'Dark With Opacity 70' => 'bg-dark-alfa-70',
				'Dark With Opacity 90' => 'bg-dark-alfa-90',
			),
		),
		array(
			'type'                => 'attach_image',
			'heading'             => 'Background Image',
			'param_name'          => 'background',
		),
		array(
			'type'                => 'dropdown',
			'value'               => array(
				'Yes'               => 'yes',
				'No'                => 'no',
			),
			'heading'             => 'Background Stretch',
			'description'         => 'Settings with Yes option will stretch the background image full as with container',
			'param_name'          => 'cover',
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'repeat',
			'heading'             => 'Background Repeat',
			'edit_field_class'    => 'vc_col-md-4 vc_column',
			'value'               => array(
				'No Repeat'             => 'no-repeat',
				'Repeat Horizontally'   => 'repeat-x',
				'Repeat Vertically'     => 'repeat-y',
				'Repeat Both'           => 'repeat',
			),
			'dependency'          => array( 'element' => 'cover', 'value' => array('no') ),
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'attachment',
			'heading'             => 'Background Attachment',
			'value'               => array(
				'Scroll'            => 'scroll',
				'Fixed'             => 'fixed',
			),
		),
		array(
			'type'                => 'dropdown',
			'value'               => array(
				'No'                => 'no',
				'Yes'               => 'yes',
			),
			'heading'             => '100% Full-width, without container',
			'param_name'          => 'fluid',
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'padding',
			'heading'             => 'Padding',
			'value'               => array(
				'No Padding'         => 'rella-no-padding',
				'Small Top + Bottom' => 'pt-70 pb-70 pt-xs-50 pb-xs-50',
				'Small Bottom'       => 'pb-70 pb-xs-50',
				'Big Top + Bottom'   => 'pt-140 pb-140 pt-xs-70 pb-xs-70',
				'Big Bottom Only'    => 'pb-140 pb-xs-70',
				'Custom Padding'     => 'custom-padding'
			),
		),

		array(
			'type'                => 'textfield',
			'heading'             => 'Padding Top',
			'param_name'          => 'top',
			'dependency'          => array( 'element' => 'padding', 'value' => array('custom-padding') ),
		),
		array(
			'type'                => 'textfield',
			'heading'             => 'Padding Bottom',
			'param_name'          => 'bottom',
			'dependency'          => array( 'element' => 'padding', 'value' => array('custom-padding') ),
		),



		array(
			'type'                => 'dropdown',
			'param_name'          => 'margin',
			'heading'             => 'Margin',
			'value'               => array(
				'No Margin'          => 'rella-no-margin',
				'Small Top + Bottom' => 'mt-70 mb-70 mt-xs-50 mb-xs-50',
				'Small Bottom'       => 'mb-70 mb-xs-50',
				'Big Top + Bottom'   => 'mt-140 mb-140 mt-xs-70 mb-xs-70',
				'Big Bottom Only'    => 'mb-140 mb-xs-70',
				'Custom Margin'     => 'custom-margin'
			),
		),

		array(
			'type'                => 'textfield',
			'heading'             => 'Margin Top',
			'param_name'          => 'm_top',
			'dependency'          => array( 'element' => 'margin', 'value' => array('custom-margin') ),
		),
		array(
			'type'                => 'textfield',
			'heading'             => 'Margin Bottom',
			'param_name'          => 'm_bottom',
			'dependency'          => array( 'element' => 'margin', 'value' => array('custom-margin') ),
		),

		// Extras
		// ------------------------------------------------------------------------------------------
	 $vc_map_extra_id,
	 $vc_map_extra_class,

	),
	'js_view'                 => 'VcRowView'
) );

// ==========================================================================================
// VC ROW INNER
// ==========================================================================================
vc_map( array(
	'name'                    => 'Row',
	'base'                    => 'vc_row_inner',
	'icon'                    => 'fa fa-plus-square-o',
	'is_container'            => true,
	'content_element'         => false,
	'show_settings_on_create' => false,
	'weight'                  => 1000,
	'params'                  => array(

		// Background
		// ------------------------------------------------------------------------------------------
		array(
			'type'                => 'colorpicker',
			'heading'             => 'Background Color',
			'param_name'          => 'bgcolor',
		),
		array(
			'type'                => 'attach_image',
			'heading'             => 'Background Image',
			'param_name'          => 'background',
		),
		array(
			'type'                => 'dropdown',
			'value'               => array(
				'Yes'               => 'yes',
				'No'                => 'no',
			),
			'heading'             => 'Background Stretch',
			'description'         => 'Settings with Yes option will stretch the background image full as with container',
			'param_name'          => 'cover',
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'repeat',
			'heading'             => 'Background Repeat',
			'edit_field_class'    => 'vc_col-md-4 vc_column',
			'value'               => array(
				'No Repeat'             => 'no-repeat',
				'Repeat Horizontally'   => 'repeat-x',
				'Repeat Vertically'     => 'repeat-y',
				'Repeat Both'           => 'repeat',
			),
			'dependency'          => array( 'element' => 'cover', 'value' => array('no') ),
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'attachment',
			'heading'             => 'Background Attachment',
			'value'               => array(
				'Scroll'            => 'scroll',
				'Fixed'             => 'fixed',
			),
		),
		array(
			'type'                => 'dropdown',
			'value'               => array(
				'No'                => 'no',
				'Yes'               => 'yes',
			),
			'heading'             => '100% Full-width, without container',
			'param_name'          => 'fluid',
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'padding',
			'heading'             => 'Padding',
			'value'               => array(
				'No Padding'         => 'rella-no-padding',
				'Small Top + Bottom' => 'pt-70 pb-70 pt-xs-50 pb-xs-50',
				'Small Bottom'       => 'pb-70 pb-xs-50',
				'Big Top + Bottom'   => 'pt-140 pb-140 pt-xs-70 pb-xs-70',
				'Big Bottom Only'    => 'pb-140 pb-xs-70',
				'Custom Padding'     => 'custom-padding'
			),
		),
		array(
			'type'                => 'textfield',
			'heading'             => 'Padding Top',
			'param_name'          => 'top',
			'dependency'          => array( 'element' => 'padding', 'value' => array('custom-padding') ),
		),
		array(
			'type'                => 'textfield',
			'heading'             => 'Padding Bottom',
			'param_name'          => 'bottom',
			'dependency'          => array( 'element' => 'padding', 'value' => array('custom-padding') ),
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'margin',
			'heading'             => 'Margin',
			'value'               => array(
				'No Margin'          => 'rella-no-margin',
				'Small Top + Bottom' => 'mt-70 mb-70 mt-xs-50 mb-xs-50',
				'Small Bottom'       => 'mb-70 mb-xs-50',
				'Big Top + Bottom'   => 'mt-140 mb-140 mt-xs-70 mb-xs-70',
				'Big Bottom Only'    => 'mb-140 mb-xs-70',
				'Custom Margin'     => 'custom-margin'
			),
		),
		array(
			'type'                => 'textfield',
			'heading'             => 'Margin Top',
			'param_name'          => 'm_top',
			'dependency'          => array( 'element' => 'margin', 'value' => array('custom-margin') ),
		),
		array(
			'type'                => 'textfield',
			'heading'             => 'Margin Bottom',
			'param_name'          => 'm_bottom',
			'dependency'          => array( 'element' => 'margin', 'value' => array('custom-margin') ),
		),

		// Extras
		// ------------------------------------------------------------------------------------------
	 $vc_map_extra_id,
	 $vc_map_extra_class,

	),
	'js_view'                 => 'VcRowView'
) );

// ==========================================================================================
// VC COLUMN
// ==========================================================================================
vc_map( array(
	'name'            => 'Column',
	'base'            => 'vc_column',
	'is_container'    => true,
	'content_element' => false,
	'params'          => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Align',
			'param_name'  => 'align',
			'value'       => array(
				'Select Alignment'  => '',
				'Left'              => 'left',
				'Center'            => 'center',
				'Right'             => 'right',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Column Class Type',
			'param_name'  => 'class_type',
			'value'       => array(
				'col-md-x' => 'md',
				'col-sm-x' => 'sm',
			),
			'description' => 'This is optional, leave default for default settings.'
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Width',
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'group' => 'Width & Responsiveness',
			'description' => 'Select column width.',
			'std' => '1/1'
		),
		array(
			'type' => 'column_offset',
			'heading' => 'Responsiveness',
			'param_name' => 'offset',
			'group' => 'Width & Responsiveness',
			'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
		),
		$vc_map_match_height,
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,
	),
	'js_view'         => 'VcColumnView'
) );


// ==========================================================================================
// VC COLUMN INNER
// ==========================================================================================
vc_map( array(
	'name'                      => 'Column',
	'base'                      => 'vc_column_inner',
	'class'                     => '',
	'icon'                      => '',
	'wrapper_class'             => '',
	'controls'                  => 'full',
	'allowed_container_element' => false,
	'content_element'           => false,
	'is_container'              => true,
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Column Class Type',
			'param_name'  => 'class_type',
			'value'       => array(
				'col-md-x' => 'md',
				'col-sm-x' => 'sm',
			),
			'description' => 'This is optional, leave default for default settings.'
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Width',
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'group' => 'Width & Responsiveness',
			'description' => 'Select column width.',
			'std' => '1/1'
		),
		array(
			'type' => 'column_offset',
			'heading' => 'Responsiveness',
			'param_name' => 'offset',
			'group' => 'Width & Responsiveness',
			'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
		),
		$vc_map_match_height,
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,
	),
	'js_view'                   => 'VcColumnView'
) );


// ==========================================================================================
// VC ACCORDION
// ==========================================================================================
vc_map( array(
	'name'            => 'Accordion',
	'base'            => 'vc_accordion',
	'is_container'    => true,
	'icon'            => 'fa fa-plus-circle',
	'description'     => 'Accordion',
	'params'          => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Active tab',
			'param_name'  => 'active_tab',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'value'       => array(
				'Standard'  => 'standard',
				'With Icon' => 'with_icon'
			),
		),
	array(
			'type'        => 'dropdown',
			'heading'     => 'Variant',
			'param_name'  => 'variant',
			'value'       => array(
				'Accordion'  => 'accordion',
				'Toggle'	 => 'toggle'
			),
		),
		$vc_map_extra_id,
		$vc_map_extra_class,
	),

	'custom_markup'   => '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>',
	'default_content' => '
		[vc_accordion_tab title="Section 1"][/vc_accordion_tab]
		[vc_accordion_tab title="Section 2"][/vc_accordion_tab]
	',
	'js_view'         => 'VcAccordionView'
) );

// ==========================================================================================
// VC ACCORDION TAB
// ==========================================================================================
vc_map( array(
	'name'                      => 'Accordion Section',
	'base'                      => 'vc_accordion_tab',
	'allowed_container_element' => 'vc_row',
	'is_container'              => true,
	'content_element'           => false,
	'params'                    => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Icon',
			'param_name'  => 'icon',
			'placeholder' => 'Select Icon',
			'icon_type'   => 'fontawesome',
			'description' => 'Please select icon if you select accordion type to with icon.',
		'value'		=> '',
		),
	),
	'js_view'         => 'VcAccordionTabView'
) );

// ==========================================================================================
// BANNER
// ==========================================================================================
vc_map( array(
	'name'          => 'Banner',
	'base'          => 'rs_banner',
	'icon'          => 'fa fa-th-large',
	'description'   => 'Create a banner.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'admin_label' => true,
			'param_name'  => 'style',
			'value'       => array(
				'Full Height'                     => 'full_height',
				'Full Height Video'               => 'full_height_video',
				'Full Height Video With Scroll'   => 'full_height_video_with_scroll',
				'Alternative Full Height Video With Scroll'   => 'alt_full_height_video_with_scroll',
				'Bigger With Buttons'             => 'bigger_with_buttons',
				'Bigger With Video'               => 'bigger_with_video',
				'Banner With Text Rotator'        => 'banner_with_text_rotator',
				'Banner With Dark Buttons'        => 'banner_with_dark_buttons',
				'Banner With Play Button'         => 'banner_with_play_button',
				'Banner With Image Rotator'       => 'banner_with_image_rotator',
				'Bigger With Video No Buttons'    => 'bigger_with_video_no_buttons',
				'Bigger With Buttons White'       => 'bigger_with_buttons_white',
				'Full Height With Solid Buttons'  => 'full_height_with_solid_buttons',
				'Full Height With Solid Button'   => 'full_height_with_solid_button',
				'Full Height With No Buttons'     => 'full_height_with_no_buttons',
				'Full Height With Bottom Content' => 'full_height_with_bottom_content',
				'Banner Without Background Image' => 'banner_without_background_image',
				'Banner With Form'                => 'banner_with_form',
				'Banner Slider With Thumbnail'    => 'banner_slider_with_thumbnail',
				'Banner with Image and Text'	  => 'banner_with_image_and_text'	
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Mode',
			'param_name'  => 'mode',
			'description' => 'Select a mode to display the banner',
			'value' => array(
				'Default' => 'default',
				'Presto'  => 'presto'
			),
			'dependency' => array( 'element' => 'style', 'value' => array( 'banner_with_play_button', 'full_height_video_with_scroll' ) )
		),
		array(
			'type'        => 'attach_images',
			'heading'     => 'Background',
			'param_name'  => 'background',
			'description' => 'Upload multiple image for slider Note: only for <strong>Banner With Image Rotator & Banner Slider With Thumbnail</strong>',
			'dependency'  => array( 'element' => 'style', 'value' => array(
				'full_height_video_with_scroll',
				'alt_full_height_video_with_scroll',
				'banner_with_image_rotator',
				'full_height_with_no_buttons',
				'full_height_with_solid_buttons',
				'full_height_with_solid_button',
				'full_height',
				'banner_with_dark_buttons',
				'full_height_video',
				'bigger_with_buttons',
				'bigger_with_buttons_white',
				'bigger_with_video',
				'banner_with_text_rotator',
				'banner_with_play_button',
				'bigger_with_video_no_buttons',
				'banner_slider_with_thumbnail',
				'banner_with_image_and_text',
				'full_height_with_bottom_content'
				
			) ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Overlay Style',
			'param_name'  => 'overlay_style',
			'value'       => array(
				'Select Overlay'       => '',
				'Dark With Opacity 30' => 'bg-dark-alfa-30',
				'Dark With Opacity 50' => 'bg-dark-alfa-50',
				'Dark With Opacity 70' => 'bg-dark-alfa-70',
				'Dark With Opacity 90' => 'bg-dark-alfa-90',
				'Custom Overlay' => 'custom-overlay',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'banner_with_image_rotator', 'full_height_with_no_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button', 'full_height', 'full_height_video', 'bigger_with_buttons', 'bigger_with_video', 'banner_with_text_rotator', 'banner_with_play_button', 'bigger_with_video_no_buttons', 'full_height_with_bottom_content') ),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Overlay Color',
			'param_name'  => 'custom_overlay_color',
			'dependency'  => array( 'element' => 'overlay_style', 'value' => array('custom-overlay') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Overlay Opacity',
			'param_name'  => 'overlay_opacity',
			'description' => 'Enter overlay opacity in range between 0 - 1',
			'dependency'  => array( 'element' => 'overlay_style', 'value' => array('custom-overlay') ),
		),
	array(
			'type'        => 'dropdown',
			'heading'     => 'Video source',
			'param_name'  => 'video_source',
			'value'       => array(
				'External Video' => 'external_video',
		'Self-hosted Video' => 'self_hosted_video',
			),
			'description' => 'Use external video source like YouTube or upload video to your server.',
		'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll',  'alt_full_height_video_with_scroll', 'full_height_video', 'bigger_with_video', 'bigger_with_video_no_buttons', 'banner_with_play_button') ),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Video URL',
			'param_name'  => 'video_url',
			'value'       => '',
			'dependency'  => array( 'element' => 'video_source', 'value' => array('external_video') ),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Video URL',
			'param_name'  => 'vim_video_url',
			'value'       => '',
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_without_background_image') ),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Video URL MP4',
			'param_name'  => 'video_url_mp4',
			'value'       => '',
			'dependency'  => array( 'element' => 'video_source', 'value' => array('self_hosted_video') ),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Video URL OGV',
			'param_name'  => 'video_url_ogv',
			'value'       => '',
			'dependency'  => array( 'element' => 'video_source', 'value' => array('self_hosted_video') ),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Video URL WEBM',
			'param_name'  => 'video_url_webm',
			'value'       => '',
			'dependency'  => array( 'element' => 'video_source', 'value' => array('self_hosted_video') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Autoplay',
			'param_name'  => 'autoplay',
			'value'       => array(
				'No'  => 'false',
				'Yes' => 'true',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll',  'alt_full_height_video_with_scroll', 'full_height_video', 'bigger_with_video', 'bigger_with_video_no_buttons') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Sound',
			'param_name'  => 'sound',
			'value'       => array(
				'No'  => 'true',
				'Yes' => 'false',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'full_height_video', 'bigger_with_video', 'bigger_with_video_no_buttons') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Autoplay Speed',
			'param_name'  => 'autoplay_speed',
			'description' => 'Enter the auto play speed.',
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_with_image_rotator') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Slide Speed',
			'param_name'  => 'slide_speed',
			'description' => 'Enter the slide speed.',
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_with_image_rotator') ),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image Heading',
			'param_name'  => 'img_heading',
			'description' => 'Add image as heading for banner',	
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_with_image_rotator') ),
		),
		array(
			'type'        => 'textfield',	
			'heading'     => 'Image Caption',
			'param_name'  => 'img_caption',
			'description' => 'Add caption for image heading',
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_with_image_rotator') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Small Heading',
			'param_name'  => 'small_heading',
			'holder'      => 'div',
			'dependency'  => array(
				'element' => 'style',
				'value' => array(
					'full_height',
					'full_height_video',
					'full_height_video_with_scroll',
					'alt_full_height_video_with_scroll',
					'bigger_with_buttons',
					'bigger_with_video',
					'banner_with_text_rotator',
					'banner_with_dark_buttons',
					'banner_with_play_button',
					'banner_with_image_rotator',
					'bigger_with_video_no_buttons',
					'bigger_with_buttons_white',
					'full_height_with_solid_buttons',
					'full_height_with_solid_button',
					'full_height_with_no_buttons',
					'banner_without_background_image',
					'banner_with_form',
					'banner_with_image_and_text',
					'full_height_with_bottom_content'
				)
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Big Heading',
			'param_name'  => 'big_heading',
			'description' => 'Use Comma (,) for <strong>Banner With Text Rotator & Full Height Video With Scroll</strong> only.',
			'holder'      => 'div',
			'dependency'  => array(
				'element' => 'style',
				'value' => array(
					'full_height',
					'full_height_video',
					'full_height_video_with_scroll',
					'alt_full_height_video_with_scroll',
					'bigger_with_buttons',
					'bigger_with_video',
					'banner_with_text_rotator',
					'banner_with_dark_buttons',
					'banner_with_play_button',
					'banner_with_image_rotator',
					'bigger_with_video_no_buttons',
					'bigger_with_buttons_white',
					'full_height_with_solid_buttons',
					'full_height_with_solid_button',
					'full_height_with_no_buttons',
					'banner_without_background_image',
					'banner_with_form',
					'full_height_with_bottom_content'
				)
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Rotator words',
			'param_name'  => 'text_rotate',
			'description' => 'Use Comma (,) for text rotator',
			'holder'      => 'div',
			'dependency'  => array(
				'element' => 'style',
				'value' => array(
					'full_height_with_bottom_content'
				)
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Big Heading Margin',
			'param_name'  => 'big_heading_margin',
			'value'       => array(
				'Default'       => 'mb-80 mb-xs-30 mt-50 mt-sm-0',
				'Small'         => 'mb-50 mb-xs-30',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_with_no_buttons') ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Local Scroll Link',
			'param_name'  => 's_link',
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_play_button', 'banner_with_dark_buttons', 'full_height', 'full_height_with_no_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Local Scroll Link Style',
			'param_name'  => 's_link_style',
			'value'       => array(
				'Default' => 'default',
				'Presto'  => 'presto'
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_play_button', 'banner_with_dark_buttons', 'full_height', 'full_height_with_no_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Style',
			'param_name'  => 'btn_style',
			'value'       => array(
				'Circle' => 'btn-circle',
				'Round'  => 'btn-round',
				'Square' => 'btn-suqare',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll','banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','banner_with_image_and_text','full_height_with_bottom_content') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Size',
			'param_name'  => 'btn_size',
			'value'       => array(
				'Small' => 'btn-small',
				'Medium'  => 'btn-medium',
				'Large' => 'btn-large',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll','banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','banner_with_image_and_text','full_height_with_bottom_content') ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'link',
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','banner_with_image_and_text','full_height_with_bottom_content') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll','banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','banner_with_image_and_text','full_height_with_bottom_content') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Link Text',
			'param_name'  => 'link_text',
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_without_background_image') ),
			'description' => 'Enter text seperated with | you be placed in between icon'
		),
	array(
			'type'        => 'checkbox',
			'heading'     => 'Button Lighbox',
			'param_name'  => 'btn_lightbox',
			'value'       => array(
				'Open Lightbox' => '1',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height_with_solid_button', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','full_height_with_bottom_content') ),
		),

		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link 2',
			'param_name'  => 'link_2',
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll','banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','banner_with_image_and_text') ),
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text 2',
			'param_name'  => 'btn_text_2',
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll','banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white','banner_with_image_and_text') ),
		),

	array(
			'type'        => 'checkbox',
			'heading'     => 'Button Lighbox 2',
			'param_name'  => 'btn_lightbox_2',
			'value'       => array(
				'Open Lightbox' => '1',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('full_height_video_with_scroll', 'alt_full_height_video_with_scroll', 'banner_with_image_rotator', 'banner_with_text_rotator', 'banner_with_dark_buttons', 'full_height_with_solid_buttons', 'full_height', 'full_height_video', 'bigger_with_video', 'bigger_with_buttons', 'bigger_with_buttons', 'bigger_with_buttons_white') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Contact Form ID',
			'param_name'  => 'form_id',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'style', 'value' => array('banner_with_form') ),
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Image caption Color',
			'param_name'  => 'img_caption_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Big Heading Color',
			'param_name'  => 'big_heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Small Heading Color',
			'param_name'  => 'small_heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Small Heading Size',
			'param_name'  => 'd_small_heading_font_size',
			'value'       => array(
				'Medium Size With Text White'            => 'hs-line-1',
				'Capitalized Small Size'                 => 'hs-line-3',
				'Small Size With Transparent'            => 'hs-line-6',
				'Medium Size With Text Bold'             => 'hs-line-7',
				'Extra Small Size With Transparent'      => 'hs-line-8',
				'Medium Size With Text With Transparent' => 'hs-line-11',
				'Large Text Size'                        => 'hs-line-12',
				'Medium Size With Text Normal'           => 'hs-line-14',
				'Extra Large Text Size'                  => 'hs-line-15',
				'Medium size With Text Normal 2' 		 => 'hs-line-18',
				'Large Text Size 2' 				     => 'hs-line-19',
				'Custom Font Size'                       => 'custom-font-small-size'
			),
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Custom Small Heading',
			'param_name'  => 'small_heading_font_size',
			'description' => 'Enter the font size in px e.g 14px',
			'group'       => 'Font Size Properties',
			'dependency'  => array( 'element' => 'd_small_heading_font_size', 'value' => array('custom-font-small-size') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Big Heading Size',
			'param_name'  => 'd_big_heading_font_size',
			'value'       => array(
				'Medium Size With Text White'            => 'hs-line-1',
				'Small Size With Transparent'            => 'hs-line-6',
				'Medium Size With Text Bold'             => 'hs-line-7',
				'Extra Small Size With Transparent'      => 'hs-line-8',
				'Medium Size With Text With Transparent' => 'hs-line-11',
				'Large Text Size'                        => 'hs-line-12',
				'Medium Size With Text Normal'           => 'hs-line-14',
				'Extra Large Text Size'                  => 'hs-line-15',
				'Medium size With Text Normal 2' 		 => 'hs-line-18',
				'Large Text Size 2' 				     => 'hs-line-19',
				'Custom Font Size'                       => 'custom-font-big-size'
			),
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Custom Big Heading',
			'param_name'  => 'big_heading_font_size',
			'description' => 'Enter the font size in px e.g 14px',
			'group'       => 'Font Size Properties',
			'dependency'  => array( 'element' => 'd_big_heading_font_size', 'value' => array('custom-font-big-size') ),
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Extra Class',
			'param_name'  => 'btn_class',
			'group'       => 'Extras'
		),
		
		array(
			'type'        => 'textfield',
			'heading'     => 'Button 2 Extra class',
			'param_name'  => 'btn_two_class',
			'group'       => 'Extras'
		),

	)
) );

// ==========================================================================================
// BANNER SLIDER
// ==========================================================================================
vc_map( array(
	'name'                    => 'Banner Slider',
	'base'                    => 'rs_banner_slider',
	'icon'                    => 'fa fa-sort-numeric-asc',
	'as_parent'               => array('only' => 'rs_banner_slide'),
	'show_settings_on_create' => false,
	'js_view'                 => 'VcColumnView',
	'content_element'         => true,
	'description'             => 'Add banner slider.',
	'params'  => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'value'       => array(
				'Home Slider' => 'home_slider',
				'Construction Slider' => 'construction_slider',
				'Presto Slider' => 'presto_slider'
			),
		),
		
		array(
			'type'       => 'dropdown',
			'param_name' => 'autoplay',	
			'heading'    => 'autoPlay',
			'description' => 'Select Yes if you want to enable autoplay',
			'value'      => array(
				'No'     => '',
				'Yes'    => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-4',
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'time',
			'heading'     => 'Pause Time',
			'description' => 'Input any integer for example 5000 to play every 5 seconds. If you set autoPlay:yes and this field blank,  default pause time will be 5 seconds.',
			'dependency'  => array(
				'element' => 'autoplay',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'textfield',
			'param_name'       => 'speed'	,
			'heading'          => 'Slide Speed',
			'description'      => 'Input any integer for slide speed in milliseconds',
			'edit_field_class' => 'vc_col-sm-4',
		),
		
	),

) );

vc_map( array(
	'name'                    => 'Slide Item',
	'base'                    => 'rs_banner_slide',
	'icon'                    => 'fa fa-sort-numeric-asc',
	'description'             => 'Add banner slide.',
	'as_child'                => array('only' => 'rs_banner_slider'),
	'params'  => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Background',
			'param_name'  => 'background',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Small Heading',
			'param_name'  => 'small_heading',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Big Heading',
			'param_name'  => 'big_heading',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Show Button',
			'param_name'  => 'no_buttons',
			'value'       => array(
				'One' => 'one',
				'Two' => 'two',
			),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button One Link',
			'param_name'  => 'btn_one_link',
			'dependency' => Array('element' => 'no_buttons','value' => array('one', 'two')),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button One Text',
			'param_name'  => 'btn_one_text',
			'dependency' => Array('element' => 'no_buttons','value' => array('one', 'two')),
		),

	array(
			'type'        => 'checkbox',
			'heading'     => 'Button Lighbox',
			'param_name'  => 'btn_one_lightbox',
			'value'       => array(
				'Open Lightbox' => '1',
			),
			'dependency'  => array( 'element' => 'no_buttons', 'value' => array('one', 'two') ),
			'description' => 'This option is only for <strong>Home Slider</strong>'
		),

		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Two Link',
			'param_name'  => 'btn_two_link',
			'dependency' => Array('element' => 'no_buttons','value' => array('two')),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Two Text',
			'param_name'  => 'btn_two_text',
			'dependency' => Array('element' => 'no_buttons','value' => array('two')),
		),

	array(
			'type'        => 'checkbox',
			'heading'     => 'Button Lighbox',
			'param_name'  => 'btn_two_lightbox',
			'value'       => array(
				'Open Lightbox' => '1',
			),
			'dependency'  => array( 'element' => 'no_buttons', 'value' => array('two') ),
			'description' => 'This option is only for <strong>Home Slider</strong>'
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Local Scroll Link',
			'param_name'  => 's_link',
		),		

		//custom colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Big Heading Color',
			'param_name'  => 'big_heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Small Heading Color',
			'param_name'  => 'small_heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Small Heading',
			'param_name'  => 'small_heading_font_size',
			'description' => 'Enter the font size in px e.g 14px',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Big Heading',
			'param_name'  => 'big_heading_font_size',
			'description' => 'Enter the font size in px e.g 14px',
			'group'       => 'Font Size Properties'
		),
	)

) );


// ==========================================================================================
// BANNER HEADING
// ==========================================================================================
vc_map( array(
	'name'          => 'Banner Heading',
	'base'          => 'rs_banner_heading',
	'icon'          => 'fa fa-header',
	'description'   => 'Create banner heading.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Heading',
			'param_name'  => 'heading',
			'holder'      => 'div',
		),

		// properties
		array(
			'type'        => 'dropdown',
			'heading'     => 'Font Weight',
			'param_name'  => 'weight',
			'value'       => array(
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
			),
			'group'       => 'Heading Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Font Size',
			'param_name'  => 'size',
			'group'       => 'Heading Properties',
			'description' => 'Add size in pixel e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Letter Spacing',
			'param_name'  => 'spacing',
			'group'       => 'Heading Properties',
			'description' => 'Add size in em or pixel e.g 0.3em / 1px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Top',
			'param_name'  => 'top',
			'group'       => 'Heading Properties',
			'description' => 'Add size in pixel e.g 15px'
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Bottom',
			'param_name'  => 'bottom',
			'group'       => 'Heading Properties',
			'description' => 'Add size in pixel e.g 15px'
		),


		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Heading Color',
			'param_name'  => 'color',
			'group'       => 'Heading Properties'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// COUNT DOWN BANNER
// ==========================================================================================
vc_map( array(
	'name'          => 'Countdown Banner',
	'base'          => 'rs_countdown_banner',
	'icon'          => 'fa fa-header',
	'description'   => 'Create countdown banner.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'value'       => array(
				'Light'     => 'light',
				'Dark'      => 'dark'
			),
			'admin_label' => true,
		),

		// properties
		array(
			'type'        => 'attach_image',
			'heading'     => 'Background',
			'param_name'  => 'background',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Year',
			'param_name'  => 'year',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Month',
			'param_name'  => 'month',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Days',
			'param_name'  => 'days',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Hours',
			'param_name'  => 'hours',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Minute',
			'param_name'  => 'minutes',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Seconds',
			'param_name'  => 'seconds',
			'admin_label' => true,
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'btn_link',
			'dependency'  => array( 'element' => 'btn_text', 'not_empty' => true ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Local Link',
			'param_name'  => 'local_link',
		),
		array(
			'type'        => 'textarea',
			'heading'     => 'Finish Message',
			'param_name'  => 'finish_msg',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Days label',
			'param_name'  => 'd_label',
			'group'       => 'Labels'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Hours label',
			'param_name'  => 'h_label',
			'group'       => 'Labels'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Minutes label',
			'param_name'  => 'm_label',
			'group'       => 'Labels'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Seconds label',
			'param_name'  => 's_label',
			'group'       => 'Labels'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );



// ==========================================================================================
// PROGRESS BAR
// ==========================================================================================
vc_map( array(
	'name'          => 'Bar (Progress)',
	'base'          => 'rs_bar',
	'icon'          => 'fa fa-tasks',
	'description'   => 'Create a progress bar.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Percentage Inside',
			'param_name'  => 'percentage_inside',
			'admin_label' => true,
			'value'       => array(
				'Yes'     => 'tpl-progress-alt',
				'No'      => 'tpl-progress',
			),
			'description' => 'Select "Yes" if you want to wrap percentage and title inside.'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Percentage',
			'param_name'  => 'percentage',
			'value'       => 100,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Unit',
			'param_name'  => 'unit',
			'value'       => '%',
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Bar Color',
			'param_name'  => 'bar_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Bar Background Color',
			'param_name'  => 'bg_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Bar Text Color',
			'param_name'  => 'text_color',
			'group'       => 'Custom Colors',
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// IMAGE SLIDER WITH LIGHTBOX
// ==========================================================================================
vc_map( array(
	'name'          => 'Image Slider With Lightbox',
	'base'          => 'rs_image_carousel',
	'icon'          => 'fa fa-tasks',
	'description'   => 'Create a image slider with lightbox.',
	'params'        => array(
		array(
			'type'        => 'attach_images',
			'heading'     => 'Upload Images',
			'param_name'  => 'image_list',
			'description' => 'Upload multiple images.',
			'admin_label' => true
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Items',
			'param_name'  => 'items',
			'admin_label' => true,
			'value' => array(
				'Four items' => 'image-carousel',
				'Five items' => 'image-carousel-items-5'
			)
		),
		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// Tilt Image
// ==========================================================================================
vc_map( array(
	'name'          => 'Tilt Image Block',
	'base'          => 'rs_tilt_image',
	'icon'          => 'fa fa-tasks',
	'description'   => 'Create a tilt image block.',
	'params'        => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Upload Images',
			'param_name'  => 'image',
			'admin_label' => true
		),
		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// BLOCKQUOTE
// ==========================================================================================
vc_map( array(
	'name'          => 'BlockQuote',
	'base'          => 'rs_blockquote',
	'icon'          => 'fa fa-quote-left',
	'description'   => 'Create a block quote.',
	'params'        => array(
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div',
			'value'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Cite',
			'param_name'  => 'cite',
			'admin_label' => true,
			'value'       => ''
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Text Color',
			'param_name'  => 'text_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Cite Color',
			'param_name'  => 'cite_color',
			'group'       => 'Custom Colors',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Text Size',
			'param_name'  => 'text_size',
			'admin_label' => true,
			'description' => 'Add size in pixels e.g 15px',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Cite Size',
			'param_name'  => 'cite_size',
			'admin_label' => true,
			'description' => 'Add size in pixels e.g 15px',
			'group'       => 'Font Size Properties'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// BLOG SLIDER
// ==========================================================================================
vc_map( array(
	'name'            => 'Blog Carousel',
	'base'            => 'rs_blog_carousel',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Create a blog posts carousel.',
	'params'          => array(
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Select Categories',
			'param_name'  => 'cats',
			'placeholder' => 'Select category',
			'value'       => rs_element_values( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => false,
			) ),
			'std'         => '',
			'description' => 'You can choose specific categories for blog, default is all categories.',
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('ID', 'rs')            => 'ID',
				__('Author', 'rs')        => 'author',
				__('Post Title', 'rs')    => 'title',
				__('Date', 'rs')          => 'date',
				__('Last Modified', 'rs') => 'modified',
				__('Random Order', 'rs')  => 'rand',
				__('Comment Count', 'rs') => 'comment_count',
				__('Menu Order', 'rs')    => 'menu_order',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Post Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Include posts',
			'description' => 'Post IDs you want to include, separated by commas eg. 120,123,1005',
			'param_name'  => 'include_posts',
			'admin_label' => true,
			'value'       => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Exclude posts',
			'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
			'param_name'  => 'exclude_posts',
			'admin_label' => true,
			'value'       => ''
		),
	),

	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,

) );

// ==========================================================================================
// BLOG MAGAZINE
// ==========================================================================================
vc_map( array(
	'name'            => 'Blog Magazine',
	'base'            => 'rs_blog_magazine',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Create a blog posts magazine.',
	'params'          => array(
	array(
			'type'        => 'textfield',
			'heading'     => 'Header',
			'param_name'  => 'header',
		'admin_label' => true,
		),
	array(
			'type'        => 'vc_link',
			'heading'     => 'Header Link',
			'param_name'  => 'header_link',
		),
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Select Categories',
			'param_name'  => 'cats',
			'placeholder' => 'Select category',
			'value'       => rs_element_values( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => false,
			) ),
			'std'         => '',
			'description' => 'You can choose specific categories for blog, default is all categories.',
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('ID', 'rs')            => 'ID',
				__('Author', 'rs')        => 'author',
				__('Post Title', 'rs')    => 'title',
				__('Date', 'rs')          => 'date',
				__('Last Modified', 'rs') => 'modified',
				__('Random Order', 'rs')  => 'rand',
				__('Comment Count', 'rs') => 'comment_count',
				__('Menu Order', 'rs')    => 'menu_order',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Post Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Excerpt Length',
			'param_name'  => 'length',
		'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Exclue posts',
			'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
			'param_name'  => 'exclude_posts',
			'admin_label' => true,
			'value'       => ''
		),
	),

	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,

) );

// ==========================================================================================
// BLOG MAGAZINE
// ==========================================================================================
vc_map( array(
	'name'            => 'Blog Magazine Alternative',
	'base'            => 'rs_blog_magazine_alt',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Create a blog posts magazine.',
	'params'          => array(
	array(
			'type'        => 'textfield',
			'heading'     => 'Header',
			'param_name'  => 'header',
		'admin_label' => true,
		),
	array(
			'type'        => 'vc_link',
			'heading'     => 'Header Link',
			'param_name'  => 'header_link',
		),
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Select Categories',
			'param_name'  => 'cats',
			'placeholder' => 'Select category',
			'value'       => rs_element_values( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => false,
			) ),
			'std'         => '',
			'description' => 'You can choose specific categories for blog, default is all categories.',
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('ID', 'rs')            => 'ID',
				__('Author', 'rs')        => 'author',
				__('Post Title', 'rs')    => 'title',
				__('Date', 'rs')          => 'date',
				__('Last Modified', 'rs') => 'modified',
				__('Random Order', 'rs')  => 'rand',
				__('Comment Count', 'rs') => 'comment_count',
				__('Menu Order', 'rs')    => 'menu_order',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Post Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Excerpt Length',
			'param_name'  => 'length',
		'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Exclue posts',
			'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
			'param_name'  => 'exclude_posts',
			'admin_label' => true,
			'value'       => ''
		),
	),

	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,

) );

// ==========================================================================================
// BLOG SLIDER
// ==========================================================================================
vc_map( array(
	'name'            => 'Blog Slider',
	'base'            => 'rs_blog_slider',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Create a blog posts slider.',
	'params'          => array(
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Select Categories',
			'param_name'  => 'cats',
			'placeholder' => 'Select category',
			'value'       => rs_element_values( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => false,
			) ),
			'std'         => '',
			'description' => 'You can choose specific categories for blog, default is all categories.',
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('ID', 'rs')            => 'ID',
				__('Author', 'rs')        => 'author',
				__('Post Title', 'rs')    => 'title',
				__('Date', 'rs')          => 'date',
				__('Last Modified', 'rs') => 'modified',
				__('Random Order', 'rs')  => 'rand',
				__('Comment Count', 'rs') => 'comment_count',
				__('Menu Order', 'rs')    => 'menu_order',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Post Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Exclue posts',
			'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
			'param_name'  => 'exclude_posts',
			'admin_label' => true,
			'value'       => ''
		),
	),

	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,

) );

// ==========================================================================================
// ONE POST PREVIEW
// ==========================================================================================

vc_map( array(
	'name'      	=> 'One Post Preview',
	'base'			=> 'rs_one_post_preview',
	'icon'			=> 'fa fa-briefcase',
	'description'	=> 'Show a post preview',
	'params'		=> array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Upload Images',
			'param_name'  => 'image'
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> 'Title',
			'param_name'	=> 'title',
			'value'			=> '',
			'admin_label' => true
			
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Link',
			'param_name'  => 'link',
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div'
		),
	)
	
) );


// ==========================================================================================
// BUTTONS
// ==========================================================================================
vc_map( array(
	'name'          => 'Buttons',
	'base'          => 'rs_buttons',
	'icon'          => 'fa fa-square',
	'description'   => 'Create a classy button.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Icon',
			'param_name'  => 'btn_icon',
			'value'       => array(
				'No'        => 'no',
				'Yes'        => 'yes',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Icon Position',
			'param_name'  => 'icon_pos',
			'value'       => array(
				'Left'        => 'left',
				'Right'        => 'right',
				'Center'      => 'center',
			),
			'dependency' => Array('element' => 'btn_icon','value' => array('yes')),
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Select Icon',
			'value'       => 'fa fa-paper-plane-o',
			'dependency' => Array('element' => 'btn_icon','value' => array('yes')),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Shape',
			'param_name'  => 'btn_shape',
			'admin_label' => true,
			'value'       => array(
				'Rounded'      => 'btn-round',
				'Circle'      => 'btn-circle',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Style',
			'param_name'  => 'btn_style',
			'admin_label' => true,
			'value'       => array(
				'Solid'      => 'btn-solid',
				'Outlined'   => 'btn-border',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Size',
			'param_name'  => 'btn_size',
			'admin_label' => true,
			'value'       => array(
				'Extra Small' => '',
				'Small'       => 'btn-small',
				'Medium'      => 'btn-medium',
				'Large'       => 'btn-large',
			),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'btn_link',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Border Color',
			'param_name'  => 'border_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Text Color',
			'param_name'  => 'text_color',
			'group'       => 'Custom Colors',
		),
	array(
			'type'        => 'colorpicker',
			'heading'     => 'Icon Color',
			'param_name'  => 'icon_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Background Color',
			'param_name'  => 'background_color',
			'group'       => 'Custom Colors',
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Border Color',
			'param_name'  => 'border_color_hover',
			'group'       => 'Hover Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Text Color',
			'param_name'  => 'text_color_hover',
			'group'       => 'Hover Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Background Color',
			'param_name'  => 'background_color_hover',
			'group'       => 'Hover Colors',
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// BUTTONS GROUP
// ==========================================================================================
vc_map( array(
	'name'          => 'Group Buttons',
	'base'          => 'rs_group_button',
	'icon'          => 'fa fa-square',
	'description'   => 'Create a group button.',
	'params'        => array(
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon_one',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Select Icon',
			'value'       => 'fa fa-paper-plane-o',
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'btn_link_one',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text_one',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Small Text',
			'param_name'  => 'btn_small_text_one',
		),

		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon_two',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Select Icon',
			'value'       => 'fa fa-paper-plane-o',
			'group'      => 'Button Two'
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'btn_link_two',
			'group'       => 'Button Two'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text_two',
			'group'       => 'Button Two'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Small Text',
			'param_name'  => 'btn_small_text_two',
			'group'       => 'Button Two'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Animation',
			'param_name'  => 'animation_two',
			'admin_label' => true,
			'value'       => rs_get_animations(),
			'group'       => 'Animation Button Two'
		),

		array(
			'type'               => 'textfield',
			'heading'            => 'Animation Delay',
			'param_name'         => 'animation_delay_two',
			'edit_field_class'   => 'vc_col-md-6 vc_column',
			'value'              => '',
			'dependency'         => array( 'element' => 'animation', 'not_empty' => true ),
			'group'              => 'Animation Button Two'
		),

		array(
			'type'               => 'textfield',
			'heading'            => 'Animation Duration',
			'param_name'         => 'animation_duration_two',
			'edit_field_class'   => 'vc_col-md-6 vc_column',
			'value'              => '',
			'dependency'         => array( 'element' => 'animation', 'not_empty' => true ),
			'group'              => 'Animation Button Two'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,
	)
) );


// ==========================================================================================
// CALL TO ACTION
// ==========================================================================================
vc_map( array(
	'name'            => 'Call to Action',
	'base'            => 'rs_cta',
	'icon'            => 'fa fa-thumb-tack',
	'description'     => 'Add call to action.',
	'params'          => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Heading',
			'param_name'  => 'heading',
			'holder'      => 'div',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Header Margin Bottom',
			'param_name'  => 'header_margin_bottom',
			'std'         => 'single',
			'value'       => array(
				'Default'         => '',
				'0px'         => 'mb-0',
				'10px'        => 'mb-10',
				'20px'        => 'mb-20',
				'30px'        => 'mb-30',
				'40px'        => 'mb-40',
				'50px'        => 'mb-50',
				'60px'        => 'mb-60',
				'70px'        => 'mb-70',
				'80px'        => 'mb-80',
				'90px'        => 'mb-90',  
			),
		), 
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'link',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
		),

		// custom color

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Heading Color',
			'param_name'  => 'heading_color',
			'group'       => 'Custom Color Properties'
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Text Color',
			'param_name'  => 'button_text_color',
			'group'       => 'Custom Color Properties'
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Text Hover Color',
			'param_name'  => 'button_text_color_hover',
			'group'       => 'Custom Color Properties'
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Background Color',
			'param_name'  => 'button_bg_color',
			'group'       => 'Custom Color Properties'
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Background Hover Color',
			'param_name'  => 'button_bg_color_hover',
			'group'       => 'Custom Color Properties'
		),

	)

) );

// ==========================================================================================
// CALL TO ACTION 2
// ==========================================================================================
vc_map( array(
	'name'          => 'Call To Action 2',
	'base'          => 'rs_cta_2',
	'icon'          => 'fa fa-thumb-tack',
	'description'   => 'Add call to action with 2 buttons.',
	'params'        => array(
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link 1',
			'param_name'  => 'link',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text 1',
			'param_name'  => 'btn_text',
		'admin_label' => true,
		),

		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link 2',
			'param_name'  => 'link_2',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text 2',
			'param_name'  => 'btn_text_2',
		'admin_label' => true,
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// CLIENT BLOCK WITH IMAGE
// ==========================================================================================
vc_map( array(
	'name'          => 'Client Block',
	'base'          => 'rs_client_block',
	'icon'          => 'fa fa-child',
	'description'   => 'Create client block with image.',
	'params'        => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'holder'      => 'div'
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div'
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Content Color',
			'param_name'  => 'content_color',
			'group'       => 'Custom Colors',
		),



		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {

	global $wpdb;

	$db_cf7froms  = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
	$cf7_forms    = array();

	if ( $db_cf7froms ) {

		$cf7_forms['Choose'] = 0;

		foreach ( $db_cf7froms as $cform ) {
			$cf7_forms[$cform->post_title] = $cform->ID;
		}

	} else {
		$cf7_forms['No contact forms found'] = 0;
	}

// ==========================================================================================
// Contact Form
// ==========================================================================================

	vc_map( array(
	'name'            => 'Contact Form',
	'base'            => 'rs_contact_form',
	'icon'            => 'fa fa-envelope ',
	'description'     => 'Contact Form 7',
	'params'          => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Notice Text',
			'param_name'  => 'notification',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Contact Form',
			'param_name'  => 'form_id',
			'value'       => $cf7_forms,
			'admin_label' => true,
			'description' => 'Choose previously created contact form from the drop down list.',
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
	)

) );


}

// ==========================================================================================
// CONTACT DETAILS
// ==========================================================================================
vc_map( array(
	'name'          => 'Contact Details',
	'base'          => 'rs_contact_details',
	'icon'          => 'fa fa-tachometer ',
	'description'   => 'Add contact details.',
	'params'        => array(
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Select Icon',
		'value'		=> '',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'holder'      => 'div',
			'value'       => ''
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div',
			'value'       => ''
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Icon Color',
			'param_name'  => 'icon_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Icon Background Color',
			'param_name'  => 'icon_bg_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Content Color',
			'param_name'  => 'content_color',
			'group'       => 'Custom Colors',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Title Size',
			'param_name'  => 'title_size',
			'admin_label' => true,
			'description' => 'Add size in pixels e.g 15px',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Content Size',
			'param_name'  => 'content_size',
			'admin_label' => true,
			'description' => 'Add size in pixels e.g 15px',
			'group'       => 'Font Size Properties'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// COUNTER CONTENTS
// ==========================================================================================
vc_map( array(
	'name'                    => 'Counter',
	'base'                    => 'rs_counters',
	'icon'                    => 'fa fa-sort-numeric-asc',
	'as_parent'               => array('only' => 'rs_count'),
	'show_settings_on_create' => false,
	'js_view'                 => 'VcColumnView',
	'content_element'         => true,
	'description'             => 'Create a counter.',
	'params'  => array()

) );

vc_map( array(
	'name'                    => 'Counter Item',
	'base'                    => 'rs_count',
	'icon'                    => 'fa fa-sort-numeric-asc',
	'description'             => 'Add count item.',
	'as_child'                => array('only' => 'rs_counters'),
	'params'  => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Count No',
			'param_name'  => 'count_no',
			'value'       => ''
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Choose Icon',
		'value'		=> '',
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
		),

		//custom colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Count No Color',
			'param_name'  => 'count_no_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Icon Color',
			'param_name'  => 'icon_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Content Color',
			'param_name'  => 'content_color',
			'group'       => 'Colors Properties'
		),
	)

) );

vc_map( array(
	'name'                    => 'Presto Counter',
	'base'                    => 'rs_presto_counter',
	'icon'                    => 'fa fa-sort-numeric-asc',
	'description'             => 'Add presto counter.',
	'params'  => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Count No',
			'param_name'  => 'count_no',
			'value'       => '',
			'admin_label' => true
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
		),
	)

) );

// ==========================================================================================
// DIVIDER
// ==========================================================================================
vc_map( array(
	'name'            => 'Divider',
	'base'            => 'rs_divider',
	'icon'            => 'fa fa-sliders',
	'description'     => 'Add divider.',
	'params'          => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Top',
			'admin_label' => true,
			'param_name'  => 'margin_top',
			'description' => 'Add size in pixels e.g 15px ( optional )'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Bottom',
			'admin_label' => true,
			'param_name'  => 'margin_bottom',
			'description' => 'Add size in pixels e.g 15px ( optional )'
		),
	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,
	)
) );

// ==========================================================================================
// El ICONS
// ==========================================================================================
vc_map( array(
	'name'            => 'ET-Line Icons',
	'base'            => 'rs_el_icon',
	'icon'            => 'fa fa-angellist',
	'description'     => 'Add single icon or list of et-line icons.',
	'params'          => array(
	
		array(
			'type'        => 'dropdown',
			'heading'     => 'Show',
			'param_name'  => 'show',
			'admin_label' => true,
			'std'         => 'single',
			'value'       => array(
				'Single Icon'       => 'single',
				'Icons List'        => 'list',
			),
		), 
		
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Icon',
			'param_name'  => 'selected_icon',
			'admin_label' => true,
			'placeholder' => 'Select Icon',
			'icon_type'   => 'el_icons',
		'dependency'  => array( 'element' => 'show', 'value' => array('single') ),
		),
		
		array(
			'type'        => 'textfield',
			'heading'     => 'Size',
			'param_name'  => 'icon_size',
			'description' => 'Add size in pixels e.g 15px',
		'dependency'  => array( 'element' => 'show', 'value' => array('single') ),
		),
		
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Color',
			'param_name'  => 'icon_color',
		'dependency'  => array( 'element' => 'show', 'value' => array('single') ),
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => 'Align',
			'param_name'  => 'align',
			'std'         => '',
			'value'       => array(
				'Choose' => '',
				'Left'   => 'alignleft',
				'Center' => 'aligncenter',
				'Right'  => 'alignright',
			),
			'dependency'  => array( 'element' => 'show', 'value' => array('single') ),
		), 
		array(
			'type'        => 'textfield',
			'heading'     => 'Result Text',
			'param_name'  => 'result_text',
		'dependency'  => array( 'element' => 'show', 'value' => array('list') ),
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'value'       => 'You can use a set of <a href="http://www.elegantthemes.com/blog/resources/how-to-use-and-embed-an-icon-font-on-your-website" target="_blank">100+ ET-Line Icons</a>',
		'dependency'  => array( 'element' => 'show', 'value' => array('list') ),
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Default Icon',
			'param_name'  => 'icon',
			'admin_label' => false,
			'placeholder' => 'Select Icon',
			'icon_type'   => 'el_icons',
		'dependency'  => array( 'element' => 'show', 'value' => array('list') ),
		),

	),

	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,

) );



// ==========================================================================================
// FEATURE BOX
// ==========================================================================================
vc_map( array(
	'name'          => 'Feature Box',
	'base'          => 'rs_feature_box',
	'icon'          => 'fa fa-dot-circle-o',
	'description'   => 'Create a feature box.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Box Style',
			'param_name'  => 'box_style',
			'admin_label' => true,
			'value'       => array(
				'Style 1'      => 'style1',
				'Style 2'      => 'style2',
				'Style 3'      => 'style3',
				'Style 4'      => 'style4',
				'Style 5'      => 'style5',
				'Style 6'      => 'style6',
				'Style 7'      => 'style7',
				'Style 8 - Icon and title'      => 'style8'
			),
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'sel_icon',
			'icon_type'   => 'el_icons',
			'placeholder' => 'Select Icon',
			'dependency'  => array( 'element' => 'box_style', 'value' => array('style1', 'style8') ),
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Select Icon',
		'value'		=> '',
			'dependency'  => array( 'element' => 'box_style', 'value' => array('style2', 'style3') ),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => 'Upload Image',
			'param_name'  => 'style4_image',
			'dependency'  => array( 'element' => 'box_style', 'value' => array('style4', 'style5', 'style7') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Count Number',
			'param_name'  => 'count_no',
			'dependency'  => array( 'element' => 'box_style', 'value' => array('style6') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'button_text',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'box_style', 'value' => array('style4', 'style8') ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Link',
			'param_name'  => 'button_link',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Content Align',
			'param_name'  => 'content_align',
			'admin_label' => true,
			'value'       => array(
				'Left'   => 'left',
				'Center' => 'center',
				'Right'  => 'right',
				'Justify'=> 'justify'
			),
			'dependency'  => array( 'element' => 'box_style', 'value' => array('style1') ),
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Icon Size',
			'param_name'  => 'icon_size',
			'admin_label' => true,
			'group'       => 'Size Properties',
			'description' => 'Add size in pixels e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title Size',
			'param_name'  => 'title_size',
			'admin_label' => true,
			'group'       => 'Size Properties',
			'description' => 'Add size in pixels e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Content Size',
			'param_name'  => 'content_size',
			'admin_label' => true,
			'group'       => 'Size Properties',
			'description' => 'Add size in pixels e.g 15px'
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Top',
			'param_name'  => 'title_top',
			'admin_label' => true,
			'group'       => 'Title Margin Properties',
			'description' => 'Add size in pixels e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Bottom',
			'param_name'  => 'title_bottom',
			'admin_label' => true,
			'group'       => 'Title Margin Properties',
			'description' => 'Add size in pixels e.g 15px'
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Icon Color',
			'param_name'  => 'icon_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Text Color',
			'param_name'  => 'text_color',
			'group'       => 'Custom Colors',
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// FontAwesome ICONS
// ==========================================================================================
vc_map( array(
	'name'            => 'FontAwesome Icons',
	'base'            => 'rs_fontawesome',
	'icon'            => 'fa fa-flag',
	'description'     => 'Add list of fontawesome icons.',
	'params'          => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Result Text',
			'param_name'  => 'result_text',
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div',
			'value'       => 'You can use a set of <a href="http://fontawesome.io/icons/" target="_blank">400+ icons from Font Awesome</a>'
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Default Icon',
			'param_name'  => 'icon',
			'admin_label' => true,
			'placeholder' => 'Select Icon',
			'icon_type'   => 'fontawesome',
		'value'		=> '',
		),
		// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,
	),
) );


// ==========================================================================================
// GALLERY
// ==========================================================================================
vc_map( array(
	'name'            => 'Gallery',
	'base'            => 'rs_gallery',
	'icon'            => 'fa fa-film',
	'description'     => 'Add gallery.',
	'params'          => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Column',
			'param_name'  => 'column',
			'value'       => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'6' => '6',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'attach_images',
			'heading'     => 'Image',
			'param_name'  => 'images',
			'description' => 'Multiple images are supported.'
		),

	)

) );

// ==========================================================================================
// GALLERY 2
// ==========================================================================================
vc_map( array(
	'name'                    => 'Gallery 2',
	'base'                    => 'rs_gallery_2',
	'icon'                    => 'fa fa-th',
	'as_parent'               => array('only' => 'rs_gallery_2_item'),
	'show_settings_on_create' => false,
	'js_view'                 => 'VcColumnView',
	'content_element'         => true,
	'description'             => 'Create a gallery.',
	'params'  => array(
	 array(
		 'type'        => 'dropdown',
		 'heading'     => 'Column',
		 'param_name'  => 'column',
		 'value'       => array(
				'2 Column'  => '2',
				'3 Column'  => '3'
			),
	 ),
	 array(
		 'type'        => 'dropdown',
		 'heading'     => 'Hover Type',
		 'param_name'  => 'hover_overlay',
		 'value'       => array(
				'Dark'  => '',
				'White' => 'hover-white',
			),
	 ),
	 
	 $vc_map_extra_class,
	),

) );

vc_map( array(
	'name'                    => 'Gallery 2 Item',
	'base'                    => 'rs_gallery_2_item',
	'icon'                    => 'fa fa-picture-o',
	'description'             => 'Add promo slide.',
	'as_child'                => array('only' => 'rs_gallery_2'),
	'params'  => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Heading',
			'param_name'  => 'heading',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Small Heading',
			'param_name'  => 'small_heading',
		),

		array(
			'type'        => 'vc_link',
			'heading'     => 'Link',
			'param_name'  => 'link',
		),
	)

) );

// ==========================================================================================
// GOOGLE MAP
// ==========================================================================================
vc_map( array(
	'name'          => 'Google Map',
	'base'          => 'rs_google_map',
	'icon'          => 'fa fa-map-marker',
	'description'   => 'Add google map.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Address',
			'param_name'  => 'address',
			'holder'      => 'div',
			'value'       => '',
			'description' => 'Leave blank if you want to use coordinates'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Latitude',
			'param_name'  => 'lat',
			'holder'      => 'div',
			'value'       => '',
			'edit_field_class' => 'vc_col-sm-6'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Longitude',
			'param_name'  => 'long',
			'holder'      => 'div',
			'value'       => '',
			'edit_field_class' => 'vc_col-sm-6'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Show Text ?',
			'param_name'  => 'show_text',
			'value'       => array(
				'Yes'       => 'yes',
				'No'       => 'no',
			),
			'description' => 'Select "Yes" to show map open/close text.'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'GreyScale ?',
			'param_name'  => 'greyscale',
			'value'       => array(
				'Yes'       => 'yes',
				'No'       => 'no',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Open Text',
			'param_name'  => 'open_text',
			'value'       => '',
			'dependency'  => array( 'element' => 'show_text', 'value' => array('yes') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Close Text',
			'param_name'  => 'close_text',
			'value'       => '',
			'dependency'  => array( 'element' => 'show_text', 'value' => array('yes') ),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => 'marker',
			'param_name'  => 'marker',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'zoom',
			'heading'     => 'Zoom',
			'value'       => 14,
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Open Text Color',
			'param_name'  => 'open_text_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Close Text Color',
			'param_name'  => 'close_text_color',
			'group'       => 'Custom Colors',
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );


// ==========================================================================================
// IMAGE BLOCK
// ==========================================================================================
vc_map( array(
	'name'          => 'Image Block',
	'base'          => 'rs_image_block',
	'icon'          => 'fa fa-image',
	'description'   => 'Add image.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Alignment',
			'admin_label' => true,
			'param_name'  => 'align',
			'value'       => array(
				'Left'   => 'align-left',
				'Center' => 'align-center',
				'Right'  => 'align-right'
			),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Lightbox',
			'param_name'  => 'lightbox',
			'value'       => array(
				'No'        => 'no',
				'Yes'       => 'yes'
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Use as background of responsive block',
			'param_name'  => 'background_block',
			'value'       => array(
				'No'        => 'no',
				'Yes'       => 'yes'
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Link To Image ?',
			'param_name'  => 'image_link',
			'value'       => array(
				'No'        => 'no',
				'Yes'       => 'yes'
			),
			'dependency'  => array( 'element' => 'lightbox', 'value' => array('no') ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Link URL',
			'param_name'  => 'link',
			'dependency'  => array( 'element' => 'image_link', 'value' => array('yes') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Top',
			'param_name'  => 'margin_top',
			'admin_label' => true,
			'group'       => 'Margin Properties',
			'description' => 'Add size in pixels e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Bottom',
			'param_name'  => 'margin_bottom',
			'admin_label' => true,
			'group'       => 'Margin Properties',
			'description' => 'Add size in pixels e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Width',
			'param_name'  => 'width',
			'group'       => 'Width & Height Properties',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Height',
			'param_name'  => 'height',
			'group'       => 'Width & Height Properties',
		),
		
		array(
			'type'        => 'textfield',
			'heading'     => 'Min Height of the Responsive Block',
			'param_name'  => 'min_height_div',
			'group'       => 'Width & Height Properties',
			'dependency'  => array( 'element' => 'background_block', 'value' => array('yes') ),
		),
		
		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,
	)
) );


// ==========================================================================================
// LATEST NEWS
// ==========================================================================================
vc_map( array(
	'name'            => 'Latest News',
	'base'            => 'rs_latest_news',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Create a latest news post.',
	'params'          => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'admin_label' => true,
			'value' => array(
				'Default' => 'style1',
				'Presto'  => 'style2'
			)
		),
		array(
				'type' => 'dropdown',
				'admin_label' => true,
				'heading' => 'Columns',
				'param_name' => 'columns',
				'value' => array(
					'3' => '3',
					'4' => '4',
				),
			),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Add bottom margin to each item',
			'param_name' => 'bottom_margin',
			'value' => array(
				__('No', 'rhythm') => 'no',
				__('Yes', 'rhythm') => 'yes',
			),
		),
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Select Categories',
			'param_name'  => 'cats',
			'placeholder' => 'Select category',
			'value'       => rs_element_values( 'categories', array(
				'sort_order'  => 'ASC',
				'taxonomy'    => 'category',
				'hide_empty'  => false,
			) ),
			'std'         => '',
			'description' => 'You can choose specific categories for blog, default is all categories.',
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('ID', 'rs')            => 'ID',
				__('Author', 'rs')        => 'author',
				__('Post Title', 'rs')    => 'title',
				__('Date', 'rs')          => 'date',
				__('Last Modified', 'rs') => 'modified',
				__('Random Order', 'rs')  => 'rand',
				__('Comment Count', 'rs') => 'comment_count',
				__('Menu Order', 'rs')    => 'menu_order',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Post Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Excerpt Length',
			'param_name'  => 'length',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
			'admin_label' => true,
			'value'       => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Exclue posts',
			'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
			'param_name'  => 'exclude_posts',
			'admin_label' => true,
			'value'       => ''
		),
	),

	// Extras
	$vc_map_extra_id,
	$vc_map_extra_class,

) );

// ==========================================================================================
// SINGLE WORK
// ==========================================================================================
vc_map( array(
	'name'        => 'Single Work',
	'base'        => 'rs_single_work',
	'icon'        => 'fa fa-briefcase',
	'description' => 'Add a single work preview and title',
	'params'      => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Heading',
			'param_name'  => 'heading',
			'holder'      => 'div'
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Work Link',
			'param_name'  => 'link',
		),
	)
) );

// ==========================================================================================
// LATEST WORKS
// ==========================================================================================
vc_map( array(
	'name'            => 'Latest Works',
	'base'            => 'rs_latest_works',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Create a portfolio latest work.',
	'params'          => array(
		array(
			'type'       => 'dropdown',
			'heading'    => 'Style',
			'param_name' => 'style',
			'value'      => array(
				'Style 1' => 'style1',
				'Style 2' => 'style2',
				'Style 3' => 'style3',
				'Presto'  => 'presto'
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Columns',
			'param_name' => 'columns',
			'value'      => array(
				'2 Column' => 'work-grid-2',
				'3 Columns' => 'work-grid-3',
				'4 Columns' => 'work-grid-4',
				'5 Columns' => 'work-grid-5',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'presto') ),
		),
	 array(
			'type'       => 'dropdown',
			'heading'    => 'Resize images',
			'param_name' => 'resize_images',
			'value'      => array(
				'Yes'      => 'yes',
				'No'       => 'no',
			),
		),
	 array(
			'type'       => 'dropdown',
			'heading'    => 'Hover Type',
			'param_name' => 'hover_type',
			'value'      => array(
				'White' => 'hover-white',
				'Dark'  => 'hover-dark',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'presto') ),
		),
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Categories',
			'description' => 'Show portfolio items only from these categories',
			'param_name'  => 'cats',
			'placeholder' => 'Categories',
			'value'       => rs_get_custom_term_values('portfolio-category'),
			'admin_label' => true,
			'std'         => '', //required for vc_efa_chosen type
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Show Filter ?',
			'param_name' => 'show_filter',
			'value'      => array(
				'Yes'      => 'yes',
				'No'       => 'no',
			),
		),
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => 'Filter categories',
			'param_name'  => 'filter_cats',
			'placeholder' => 'Categories',
			'value'       => rs_get_custom_term_values('portfolio-category'),
			'admin_label' => true,
			'std'         => '', //required for vc_efa_chosen type
			'dependency'  => array( 'element' => 'show_filter', 'value' => array('yes') ),
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('ID', 'rs') => 'ID',
				__('Author', 'rs') => 'author',
				__('Post Title', 'rs') => 'title',
				__('Date', 'rs') => 'date',
				__('Last Modified', 'rs') => 'modified',
				__('Random Order', 'rs') => 'rand',
				__('Comment Count', 'rs') => 'comment_count',
				__('Menu Order', 'rs') => 'menu_order',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Post Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Lightbox',
			'param_name' => 'lightbox',
			'value'      => array(
				'No' => 'no',
				'Yes'  => 'yes',
			),
			'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'presto') ),
		),
	array(
			'type'                => 'dropdown',
		'admin_label' => true,
			'value'               => array(
				'No'                => 'no',
				'Yes'               => 'yes',
			),
			'heading'             => 'Use external URL if exists',
			'param_name'          => 'use_external_url',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Lightbox Text',
			'param_name'  => 'lightbox_text',
			'value'       => '',
			'dependency'  => array( 'element' => 'lightbox', 'value' => array('yes') ),
		),
	 array(
			'type'        => 'textfield',
			'heading'     => 'Exclude posts',
			'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
			'param_name'  => 'exclude_posts',
			'admin_label' => true,
			'value'       => ''
		),
		// Extras
		$vc_map_extra_class,
	)

) );

// ==========================================================================================
// Link Text
// ==========================================================================================
vc_map( array(
	'name'          => 'Text Link',
	'base'          => 'rs_link',
	'icon'          => 'fa fa-link',
	'description'   => 'Create link with text.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Align',
			'param_name'  => 'align',
			'value'       => array(
				'Left'      => 'left',
				'Center'    => 'center',
				'Right'     => 'right'
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Link Text',
			'param_name'  => 'link_text',
			'holder'      => 'div'
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Link URL',
			'param_name'  => 'link',
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Link Color',
			'param_name'  => 'link_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Link Color Hover',
			'param_name'  => 'link_color_hover',
			'group'       => 'Custom Colors',
		),


		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// LOGO SLIDER
// ==========================================================================================

vc_map( array(
	'name'        => 'Logo Slider',
	'base'        => 'rs_logo_slider',
	'icon'        => 'fa fa-ellipsis-h',
	'description' => 'Add logo slider.',
	'params'  => array(
		array(
			'type'        => 'attach_images',
			'heading'     => 'Image',
			'param_name'  => 'images',
			'description' => 'Multiple images are supported.'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Image Height',
			'param_name'  => 'height',
			'description' => 'Set default height for images'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Image width',
			'param_name'  => 'width',
			'description' => 'Set default width for images'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Items',
			'param_name'  => 'items',
			'value'       => array(
				'Four' => 'small-item-carousel',
				'Five' => 'small-item-carousel-items-4',
			)
		),
		
	)

) );

// ==========================================================================================
// MEDIA URL
// ==========================================================================================
vc_map( array(
	'name'            => 'Media Iframe',
	'base'            => 'rs_media',
	'icon'            => 'fa fa-briefcase',
	'description'     => 'Add media content.',
	'params'          => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Media Type',
			'param_name'  => 'media_type',
			'value'       => array(
				'Vimeo'     => 'vimeo',
				'Youtube'   => 'youtube',
				'Sound Cloud' => 'sound_cloud'
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Vimeo ID',
			'param_name'  => 'v_id',
			'description' => 'Enter vimeo id. e.g 79876010',
			'dependency'  => array( 'element' => 'media_type', 'value' => array('vimeo') ),
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Youtube URL',
			'param_name'  => 'y_url',
			'description' => 'Enter youtube link e.g http://www.youtube.com/embed/JuyB7NO0EYY.',
			'dependency'  => array( 'element' => 'media_type', 'value' => array('youtube') ),
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Track ID',
			'param_name'  => 's_id',
			'description' => 'Enter sound cloud track id. e.g 3752929',
			'dependency'  => array( 'element' => 'media_type', 'value' => array('sound_cloud') ),
		),

		// width & height
		array(
			'type'        => 'textfield',
			'heading'     => 'Width',
			'param_name'  => 'width',
			'description' => 'Enter width, default is 100%',
			'group'       => 'Width & Height'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Height',
			'param_name'  => 'height',
			'description' => 'Enter height, default is 100%',
			'group'       => 'Width & Height'
		),
	)

) );


// ==========================================================================================
// MESSAGE BOX
// ==========================================================================================
vc_map( array(
	'name'          => 'Message Box',
	'base'          => 'rs_msg_box',
	'icon'          => 'fa fa-warning',
	'description'   => 'Create a message box.',
	'params'        => array(
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Choose Icon',
			'admin_label' => true,
			'value'       => 'fa fa-paper-plane-o'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Box Type',
			'param_name'  => 'box_type',
			'admin_label' => true,
			'value'       => array(
				'Info'      => 'info',
				'Success'    => 'success',
				'Notice'    => 'notice',
				'Error'     => 'error'
			),
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div',
			'value'       => ''
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Border Color',
			'param_name'  => 'border_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Text Color',
			'param_name'  => 'text_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Background Color',
			'param_name'  => 'background_color',
			'group'       => 'Custom Colors',
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

if ( is_plugin_active( 'wysija-newsletters/index.php' ) ) {
	// ==========================================================================================
	// NEWS LETTER
	// ==========================================================================================
	vc_map( array(
		'name'          => 'Newsletter',
		'base'          => 'rs_newsletter',
		'icon'          => 'fa fa-envelope',
		'description'   => 'Add newsletter.',
		'params'        => array(
			array(
				'type'        => 'dropdown',
				'heading'     => 'Style',
				'param_name'  => 'style',
				'admin_label' => true,
				'value'       => array(
					'Default' => 'style1',
					'Presto'  => 'style2',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => 'Title',
				'param_name'  => 'title',
			),
			array(
				'type'        => 'textfield',
				'heading'     => 'Subtitle',
				'param_name'  => 'subtitle',
				'dependency'  => array( 'element' => 'style', 'value' => 'style2' ),
			),			
			array(
				'type'        => 'textfield',
				'heading'     => 'Note',
				'param_name'  => 'note',
				'admin_label' => true,
			),
			array(
				'type'        => 'textarea',
				'heading'     => 'Content',
				'param_name'  => 'content',
				'description' => 'Insert newsletter shortcode.e.g [wysija_form id="1"]'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => 'Button Color',
				'param_name'  => 'btn_color',
				'value'       => array(
					'Dark' => 'btn-nws-dark',
					'Grey' => 'btn-nws-grey'
				),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => 'Title Color',
				'param_name'  => 'title_color',
				'group'       => 'Colors Properties '
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => 'Note Color',
				'param_name'  => 'note_color',
				'group'       => 'Colors Properties '
			),

			// Extras
			$vc_map_extra_id,
			$vc_map_extra_class,

		)
	) );
}

// ==========================================================================================
// PARALLAX
// ==========================================================================================
vc_map( array(
	'name'          => 'Parallax',
	'base'          => 'rs_parallax',
	'icon'          => 'fa fa-th-large',
	'description'   => 'Create a parallax area.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'value'       => array(
				'Light' => 'light',
				'Dark'  => 'dark'
			),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'background',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Heading',
			'param_name'  => 'heading',
			'holder'      => 'div'
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'link',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Heading Color',
			'param_name'  => 'heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Border Color',
			'param_name'  => 'button_border_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Text Color',
			'param_name'  => 'button_text_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Text Color Hover',
			'param_name'  => 'button_text_color_hover',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Background Hover Color',
			'param_name'  => 'button_background_hover',
			'group'       => 'Colors Properties'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

if ( rs_get_current_post_type() ) {


	// ==========================================================================================
	// Portfolio Featured Image
	// ==========================================================================================
	vc_map( array(
		'name'                    => 'Portfolio Featured Image',
		'base'                    => 'rs_portfolio_featured_image',
		'icon'                    => 'fa fa-file-picture-o',
		'description'             => 'Add portfolio featured image.',
		'show_settings_on_create' => false,
		'params'                  => array(),

	) );

	// ==========================================================================================
	// Portfolio Full Width Slider
	// ==========================================================================================
	vc_map( array(
		'name'                    => 'Portfolio Full Width Slider',
		'base'                    => 'rs_portfolio_fullwidth_slider',
		'icon'                    => 'fa fa-reorder',
		'description'             => 'Add portfolio slider.',
		'show_settings_on_create' => false,
		'params'                  => array(),

	) );

	// ==========================================================================================
	// Portfolio Gallery
	// ==========================================================================================
	vc_map( array(
		'name'                    => 'Portfolio Gallery',
		'base'                    => 'rs_portfolio_gallery',
		'icon'                    => 'fa fa-qrcode',
		'description'             => 'Add portfolio gallery.',
		'show_settings_on_create' => false,
		'params'                  => array(),

	) );

	// ==========================================================================================
	// Portfolio Slider
	// ==========================================================================================
	vc_map( array(
		'name'                    => 'Portfolio Slider',
		'base'                    => 'rs_portfolio_slider',
		'icon'                    => 'fa fa-sliders',
		'description'             => 'Add portfolio slider.',
		'show_settings_on_create' => false,
		'params'                  => array(),

	) );

	// ==========================================================================================
	// Portfolio Details
	// ==========================================================================================
	vc_map( array(
		'name'                    => 'Portfolio Details',
		'base'                    => 'rs_portfolio_project_details',
		'icon'                    => 'fa fa-crosshairs',
		'description'             => 'Add portfolio project details.',
		'show_settings_on_create' => false,
		'params'                  => array(),

	) );

}

// ==========================================================================================
// PORTFOLIO PROMO
// ==========================================================================================
vc_map( array(
	'name'          => 'Portfolio Promo',
	'base'          => 'rs_portfolio_promo',
	'icon'          => 'fa fa-qrcode',
	'description'   => 'Portfolio items list.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Category ID',
			'admin_label' => true,
			'param_name'  => 'category_id',
			'description' => 'Enter category id seperated e.g 672, 776'
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Limit',
			'admin_label' => true,
			'param_name'  => 'Limit'
		),
	array(
		'type'                => 'dropdown',
		 'admin_label' => true,
			'value'               => array(
				'No'                => 'no',
				'Yes'               => 'yes',
			),
			'heading'             => 'Use external URL if exists',
			'param_name'          => 'use_external_url',
		),
		 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class
	)
) );

// ==========================================================================================
// PRICING LIST
// ==========================================================================================
vc_map( array(
	'name'                    => 'Pricing List',
	'base'                    => 'rs_pricing_list',
	'icon'                    => 'fa fa-list',
	'description'             => 'Create pricing list',
	'params'                  => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Header',
			'param_name'  => 'header',
			'admin_label' => true,
		),

		$vc_map_extra_id,
		$vc_map_extra_class,

	),
	'as_parent'       => array('only' => 'rs_pricing_list_item'),
	'js_view'         => 'VcColumnView',
) );

vc_map( array(
	'name'            => 'Pricing List Item',
	'base'            => 'rs_pricing_list_item',
	'icon'                    => 'fa fa-list',
	'as_child'        => array('only' => 'rs_pricing_list'),
	'params'  => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Item',
			'param_name'  => 'item',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Description',
			'param_name'  => 'description',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Price',
			'param_name'  => 'price',
		),
	)
) );

// ==========================================================================================
// PRICING TABLE
// ==========================================================================================
vc_map( array(
	'name'          => 'Pricing Table',
	'base'          => 'rs_pricing_table',
	'icon'          => 'fa fa-money',
	'description'   => 'Create a pricing table.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Marked As Feature Box',
			'param_name'  => 'is_feature',
			'value'       => array(
				'No' => 'no',
				'Yes'  => 'yes'
			),
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'fontawesome',
			'placeholder' => 'Select Icon',
			'value'       => 'fa fa-paper-plane-o'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'        => 'textarea',
			'heading'     => 'Feature',
			'value'       => '',
			'param_name'  => 'feature',
			'description' => 'Add feature seperated with |'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Currency Symbol',
			'param_name'  => 'currency',
			'value'       => '',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Price',
			'param_name'  => 'price',
			'value'       => '',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Alternative Text',
			'param_name'  => 'alt_text',
			'value'       => '',
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'link',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
			'value'       => '',
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Extra Class',
			'param_name'  => 'btn_class',
			'value'       => '',
			'group'       => 'Extras',
		),		

	)
) );

// ==========================================================================================
// PROMO SLIDER
// ==========================================================================================
vc_map( array(
	'name'                    => 'Promo Slider',
	'base'                    => 'rs_promo_slider',
	'icon'                    => 'fa fa-tint',
	'as_parent'               => array('only' => 'rs_promo_slide'),
	'show_settings_on_create' => false,
	'js_view'                 => 'VcColumnView',
	'content_element'         => true,
	'description'             => 'Create a promo slider.',
	'params'  => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'style',
			'value'       => array(
				'Fixed Height Slider' => 'fixed_height_slider',
				'Full Height Slider'  => 'full_height_slider',
				'Auto Height Slider'  => 'auto_height_slider',
			),
		),
	array(
			'type'        => 'attach_image',
			'heading'     => 'Background',
			'param_name'  => 'background',
		),
		$vc_map_extra_id,
		$vc_map_extra_class,
	),

) );

vc_map( array(
	'name'                    => 'Slide',
	'base'                    => 'rs_promo_slide',
	'icon'                    => 'fa fa-sort-numeric-asc',
	'description'             => 'Add promo slide.',
	'as_child'                => array('only' => 'rs_promo_slider'),
	'params'  => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Background',
			'param_name'  => 'background',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Overlay Style',
			'param_name'  => 'overlay_style',
			'value'       => array(
				'Select Overlay'       => '',
				'Dark With Opacity 30' => 'bg-dark-alfa-30',
				'Dark With Opacity 50' => 'bg-dark-alfa-50',
				'Dark With Opacity 70' => 'bg-dark-alfa-70',
				'Dark With Opacity 90' => 'bg-dark-alfa-90',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Alternative Slide Content',
			'param_name' => 'alt',
			'value'      => array(
				'No'  => 'no',
				'Yes' => 'yes'
			)			
		),
		array(
			'type'        => 'attach_image',
			'heading'     => 'Heading Image',
			'param_name'  => 'heading_image',
			'dependency'  => array( 'element' => 'alt', 'value' => array( 'yes' ) ),
		),		
		array(
			'type'        => 'textfield',
			'heading'     => 'Small Heading',
			'param_name'  => 'small_heading',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Heading',
			'param_name'  => 'heading',
		),
	array(
			'type'        => 'dropdown',
			'heading'     => 'Small Heading Below',
			'param_name'  => 'small_heading_below',
			'value'       => array(
				'No'  => 'no',
				'Yes' => 'yes',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button',
			'param_name'  => 'btn',
			'value'       => array(
				'No'          => 'no',
				'One Button'  => 'one_button',
				'Two Buttons' => 'two_buttons'
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Style',
			'param_name'  => 'button_style',
			'value'       => array(
				'Round'  => 'btn-round',
				'Circle' => 'btn-circle',
				'Square' => 'btn-suqare',
			),
			'dependency'  => array( 'element' => 'btn', 'value' => array('one_button', 'two_buttons') ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Button Size',
			'param_name'  => 'button_size',
			'value'       => array(
				'Small'  => 'btn-small',
				'Medium' => 'btn-medium',
				'Large'  => 'btn-large',
			),
			'dependency'  => array( 'element' => 'btn', 'value' => array( 'one_button', 'two_buttons' ) ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'btn_one_link',
			'dependency'  => array( 'element' => 'btn', 'value' => array('one_button', 'two_buttons') ),
		),

		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Two Link',
			'param_name'  => 'btn_two_link',
			'dependency'  => array( 'element' => 'btn', 'value' => array('two_buttons') ),
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'btn', 'value' => array('one_button', 'two_buttons') ),
		),

	array(
			'type'        => 'checkbox',
			'heading'     => 'Button Lighbox',
			'param_name'  => 'btn_lightbox',
			'value'       => array(
				'Open Lightbox' => '1',
			),
			'dependency'  => array( 'element' => 'btn', 'value' => array('one_button', 'two_buttons') ),
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Button Two Text',
			'param_name'  => 'btn_text_two',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'btn', 'value' => array('two_buttons') ),
		),

	array(
			'type'        => 'checkbox',
			'heading'     => 'Button Two Lighbox',
			'param_name'  => 'btn_lightbox_two',
			'value'       => array(
				'Open Lightbox' => '1',
			),
			'dependency'  => array( 'element' => 'btn', 'value' => array('two_buttons') ),
		),

	array(
			'type'        => 'dropdown',
			'heading'     => 'Add Player Icon',
			'param_name'  => 'add_player_icon',
			'value'       => array(
				'No'  => 'no',
		'Use Self-hosted Video' => 'use_self_hosted_video',
		'Use Embedded' => 'use_embedded_video',
			),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Self-hosted Video',
			'param_name'  => 'self_hosted_video',
			'description' => 'Upload video and enter full url',
		'dependency'  => array( 'element' => 'add_player_icon', 'value' => array('use_self_hosted_video') ),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Embedded Video',
			'param_name'  => 'embedded_video',
			'description' => 'Use YouTube or Vimeo video',
			'dependency'  => array( 'element' => 'add_player_icon', 'value' => array('use_embedded_video') ),
		),

		//custom colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Small Heading Color',
			'param_name'  => 'small_heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Heading Color',
			'param_name'  => 'heading_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Border Color',
			'param_name'  => 'button_border_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Text Color',
			'param_name'  => 'button_text_color',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Text Color Hover',
			'param_name'  => 'button_text_color_hover',
			'group'       => 'Colors Properties'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Button Background Hover Color',
			'param_name'  => 'button_background_hover',
			'group'       => 'Colors Properties'
		),
	)

) );


// ==========================================================================================
// SECTION TITLE
// ==========================================================================================
vc_map( array(
	'name'          => 'Section Title',
	'base'          => 'rs_section_title',
	'icon'          => 'fa fa-italic',
	'description'   => 'Create title for section.',
	'params'        => array(
		array(
			'type'       => 'dropdown',
			'heading'    => 'Style',
			'param_name' => 'title_style',
			'value'      => array(
				'Default'       => 'default',
				'With Subtitle' => 'with_subtitle'
			)
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Align',
			'param_name'  => 'align',
			'value'       => array(
				'Left'      => 'left',
				'Center'    => 'center'
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'holder'      => 'div',
			'value'       => '',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Subtitle',
			'param_name'  => 'subtitle',
			'holder'      => 'div',
			'value'       => '',
			'dependency'  => array( 'element' => 'title_style', 'value' => 'with_subtitle' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Show Link ? ',
			'param_name'  => 'show_right',
			'dependency'  => array( 'element' => 'title_style', 'value' => 'default' ),
			'value' => array(
				'No'  => 'no',
				'Yes' => 'yes'
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'right_title',
			'value'       => '',
			'dependency'  => array( 'element' => 'show_right', 'value' => array('yes') ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Link',
			'param_name'  => 'link',
			'dependency'  => array( 'element' => 'show_right', 'value' => array('yes') ),
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Right Title Color',
			'param_name'  => 'right_title_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Right Title Hover Color',
			'param_name'  => 'right_title_hover',
			'group'       => 'Custom Colors',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Title Size',
			'param_name'  => 'title_size',
			'admin_label' => true,
			'description' => 'Add size in pixels e.g 15px',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Right Title Size',
			'param_name'  => 'right_title_size',
			'admin_label' => true,
			'description' => 'Add size in pixels e.g 15px',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title Margin Top',
			'param_name'  => 'top',
			'admin_label' => true,
			'group'       => 'Title Margin Properties',
			'description' => 'Add size in pixels e.g 15px'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title Margin Bottom',
			'param_name'  => 'bottom',
			'admin_label' => true,
			'group'       => 'Title Margin Properties',
			'description' => 'Add size in pixels e.g 15px'
		),

		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );


// ==========================================================================================
// SERVICE BOX
// ==========================================================================================
vc_map( array(
	'name'          => 'Service Box',
	'base'          => 'rs_service_box',
	'icon'          => 'fa fa-th-large',
	'description'   => 'Create a service box.',
	'params'        => array(
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
		),
	array(
			'type'        => 'dropdown',
			'heading'     => 'Action',
			'param_name'  => 'action',
			'description' => 'Action on image click.',
			'value'       => array(
				'Open lightbox image'  => 'lightbox_image',
				'Open lightbox video' => 'lightbox_video',
				'Do nothing' => 'do_nothing',
			),
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Video URL',
			'param_name'  => 'video',
			'admin_label' => true,
			'description' => 'URL of your YouTube or Vimeo clip.',
		'dependency'  => array( 'element' => 'action', 'value' => array('lightbox_video') ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'holder'      => 'div'
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'param_name'  => 'btn_text',
		),
		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'param_name'  => 'btn_link',
			'dependency'  => array( 'element' => 'btn_text', 'not_empty' => true ),
		),

		// Custom Colors
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Colors',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Content Color',
			'param_name'  => 'content_color',
			'group'       => 'Custom Colors',
		),



		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// SLIDER CONTENTS
// ==========================================================================================
vc_map( array(
	'name'                    => 'Slider Contents',
	'base'                    => 'rs_slider',
	'icon'                    => 'fa fa-exchange',
	'description'             => 'Create some slider contents',
	'params'                  => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Slider Type',
			'param_name'  => 'slider_type',
			'admin_label' => true,
			'value'       => array(
				'Full Width Slider' => 'fullwidth-slider',
				'Work Full Slider'  => 'work-full-slider',
				'Element Slider'    => 'item-carousel',
			),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => 'Wrapped Inside Container',
			'param_name'  => 'inside_container',
			'value'       => array(
				'No'  => 'no',
				'Yes' => 'yes',
			),
			'dependency'  => array( 'element' => 'slider_type', 'value' => array('fullwidth-slider') ),
		),

		$vc_map_extra_id,
		$vc_map_extra_class,

	),
	'is_container'	=> true,
	'as_parent'       => array('only' => 'rs_slider_item'),
	'js_view'         => 'VcColumnView',
) );

vc_map( array(
	'name'            => 'Slider Content',
	'base'            => 'rs_slider_item',
	'as_child'        => array('only' => 'rs_slider'),
	'is_container'    => true,
	'js_view'         => 'VcColumnView',
) );

// ==========================================================================================
// Space
// ==========================================================================================
vc_map( array(
	'name'          => 'Space',
	'base'          => 'rs_space',
	'icon'          => 'fa fa fa-arrows-v',
	'description'   => 'Add space.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Height',
			'admin_label' => true,
			'param_name'  => 'height',
			'description' => 'Add value on pixel e.g 25px'
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
	)
) );

// ==========================================================================================
// Space
// ==========================================================================================
vc_map( array(
	'name'          => 'Service Details',
	'base'          => 'rs_service_detail',
	'icon'          => 'fa fa fa-arrows-v',
	'description'   => 'Add service detail.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Price',
			'admin_label' => true,
			'param_name'  => 'price',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Month',
			'admin_label' => true,
			'param_name'  => 'month',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Button Text',
			'admin_label' => true,
			'param_name'  => 'btn_text',
		),

		array(
			'type'        => 'vc_link',
			'heading'     => 'Button Link',
			'admin_label' => true,
			'param_name'  => 'btn_link',
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
	)
) );


// ==========================================================================================
// SPECIAL TEXT
// ==========================================================================================
vc_map( array(
	'name'          => 'Special Text',
	'base'          => 'rs_special_text',
	'icon'          => 'fa fa-tint',
	'description'   => 'Create special text.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Font',
			'param_name'  => 'font',
			'admin_label' => true,
			'value'       => array_flip(rs_get_font_choices(true)),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => 'Tag Name',
			'param_name'  => 'tag',
			'value'       => array(
				'H1'  => 'h1',
				'H2'  => 'h2',
				'H3'  => 'h3',
				'H4'  => 'h4',
				'H5'  => 'h5',
				'H6'  => 'h6',
				'div' => 'div',
			),
		),

		array(
			'type'        => 'textarea_html',
			'heading'     => 'Content',
			'param_name'  => 'content',
			'holder'      => 'div',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Font Size',
			'param_name'  => 'font_size',
			'description' => 'Enter the size in pixel e.g 45px',
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Line Height',
			'param_name'  => 'line_height',
			'description' => 'Add in pixel e.g 11px',
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Letter Spacing',
			'param_name'  => 'letter_spacing',
			'description' => 'Enter the size in pixel e.g 1px',
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Font Color',
			'param_name'  => 'font_color',
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'dropdown',
			'heading'     => 'Font Weight',
			'param_name'  => 'font_weight',
			'value'       => array(
				'Light'      => '300',
				'Normal'     => '400',
				'Bold'       => '600',
				'Bold'       => '700',
				'Extra Bold' => '800',
			),
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'dropdown',
			'heading'     => 'Font Style',
			'param_name'  => 'font_style',
			'value'       => array(
				'Normal' => 'normal',
				'Italic' => 'italic',
			),
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'dropdown',
			'heading'     => 'Text Transform',
			'param_name'  => 'transform',
			'value'       => array(
				'Select Transform' => '',
				'Uppercase'        => 'uppercase',
				'Lowercase'        => 'lowercase',
			),
			'group'       => 'Custom Font Properties'
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Top',
			'param_name'  => 'margin_top',
			'description' => 'Enter the size in pixel e.g 45px',
			'group'       => 'Custom Margin Properties'
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Margin Bottom',
			'param_name'  => 'margin_bottom',
			'description' => 'Enter the size in pixel e.g 45px',
			'group'       => 'Custom Margin Properties'
		),


		// Extras
		$vc_map_extra_id,
		$vc_map_extra_class,

	)
) );

// ==========================================================================================
// SPLIT SCREEN
// ==========================================================================================
vc_map( array(
	'name'                    => 'Split Screen',
	'base'                    => 'rs_split_screen',
	'icon'                    => 'fa fa-list',
	'description'             => 'Create split screen',
	'params'                  => array(

		array(
			'type'        => 'textfield',
			'heading'     => 'Header',
			'param_name'  => 'header',
			'admin_label' => true,
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => 'Align Content',
			'param_name'  => 'align_content',
			'value'       => array(
				'Left'   => 'align-left',
				'Right'  => 'align-right',
				'Center' => 'align-center'
			)
		),

		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
			'admin_label' => false,
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => 'Image Position',
			'param_name'  => 'img_position',
			'value'       => array(
				'Right' => 'right',
				'Left'  => 'left',
			),
			
		),

		$vc_map_extra_id,
		$vc_map_extra_class,

	),
	'is_container'    => true,
	'js_view'         => 'VcColumnView',
) );

// ==========================================================================================
// Vcard
// ==========================================================================================
vc_map( array(
	'name'                    => 'V-card',
	'base'                    => 'rs_vcard',
	'icon'                    => 'fa fa-user',
	'description'             => 'Create v-card',
	'params'                  => array(

		array(
			'type'        => 'textfield',
			'heading'     => 'Name',
			'param_name'  => 'name',
			'admin_label' => true,
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Position',
			'param_name'  => 'position',
			'admin_label' => true,
		),
		
		array(
			'type'        => 'attach_image',
			'heading'     => 'Image',
			'param_name'  => 'image',
			'admin_label' => false,
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Name Color',
			'param_name'  => 'name_color',
			'group'       => 'Custom Colors',
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Position Color',
			'param_name'  => 'position_color',
			'group'       => 'Custom Colors',
		),		

		$vc_map_extra_id,
		$vc_map_extra_class,
		

	),
	'is_container'    => true,
	'js_view'         => 'VcColumnView',
) );

// ==========================================================================================
// Educational bloc;
// ==========================================================================================
vc_map( array(
	'name'        => 'Educational block',
	'base'        => 'rs_educational',
	'icon'        => 'fa fa-graduation-cap',
	'description' => 'Create educational info',
	'params'      => array(
		
		array(
			'type'       => 'dropdown',
			'param_name' => 'style',
			'heading'    => 'Style',
			'value'      => array(
				'Default' => '',
				'Large'   => 'large',
			)
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'param_name'  => 'title',
			'admin_label' => true,
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Educational Institution',
			'param_name'  => 'institution',
			'holder'      => 'div',
		),

		array(
			'type'        => 'textfield',
			'heading'     => 'Years',
			'param_name'  => 'years',
			'admin_label' => true,
		),
		
		array(
			'type'       => 'checkbox',
			'param_name' => 'hide_hr',
			'heading'    => 'Hide HR?',
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Colors',
		),

		array(
			'type'        => 'colorpicker',
			'heading'     => 'Years Color',
			'param_name'  => 'years_color',
			'group'       => 'Custom Colors',
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
		

	)
) );


// ==========================================================================================
// TEAM BLOCK
// ==========================================================================================

// get the team member name and append space as default
$members_arr = rs_element_values('post', array('post_type' => 'team', 'posts_per_page' => -1));
$member_name = array('Choose member' => '');
if (is_array($members_arr)) {
	$member_name = array_merge($member_name,$members_arr);
}
vc_map( array(
	'name'          => 'Team member',
	'base'          => 'rs_team',
	'icon'          => 'fa fa-users',
	'description'   => 'Add team block.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'description' => 'Select a style for member block',
			'param_name'  => 'style',
			'value'       => array(
				'Default' => 'default',
				'Presto'  => 'presto'
			)
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Member',
			'description' => 'Select member name to show.',
			'param_name'  => 'person_id',
			'value'       => $member_name,
			'admin_label' => true,
		),
		 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,

	)
) );

// ==========================================================================================
// TESTIMONIAL
// ==========================================================================================
vc_map( array(
	'name'          => 'Testimonial',
	'base'          => 'rs_testimonial',
	'icon'          => 'fa fa-comments',
	'description'   => 'Create a testimonial block.',
	'params'        => array(
		array(
			'type'       => 'dropdown',
			'heading'    => 'Style',
			'param_name' => 'style',
			'value'      => array(
				'Style 1' => 'style1',
				'Style 2' => 'style2'
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Category ID',
			'param_name'  => 'cats',
			'admin_label' => true,
			'description' => 'Enter category id, multiple categories are seperated with comma e.g 27,47',
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Items',
			'param_name'  => 'items',
			'admin_label' => true,
			'description' => 'How many testimonial to display',
		),
		array(
			'type'                => 'colorpicker',
			'heading'             => 'Background Color',
			'param_name'          => 'bgcolor',
		),
		array(
			'type'                => 'attach_image',
			'heading'             => 'Background Image',
			'param_name'          => 'background',
		),
		array(
			'type'                => 'dropdown',
			'param_name'          => 'attachment',
			'heading'             => 'Background Attachment',
			'value'               => array(
				'Scroll'            => 'bg-scroll',
				'Fixed'             => 'bg-fixed',
			),
		),
	array(
			'type'                => 'dropdown',
			'param_name'          => 'background_style',
			'heading'             => 'Background Style',
			'value'               => array(
				'Dark'				=> 'bg-dark',
				'Gray'				=> 'bg-gray',
			),
		),
	array(
			'type'        => 'dropdown',
			'heading'     => 'Overlay Style',
			'param_name'  => 'overlay_style',
			'value'       => array(
				'Select Overlay'       => '',
				'Dark With Opacity 30' => 'bg-dark-alfa-30',
				'Dark With Opacity 50' => 'bg-dark-alfa-50',
				'Dark With Opacity 70' => 'bg-dark-alfa-70',
				'Dark With Opacity 90' => 'bg-dark-alfa-90',
			),
		),
		
		array(
			'type'       => 'dropdown',
			'param_name' => 'autoplay',	
			'heading'    => 'autoPlay Carousel',
			'description' => 'Select Yes if you want to enable autoplay',
			'value'      => array(
				'No'     => '',
				'Yes'    => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-4',
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'time',
			'heading'     => 'Pause Time',
			'description' => 'Input any integer for example 5000 to play every 5 seconds. If you set autoPlay:yes and this field blank,  default pause time will be 5 seconds.',
			'dependency'  => array(
				'element' => 'autoplay',
				'value'   => 'yes'
			),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'textfield',
			'param_name'       => 'speed'	,
			'heading'          => 'Slide Speed',
			'description'      => 'Input any integer for slide speed in milliseconds',
			'edit_field_class' => 'vc_col-sm-4',
		),

		//custom color
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Icon Color',
			'param_name'  => 'icon_color',
			'group'       => 'Custom Color'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Title Color',
			'param_name'  => 'title_color',
			'group'       => 'Custom Color'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Content Color',
			'param_name'  => 'content_color',
			'group'       => 'Custom Color'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => 'Author Name Color',
			'param_name'  => 'author_color',
			'group'       => 'Custom Color'
		),

		//size
		array(
			'type'        => 'textfield',
			'heading'     => 'Icon Size',
			'param_name'  => 'icon_size',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Title Size',
			'param_name'  => 'title_size',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Content Size',
			'param_name'  => 'content_size',
			'group'       => 'Font Size Properties'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Author Name Size',
			'param_name'  => 'author_size',
			'group'       => 'Font Size Properties'
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
	)
) );

// ==========================================================================================
// Tool Tip
// ==========================================================================================
vc_map( array(
	'name'          => 'ToolTip',
	'base'          => 'rs_tooltip',
	'icon'          => 'fa fa fa-comment',
	'description'   => 'Create tooltip.',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'ToolTip Position',
			'param_name'  => 'position',
			'value'       => array(
				'Top'       => 'top',
				'Bottom'    => 'bot'
			),
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => 'ToolTip Text',
			'param_name'  => 'content',
			'holder'      => 'div'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'ToolTip Text On Hover',
			'param_name'  => 'tool_tip_text_hover',
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
	)
) );


// ==========================================================================================
// WOO PRODUCTS
// ==========================================================================================
vc_map( array(
	'name'          => 'Woo Products',
	'base'          => 'rs_woo_products',
	'icon'          => 'fa fa-shopping-cart',
	'description'   => 'Add WooCommerce products.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Category ID',
			'admin_label' => true,
			'param_name'  => 'category_id',
			'description' => 'Enter category id seperated e.g 672'
		),
	array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Columns',
			'param_name' => 'columns',
			'value' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
	),
	array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('Rand', 'rs')       => 'rand',
				__('Date', 'rs')       => 'date',
				__('Price', 'rs')      => 'price',
				__('Popularity', 'rs') => 'popularity',
				__('Rating', 'rs')     => 'rating',
				__('Title', 'rs')      => 'title',
			),
	),
	array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order',
			'param_name' => 'order',
			'value' => array(
				__('Ascending', 'rs') => 'asc',
				__('Descending', 'rs') => 'desc'
			),
		'dependency'  => array( 'element' => 'orderby', 'value' => array('date', 'price', 'title') ),
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Show',
			'param_name' => 'show',
			'admin_label' => true,
			'value' => array(
				__('All Products'   , 'rhythm-addons') 	=> '',
				__('Featured Products'  , 'rhythm-addons') 	=> 'featured',
				__('On-sale Products', 'rhythm-addons') 	=> 'onsale',
			),
			'description' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Add to cart Button',
			'param_name' => 'addcart_btn',
			'admin_label' => true,
			'value' => array(
				__('Show'   , 'rhythm-addons') 	=> '',
				__('Hide'  , 'rhythm-addons') 	=> 'hide',
			),
			'description' => ''
		),		
	array(
			'type'        => 'textfield',
			'heading'     => 'Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
		 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,

	)
) );
// ==========================================================================================
// WOO LISTED PRODUCTS
// ==========================================================================================
vc_map( array(
	'name'          => 'Woo Listed Products',
	'base'          => 'rs_woo_listed_products',
	'icon'          => 'fa fa-shopping-cart',
	'description'   => 'Add Listed WooCommerce products. The best displays in tabs',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Category ID',
			'admin_label' => true,
			'param_name'  => 'category_id',
			'description' => 'Enter category id seperated e.g 672'
		),
	array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order by',
			'param_name' => 'orderby',
			'value' => array(
				__('Rand', 'rs')       => 'rand',
				__('Date', 'rs')       => 'date',
				__('Price', 'rs')      => 'price',
				__('Popularity', 'rs') => 'popularity',
				__('Rating', 'rs')     => 'rating',
				__('Title', 'rs')      => 'title',
			),
	),
	array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Order',
			'param_name' => 'order',
			'value' => array(
				__('Ascending', 'rs') => 'asc',
				__('Descending', 'rs') => 'desc'
			),
		'dependency'  => array( 'element' => 'orderby', 'value' => array('date', 'price', 'title') ),
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Show',
			'param_name' => 'show',
			'admin_label' => true,
			'value' => array(
				__('All Products'   , 'rhythm-addons') 	=> '',
				__('Featured Products'  , 'rhythm-addons') 	=> 'featured',
				__('On-sale Products', 'rhythm-addons') 	=> 'onsale',
			),
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Limit',
			'param_name'  => 'limit',
			'admin_label' => true,
		),
		 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
		$vc_map_animation,
		$vc_map_animation_delay,
		$vc_map_animation_duration,

	)
) );



// ==========================================================================================
// WIDGET LATEST COMMENTS
// ==========================================================================================
vc_map( array(
	'name'          => 'WP Latest Comments',
	'base'          => 'rs_wp_latest_comments',
	'icon'          => 'icon-wpb-wp',
	'description'   => 'Displays latest comments.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'admin_label' => true,
			'param_name'  => 'title',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Number of comments to show',
			'admin_label' => true,
			'param_name'  => 'number',
			'description' => ''
		),
	 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
 )
) );

// ==========================================================================================
// WIDGET MULTI TABS
// ==========================================================================================
vc_map( array(
	'name'          => 'WP Multi Tabs',
	'base'          => 'rs_wp_multi_tabs',
	'icon'          => 'icon-wpb-wp',
	'description'   => 'Displays popular and latests posts on tabs.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'admin_label' => true,
			'param_name'  => 'title',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Number of posts to show on each tab',
			'admin_label' => true,
			'param_name'  => 'limit',
			'description' => ''
		),
	 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
 )
) );

// ==========================================================================================
// WIDGET RHYTHM CATEGORIES
// ==========================================================================================
vc_map( array(
	'name'          => 'WP Rhythm Categories',
	'base'          => 'rs_wp_rhythm_categories',
	'icon'          => 'icon-wpb-wp',
	'description'   => 'Displays list of categories.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'admin_label' => true,
			'param_name'  => 'title',
			'description' => ''
		),
	 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
 )
) );

// ==========================================================================================
// WIDGET FOLLOW US
// ==========================================================================================
vc_map( array(
	'name'          => 'WP Follow US',
	'base'          => 'rs_wp_follow_us',
	'icon'          => 'icon-wpb-wp',
	'description'   => 'Displays list of buttons.',
	'params'        => array(
		array(
			'type'        => 'textfield',
			'heading'     => 'Title',
			'admin_label' => true,
			'param_name'  => 'title',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Facebook URL',
			'admin_label' => true,
			'param_name'  => 'facebook',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Twitter URL',
			'admin_label' => true,
			'param_name'  => 'twitter',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Google+ URL',
			'admin_label' => true,
			'param_name'  => 'googleplus',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'Pinterest URL',
			'admin_label' => true,
			'param_name'  => 'pinterest',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'YouTube URL',
			'admin_label' => true,
			'param_name'  => 'youtube',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'LinkedIn URL',
			'admin_label' => true,
			'param_name'  => 'linkedin',
			'description' => ''
		),
	array(
			'type'        => 'textfield',
			'heading'     => 'RSS URL',
			'admin_label' => true,
			'param_name'  => 'RSS',
			'description' => ''
		),
	 // Extras
		$vc_map_extra_id,
		$vc_map_extra_class,
 )
) );

// ==========================================================================================
// VC TABS
// ==========================================================================================
$tab_unique_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_unique_id_2 = time() . '-2-' . rand( 0, 100 );
$tab_unique_id_3 = time() . '-3-' . rand( 0, 100 );
vc_map( array(
	"name"            => 'Tabs',
	'base'            => 'vc_tabs',
	'is_container'    => true,
	'icon'            => 'fa fa-toggle-right',
	'description'     => 'Tabbed content',
	'params'          => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Tab Style',
			'param_name'  => 'style',
			'value'       => array(
				'Standard'  => 'standard',
				'Minimal'   => 'minimal',
				'With Icon' => 'with_icon',
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Active Tab',
			'param_name'  => 'active',
			'description' => 'You can active any tab as default. Eg. 1 or 2 or 3'
		),
		$vc_map_extra_id,
		$vc_map_extra_class,

	),
	'custom_markup'   => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
	'default_content' => '
		[vc_tab title="Tab 1" tab_id="' . $tab_unique_id_1 . '"][/vc_tab]
		[vc_tab title="Tab 2" tab_id="' . $tab_unique_id_2 . '"][/vc_tab]
		[vc_tab title="Tab 3" tab_id="' . $tab_unique_id_3 . '"][/vc_tab]',
	'js_view'         => 'VcTabsView'
) );

// ==========================================================================================
// VC TAB
// ==========================================================================================
vc_map( array(
	'name'                      => 'Tab',
	'base'                      => 'vc_tab',
	'allowed_container_element' => 'vc_row',
	'is_container'              => true,
	'content_element'           => false,
	'params'                    => array(
		array(
			'type'        => 'tab_id',
			'heading'     => 'Tab Unique ID',
			'param_name'  => 'tab_id'
		),
		array(
			'type'        => 'textfield',
			'heading'     => 'Tab Title',
			'param_name'  => 'title',
		),
		array(
			'type'        => 'vc_icon',
			'heading'     => 'Select Icon',
			'param_name'  => 'icon',
			'icon_type'   => 'el_icons',
			'placeholder' => 'Choose Icon',
			'value'       => 'icon-strategy',
		),
	),
	'js_view'         => 'VcTabView'
) );

// ==========================================================================================
// VC COLUMN TEXT
// ==========================================================================================
vc_map( array(
	'name'          => 'Text Block',
	'base'          => 'vc_column_text',
	'icon'          => 'fa fa-text-width',
	'description'   => 'A block of text with WYSIWYG editor',
	'params'        => array(
		array(
			'type'        => 'dropdown',
			'heading'     => 'Align',
			'param_name'  => 'align',
			'value'       => array(
				'Choose Align' => '',
				'Left'         => 'left',
				'Center'       => 'center',
				'Right'        => 'right'
			),
		),
		array(
			'holder'     => 'div',
			'type'       => 'textarea_html',
			'heading'    => 'Text',
			'param_name' => 'content',
			'value'      => '<p>I am text block. Click edit button to change this text.</p>',
		),


		//custom color
		array(
			'type'       => 'colorpicker',
			'heading'    => 'Text Color',
			'param_name' => 'text_color',
			'group'      => 'Custom Color'
		),

		//size
		array(
			'type'       => 'textfield',
			'heading'    => 'Text Size',
			'param_name' => 'text_size',
			'description' => 'Add in pixel e.g 14px',
			'group'      => 'Font Properties'
		),
		array(
			'type'       => 'textfield',
			'heading'    => 'Line Height',
			'param_name' => 'line_height',
			'description' => 'Add in pixel e.g 11px',
			'group'      => 'Font Properties'
		),
		array(
			'type'       => 'textfield',
			'heading'    => 'Letter Spacing',
			'param_name' => 'letter_spacing',
			'description' => 'Add in pixel e.g 1px',
			'group'      => 'Font Properties'
		),

		$vc_map_extra_id,
		$vc_map_extra_class,
	)
) );



// ==========================================================================================
// VC TOGGLE
// ==========================================================================================
vc_map( array(
	'name'        => 'Toggle',
	'base'        => 'vc_toggle',
	'icon'        => 'fa fa-unsorted',
	'description' => 'Toggle element for Q&A block',
	'params'      => array(
		array(
			'type'       => 'textfield',
			'holder'     => 'h4',
			'class'      => 'toggle_title',
			'heading'    => 'Toggle title',
			'param_name' => 'title',
			'value'      => 'Toggle Title',
		),
		array(
			'type'       => 'textarea_html',
			'holder'     => 'div',
			'class'      => 'toggle_content',
			'heading'    => 'Toggle content',
			'param_name' => 'content',
			'value'      => 'Toggle content goes here, click edit button to change this text.',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => 'Default state',
			'param_name'  => 'open',
			'value'       => array(
				'Closed'    => '',
				'Open'      => 'true'
			),
			'description' => 'Select "Open" if you want toggle to be open by default.',
		),
		$vc_map_extra_id,
		$vc_map_extra_class,

	),
	'js_view' => 'VcToggleView'
) );


class RS_WPBakeryShortCodesContainer extends WPBakeryShortCodesContainer {
	public function contentAdmin( $atts, $content = null ) {
		$width = $el_class = '';
		extract( shortcode_atts( $this->predefined_atts, $atts ) );
		$label_class = ( isset( $this->settings['label_class'] ) ) ? $this->settings['label_class'] : 'info';
		$output  = '';

		$column_controls = $this->getColumnControls( $this->settings( 'controls' ) );
		$column_controls_bottom = $this->getColumnControls( 'add', 'bottom-controls' );
		for ( $i = 0; $i < count( $width ); $i ++ ) {
			$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';
			$output .= '<div class="rs-container-title"><span class="rs-label rs-label-'. $label_class .'">'. $this->settings['name'] .'</span></div>'; // ADDED THIS LINE
			$output .= $column_controls;
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';
			$output .= do_shortcode( shortcode_unautop( $content ) );
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					$param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key = key( $param_value );
						$param_value = $param_value[$first_key];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= $column_controls_bottom;
			$output .= '</div>';
		}
		return $output;
	}
}


class WPBakeryShortCode_RS_Split_Screen extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Vcard extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Slider extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Slider_Item extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Pricing_List extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Pricing_List_Item extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Counters   extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Count  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Gallery_2  extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Gallery_2_Item  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Logo_Sliders   extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Logo_Slide  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Promo_Slider  extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Promo_Slide  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Banner_Slider   extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Banner_Slide  extends WPBakeryShortCode {}

add_action( 'admin_init', 'vc_remove_elements', 10);
function vc_remove_elements( $e = array() ) {

	if ( !empty( $e ) ) {
		foreach ( $e as $key => $r_this ) {
			vc_remove_element( 'vc_'.$r_this );
		}
	}
}

$s_elemets = array( 'icon', 'masonry_media_grid', 'masonry_grid', 'basic_grid', 'media_grid', 'custom_heading', 'empty_space', 'clients', 'widget_sidebar', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'single_image', 'button', 'toogle', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_js', 'pie', 'wp_meta', 'wp_recentcomments', 'wp_text', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss' );
vc_remove_element('client', 'testimonial', 'contact-form-7');
//vc_remove_elements( $s_elemets );
