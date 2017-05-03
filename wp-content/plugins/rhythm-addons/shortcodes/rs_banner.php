<?php
/**
 *
 * RS Parallax
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_banner($atts, $content = '', $key = '') {
	$defaults = array(
		'id'                        => '',
		'class'                     => '',
		'btn_class'                 => '',
		'btn_two_class'             => '',
		'style'                     => 'full_height',
		'mode'                      => '',
		'video_source'              => 'external_video',
		'video_url'                 => '',
    	'vim_video_url'             => '',
    	'form_id'                   => '',
		'video_url_mp4'             => '',
		'video_url_ogv'             => '',
		'video_url_webm'            => '',
		'sound'                     => 'true',
		'overlay_style'             => '',
		'autoplay'                  => 'false',
		'img_heading'               => '',
		'img_caption'               => '',
		'background'                => '',
		'btn_style'                 => 'btn-circle',
		'btn_size'					=> 'btn-medium',
		'd_small_heading_font_size' => 'hs-line-1',
		'd_big_heading_font_size'   => 'hs-line-1',
		'small_heading'             => '',
		's_link'                    => '',
		's_link_style'              => '',
		'big_heading'               => '',
		'text_rotate'               => '',
		'big_heading_margin'        => 'mb-80 mb-xs-30 mt-50 mt-sm-0',
		'btn_text'                  => '',
    	'link_text'                 => '',
		'link'                      => '',
		'btn_lightbox'              => '',
		'link_2'                    => '',
		'btn_text_2'                => '',
		'btn_lightbox_2'            => '',
		// heading color
		'img_caption_color'         => '',
		'big_heading_color'         => '',
		'small_heading_color'       => '',
		'small_heading_font_size'   => '',
		'big_heading_font_size'     => '',
    'slide_speed'               => '',
    'autoplay_speed'            => '',
    'custom_overlay_color'      => '',
    'overlay_opacity'           => '1',
	);

	extract(shortcode_atts($defaults, $atts));

	$id                        = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class                     = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	$btn_class                 = ( $btn_class ) ? ' ' . sanitize_html_classes($btn_class) : '';
	$btn_two_class             = ( $btn_two_class ) ? ' ' . sanitize_html_classes($btn_two_class) : '';
	$overlay_style             = ( $overlay_style ) ? sanitize_html_classes($overlay_style) : '';
	$btn_style                 = ( $btn_style ) ? sanitize_html_classes($btn_style) : '';
	$btn_size                 = ( $btn_size ) ? sanitize_html_classes($btn_size) : '';
	$d_small_heading_font_size = ( $d_small_heading_font_size ) ? sanitize_html_classes($d_small_heading_font_size) : '';
	$d_big_heading_font_size   = ( $d_big_heading_font_size ) ? sanitize_html_classes($d_big_heading_font_size) : '';
  $vim_video_url             = ( $vim_video_url ) ? $vim_video_url:'#';
  	
  	$img_caption_color         = ( $img_caption_color ) ? 'color:' . $img_caption_color . ';' : '';
	$big_heading_color         = ( $big_heading ) ? 'color:' . $big_heading_color . ';' : '';
	$small_heading_color       = ( $small_heading_color ) ? 'color:' . $small_heading_color . ';' : '';
	$small_heading_font_size   = ( $small_heading_font_size ) ? 'font-size:' . $small_heading_font_size . ';' : '';
	$big_heading_font_size     = ( $big_heading_font_size ) ? 'font-size:' . $big_heading_font_size . ';' : '';
  $slide_speed               = ( $style == 'banner_with_image_rotator' && $slide_speed) ? ' data-speed="'.esc_attr($slide_speed).'"':'';
  $autoplay_speed            = ( $style == 'banner_with_image_rotator' && $slide_speed) ? ' data-autoplay="'.esc_attr($autoplay_speed).'"':'';
  $customize                 = ( $custom_overlay_color && $overlay_style == 'custom-overlay') ? true:false;
  $custom_style = '';
  $uniqid_class = '';
  
  $scroll_down_style = $s_link_style == 'presto' ? 'scroll-down-style2' : '';
  	
  	$el_img_caption = ( $img_caption_color ) ? ' style="' . esc_attr( $img_caption_color ) . '"' : '';
	$el_small_heading = ( $small_heading_font_size || $small_heading_color ) ? ' style="' . esc_attr($small_heading_font_size . $small_heading_color) . '"' : '';
	$el_big_heading = ( $big_heading_font_size || $big_heading_color ) ? ' style="' . esc_attr($big_heading_font_size . $big_heading_color) . '"' : '';

	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($link);
		$href = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
		$title = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
		$target = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
		$lightbox = ( $btn_lightbox == 1 ) ? 'lightbox mfp-iframe' : '';
	}

	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($link_2);
		$href_2     = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
		$title_2    = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
		$target_2   = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
		$lightbox_2 = ( $btn_lightbox_2 == 1 ) ? 'lightbox mfp-iframe' : '';
	}

	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($s_link);
		$href_s = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
		$title_s = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
		$target_s = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
	}

	$data_background = '';
	$background_url = '';
	if (is_numeric($background) && !empty($background)) {
		$image_src = wp_get_attachment_image_src($background, 'full');
		if (isset($image_src[0])) {
			$data_background = ' data-background=' . esc_url($image_src[0]) . '';
			$background_url = esc_url($image_src[0]);
		}
	}

  if( $customize ) {
    $uniqid       = uniqid();
    $custom_style = '';

    $custom_style .=  '.overlay-custom-'.esc_attr($uniqid).':before{';
    $custom_style .=  ( $custom_overlay_color ) ? 'background:'.rs_hex2rgba($custom_overlay_color, $overlay_opacity).';':'';
    $custom_style .=  'position:absolute;content: " "; width: 100%; height: 100%; top: 0;left: 0;';
    $custom_style .= '}';

    ts_add_inline_style( $custom_style );

    $uniqid_class  = ' overlay-custom-'. esc_attr($uniqid);
  }

	$poster = '';
	$poster_type = '';
	if ($video_source == 'self_hosted_video') {

		$pattern = '/\\.[^.\\s]{3,4}$/';
		$video_url_mp4 = preg_replace($pattern, '', $video_url_mp4);
		$video_url_ogv = preg_replace($pattern, '', $video_url_ogv);
		$video_url_webm = preg_replace($pattern, '', $video_url_webm);
		$poster = preg_replace($pattern, '', $background_url);
		$poster_type = pathinfo($background_url, PATHINFO_EXTENSION);
	}

	switch ($style) {
		case 'full_height':

			$output = '<section ' . $id . ' class="home-section ' . $overlay_style .sanitize_html_classes($uniqid_class). ' parallax-2' . $class . '" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full container">';
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w ' . $btn_size . ' ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w ' . $btn_size . ' ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;


			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			# code...
			break;

		case 'full_height_video':
			$output = '<section ' . $id . ' class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' bg-pattern-over' . $class . '" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full container">';
			if ($video_source == 'self_hosted_video') {
				$output .= '<div class="bg-video-wrapper"';
				$output .= 'data-poster="'.esc_url($poster).'"';
				$output .= 'data-mp4="'.esc_url($video_url_mp4).'"';
				$output .= 'data-ogv="'.esc_url($video_url_ogv).'"';
				$output .= 'data-webm="'.esc_url($video_url_webm).'"';
				$output .= 'data-poster-type="'.esc_attr($poster_type).'"';
				$output .= 'data-muted="'.esc_attr($sound).'"';
				$output .= 'data-autoplay="'.esc_attr($autoplay).'"';
				$output .= '>';
                $output .= '<div class="bg-video-overlay '.$overlay_style.sanitize_html_classes($uniqid_class).'"></div>';
                $output .= '</div>';

				wp_enqueue_script('jquery-vide');
			} else {
				$output .= '<div class="player" data-property="{videoURL:\'' . $video_url . '\',containment:\'#home\',autoPlay:' . $autoplay . ', showControls:true, showYTLogo: false, mute:' . $sound . ', startAt:0, opacity:1}">';
				$output .= '</div>';

				wp_enqueue_script('mb-YTPlayer');
			}
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'full_height_video_with_scroll':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class). $class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full container">';

			if ($video_source == 'self_hosted_video') {
				$output .= '<div class="bg-video-wrapper"';
				$output .= 'data-poster="'.esc_url($poster).'"';
				$output .= 'data-mp4="'.esc_url($video_url_mp4).'"';
				$output .= 'data-ogv="'.esc_url($video_url_ogv).'"';
				$output .= 'data-webm="'.esc_url($video_url_webm).'"';
				$output .= 'data-poster-type="'.esc_attr($poster_type).'"';
				$output .= 'data-muted="'.esc_attr($sound).'"';
				$output .= 'data-autoplay="'.esc_attr($autoplay).'"';
				$output .= '>';
                $output .= '<div class="bg-video-overlay '.$overlay_style.sanitize_html_classes($uniqid_class).'"></div>';
                $output .= '</div>';

				wp_enqueue_script('jquery-vide');
			} else {
				wp_enqueue_script('mb-YTPlayer');
				$output .= '<div class="player" data-property="{videoURL:\'' . $video_url . '\',containment:\'#home\',autoPlay:' . $autoplay . ', showControls:true, showYTLogo: false, mute:' . $sound . ', startAt:0, opacity:1}">';
				$output .= '</div>';

			}

			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			
			if ( $mode == 'presto' ) {

				$output .= '<h1 class="hs-line-18"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
				$output .= '<h2 class="hs-line-19"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';
				
				if (!empty($btn_text)) {
					$output .= '<div class="local-scroll"><a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-w btn-round btn-large btn-large-alt">' . esc_html($btn_text) . '</a></div';
				}
				
			} else {
				$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
				$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>';
				$output .= '<span class="text-rotate">' . esc_html($big_heading) . '</span>';
				$output .= '</h2>';

				if (!empty($btn_text_2) || !empty($btn_text)):
					$output .= '<div class="local-scroll">';
					if (!empty($btn_text)):
						$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
					endif;
					$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
					if (!empty($btn_text_2)):
						$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
					endif;
					$output .= '</div>';
				endif;
			
			}

			$output .= '</div>';
			$output .= '</div>';
			if ( $mode == 'presto' ) { 
				$output .= '<div class="local-scroll">';
				$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down scroll-down-style2"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
				$output .= '</div>';
			}
			else {
				$output .= '<div class="local-scroll">';
				$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</section>';

			wp_enqueue_script('jquery-simple-text-rotator');

			break;

		case 'alt_full_height_video_with_scroll':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class). $class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full container">';

			if ($video_source == 'self_hosted_video') {
				$output .= '<div class="bg-video-wrapper"';
				$output .= 'data-poster="'.esc_url($poster).'"';
				$output .= 'data-mp4="'.esc_url($video_url_mp4).'"';
				$output .= 'data-ogv="'.esc_url($video_url_ogv).'"';
				$output .= 'data-webm="'.esc_url($video_url_webm).'"';
				$output .= 'data-poster-type="'.esc_attr($poster_type).'"';
				$output .= 'data-muted="'.esc_attr($sound).'"';
				$output .= 'data-autoplay="'.esc_attr($autoplay).'"';
				$output .= '>';
                $output .= '<div class="bg-video-overlay '.$overlay_style.sanitize_html_classes($uniqid_class).'"></div>';
                $output .= '</div>';

				wp_enqueue_script('jquery-vide');
			} else {
				wp_enqueue_script('mb-YTPlayer');
				$output .= '<div class="player" data-property="{videoURL:\'' . $video_url . '\',containment:\'#home\',autoPlay:' . $autoplay . ', showControls:true, showYTLogo: false, mute:' . $sound . ', startAt:0, opacity:1}">';
				$output .= '</div>';

			}

			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_big_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h1>';
			$output .= '<h2 class="' . $d_small_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h2>';
			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';

			wp_enqueue_script('jquery-simple-text-rotator');

			break;

		case 'bigger_with_buttons':

			$output = '<section ' . $id . ' class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 fixed-height-small' . $class . '" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-parent container">';
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'bigger_with_video':

			$output = '<section ' . $id . ' class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' fixed-height-small' . $class . '" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-parent container">';
			if ($video_source == 'self_hosted_video') {
				$output .= '<div class="bg-video-wrapper"';
				$output .= 'data-poster="'.esc_url($poster).'"';
				$output .= 'data-mp4="'.esc_url($video_url_mp4).'"';
				$output .= 'data-ogv="'.esc_url($video_url_ogv).'"';
				$output .= 'data-webm="'.esc_url($video_url_webm).'"';
				$output .= 'data-poster-type="'.esc_attr($poster_type).'"';
				$output .= 'data-muted="'.esc_attr($sound).'"';
				$output .= 'data-autoplay="'.esc_attr($autoplay).'"';
				$output .= '>';
                $output .= '<div class="bg-video-overlay '.$overlay_style.sanitize_html_classes($uniqid_class).'"></div>';
                $output .= '</div>';

				wp_enqueue_script('jquery-vide');
			} else {
				$output .= '<div class="player" data-property="{videoURL:\'' . $video_url . '\',containment:\'#home\',autoPlay:' . $autoplay . ', showControls:true, showYTLogo: false, mute:' . $sound . ', startAt:0, opacity:1}">';
				$output .= '</div>';

				wp_enqueue_script('mb-YTPlayer');
			}
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'bigger_with_video_no_buttons':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' fixed-height-small '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-parent container">';
			if ($video_source == 'self_hosted_video') {
				$output .= '<div class="bg-video-wrapper"';
				$output .= 'data-poster="'.esc_url($poster).'"';
				$output .= 'data-mp4="'.esc_url($video_url_mp4).'"';
				$output .= 'data-ogv="'.esc_url($video_url_ogv).'"';
				$output .= 'data-webm="'.esc_url($video_url_webm).'"';
				$output .= 'data-poster-type="'.esc_attr($poster_type).'"';
				$output .= 'data-muted="'.esc_attr($sound).'"';
				$output .= 'data-autoplay="'.esc_attr($autoplay).'"';
				$output .= '>';
                $output .= '<div class="bg-video-overlay '.$overlay_style.sanitize_html_classes($uniqid_class).'"></div>';
                $output .= '</div>';

				wp_enqueue_script('jquery-vide');
			} else {
				$output .= '<div class="player" data-property="{videoURL:\'' . $video_url . '\',containment:\'#home\',autoPlay:' . $autoplay . ', showControls:true, showYTLogo: false, mute:' . $sound . ', startAt:0, opacity:1}">';
				$output .= '</div>';

				wp_enqueue_script('mb-YTPlayer');
			}
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'banner_with_text_rotator':
			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full">';
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' mb-50 mb-xs-30">';
			$output .= '<span class="text-rotate"' . $el_big_heading . '>' . esc_html($big_heading) . '</span>';
			$output .= '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';

			wp_enqueue_script('jquery-simple-text-rotator');

			break;

		case 'banner_with_image_rotator':

			$output = '<div ' . $id . ' class="bg-dark relative' . $class . '">';
			$output .= '<div class="fullwidth-gallery" '.$slide_speed.$autoplay_speed.'>';

			if (!empty($background)) {
				$images = explode(',', $background);
				foreach ($images as $image) {
					$image_src = wp_get_attachment_image_src($image, 'full');
					$output .= '<section class="home-section bg-scroll ' . $overlay_style . sanitize_html_classes($uniqid_class).'" data-background="' . esc_attr($image_src[0]) . '">';
					$output .= '<div class="js-height-full">';
					$output .= '</div>';
					$output .= '</section>';
				}
			}

			$output .= '</div>';
			$output .= '<div class="js-height-full fullwidth-galley-content">';
			$output .= '<div class="home-content container">';
			$output .= '<div class="home-text">';
			
			if ( is_numeric( $img_heading ) && !empty( $img_heading ) ) {
				$image_src = wp_get_attachment_image_src( $img_heading, 'full' );
				
				$output .= '<div class="container">';
					$output .= '<div class="row mb-30 mb-sm-20">';
						$output .= '<div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">';
							$output .= '<img src="' . esc_url( $image_src[0] ) . '" alt="" />';
						$output .= '</div>';
					$output .= '</div>';
					
					if ( ! empty( $img_caption ) ) {
						$output .= '<h2 class="hs-line-3 mb-0" ' . $el_img_caption . '>' . esc_html( $img_caption ) . '</h2>';
					}
					
				$output .= '</div>';
				
			}
			
			if ( ! empty( $small_heading ) ) {
				$output .= '<div class="' . $d_small_heading_font_size . ' no-transp font-alt mb-40 mb-xs-20"' . $el_small_heading . '>' . esc_html($small_heading) . '</div>';
			}
			
			if ( ! empty( $big_heading ) ) {
				$output .= '<div class="' . $d_big_heading_font_size . ' mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</div>';
			}

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' mb-xxs-10 hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border-w btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

			wp_enqueue_script('owl-carousel');

			break;

		case 'full_height_with_no_buttons':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full">';
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_big_heading_font_size . ' font-alt '.( $big_heading_margin ? sanitize_html_classes( $big_heading_margin ) : 'mb-80 mb-xs-30 mt-50 mt-sm-0' ).'"' . $el_big_heading . '>' . esc_html($big_heading) . '</h1>';
			$output .= '<div class="' . $d_small_heading_font_size . '"' . $el_small_heading . '>' . esc_html($small_heading) . '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'full_height_with_solid_buttons':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full">';
						$output .= '<div class="home-content container">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-w ' . $btn_size . ' ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				if ( ! empty($btn_text_2 ) ):
					$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-w  ' . $btn_size . ' ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'full_height_with_solid_button':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full">';
			
			$output .= '<div class="home-content container">';
			$output .= '<div class="home-text">';
			
			if ( $d_small_heading_font_size == 'hs-line-18' ) {
				$output .= '<h1 class="' . $d_small_heading_font_size . '"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			} else {
				$output .= '<h1 class="' . $d_small_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			}
			if ( $d_big_heading_font_size == 'hs-line-19' ) {
				$output .= '<h2 class="' . $d_big_heading_font_size . '"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';
			} else {						
				$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';
			}

			if (!empty($btn_text)):
				$output .= '<div class="local-scroll">';
				$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-w ' . $btn_size . ' ' . $btn_style . ' ' . $lightbox . ' ' . $btn_class . '">' . esc_html($btn_text) . '</a> ';
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			if (!empty($href_s) && $href_s != '#' ) {
				$output .= '<div class="local-scroll">';
				$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</section>';
			break;
			
		case 'full_height_with_bottom_content':
			
			$output = '<section class="home-section bg-scroll bg-dark ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full container">';
			
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text aligned-bottom">';
			$output .= '<div class="home-text-inner bt-light-transparent">';
			$output .= '<div class="row">';

			$output .= '<div class="col-md-6">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' mb-10 align-left">' . esc_html( $small_heading ) . '</h1>';
			if ( ! empty ( $text_rotate ) ) {
				$output .= '<h2 class="hs-line-20 mt-0 mb-0 align-left">' . wp_kses_post( $big_heading ) . ' <strong class="text-rotate"> ' . esc_html( $text_rotate ) . '</strong></h2>';
			} else {
				$output .= '<h2 class="hs-line-20 mt-0 mb-0 align-left">' . wp_kses_post( $big_heading ) . '</h2>';
			}
			$output .= '</div><!-- /.col-md-6 -->';
							
			$output .= '<div class="col-md-6">';
			$output .= '<div class="local-scroll right">';
			$output .= '<a href="' . esc_url( $href ) . '" class="btn btn-mod ' . $btn_size . ' ' . $btn_style . ' ' . $lightbox . ' ' . $btn_class . '">' . esc_html( $btn_text ) . '</a>';
			$output .= '</div>';
			$output .= '</div><!-- /.col-md-6 -->';

			$output .= '</div><!-- /.row -->';
			$output .= '</div><!-- /.home-text-inner -->';
			$output .= '</div>';
			$output .= '</div><!-- End Hero Content -->';
			
			$output .= '</div>';
			$output .= '</section>';
			
			wp_enqueue_script('jquery-simple-text-rotator');
			break;	
		
		case 'banner_with_image_and_text':

			$output .= '<div class="js-height-full">';
			$output .= '<div class="home-content container">';
			$output .= '<div class="home-text">';

			$output .= '<div class="row">';
			
			$output .= '<div class="col-md-4 col-md-offset-1 align-center pt-20 mb-sm-50">';
			$output .= '<img src="'.esc_url($image_src[0]).'" class="hidden-sm hidden-xs" style="max-width:230px" />';
			$output .= '</div>';
			
			$output .= '<div class="col-md-7 align-left">';
			
			$output .= '<h1 class="' . $d_small_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod ' . $btn_size . ' ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod  ' . $btn_size . ' ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;
			
			$output .= '</div>';
			$output .= '</div>';

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

			break;	

		case 'banner_with_dark_buttons':

			$output = '<section class="home-section bg-gray parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full">';
			$output .= '<div class="home-content container">';
			$output .= '<div class="home-text">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-medium ' . $btn_style . ' hidden-xs' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="local-scroll">';
			$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			break;

		case 'banner_with_play_button':

			$output = '<section class="home-section ' . $overlay_style . sanitize_html_classes($uniqid_class).' parallax-2 '.$class.'" ' . $data_background . ' id="home">';
			$output .= '<div class="js-height-full container">';
			$output .= '<div class="home-content">';
			$output .= '<div class="home-text">';
			$output .= '<div>';
			if ( $mode == 'presto' ) {
				$output .= '<a href="' . esc_url($video_url) . '" class="big-icon-link blue lightbox-gallery-1 mfp-iframe"><span class="big-icon size-bigger blue"><i class="fa fa-play"></i></span></a>';
			} else {
				$output .= '<a href="' . esc_url($video_url) . '" class="big-icon-link lightbox-gallery-1 mfp-iframe"><span class="big-icon"><i class="fa fa-play"></i></span></a>';
			}
			$output .= '</div>';
			if ( $mode == 'presto' ) {
				$output .= '<h1 class="hs-line-16 mb-35 mb-xs-20"' . $el_big_heading . '>' . wp_kses_post( $big_heading ) . '</h1>';
				$output .= '<h2 class="hs-line-17"' . $el_small_heading . '>' . esc_html($small_heading) . '</h2>';
			} else {
				$output .= '<h1 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-20"' . $el_big_heading . '>' . esc_html($big_heading) . '</h1>';
				$output .= '<h2 class="' . $d_small_heading_font_size . ' no-transp font-alt"' . $el_small_heading . '>' . esc_html($small_heading) . '</h2>';				
			}
			
			$output .= '</div>';
			$output .= '</div>';
			if ( $mode != 'presto' ) {
				$output .= '<div class="local-scroll">';
				$output .= '<a href="' . esc_url($href_s) . '" title="' . esc_attr($title_s) . '" target="' . esc_attr($target_s) . '" class="scroll-down ' . sanitize_html_class( $scroll_down_style ) . '"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</section>';
			break;

    case 'banner_without_background_image':
      $left_part = $right_part = '';
      if(stripos('|', $link_text) === false) {
        $break_text = explode('|', $link_text);
        $left_part = $break_text[0];
        $right_part = $break_text[1];
      }
      $output  = '<div class="align-center">';
      $output .=  '<h1 class="'.$d_small_heading_font_size.' no-transp font-alt mb-40 mb-xs-20"'.$el_small_heading.'>'.esc_html($small_heading).'</h1>';
      $output .=  '<h2 class="'.$d_big_heading_font_size.' black font-alt"'.$el_big_heading.'>'.esc_html($big_heading).'</h2>';
      if(!empty($link_text)) {
        $output .=  '<div>';
        $output .=  '<a href="'.esc_url($vim_video_url).'" class="play-video-link font-alt lightbox-gallery-1 mfp-iframe">'.esc_html($left_part).' <i class="fa fa-3x fa-play-circle"></i> '.esc_html($right_part).'</a>';
        $output .=  '</div>';
      }
      $output .=  '</div>';

      break;

    case 'banner_with_form':
      $output  =  '<div class="relative"'.$class.' '.$id.'>';
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-md-10 col-md-offset-1">';
      $output .=  '<div class="align-center">';
      $output .=  '<h1 class="'.$d_small_heading_font_size.' no-transp font-alt mb-40 mb-xs-20"'.$el_small_heading.'>'.esc_html($small_heading).'</h1>';
      $output .=  '<h2 class="'.$d_big_heading_font_size.' font-alt"'.$el_big_heading.'>'.esc_html($big_heading).'</h2>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '<div class="relative bg-dark-alfa-50 mt-60 pt-80 pt-xs-30 pb-70 pb-xs-20">';
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-sm-10 col-sm-offset-1">';
      $output .=  '<div class="banner-form form contact-form">';
      $output .=  '<div class="row">';
      $output .=  do_shortcode('[contact-form-7 id="'.$form_id.'"]');
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';

      break;

    case 'banner_slider_with_thumbnail':
      $output  = '<div class="home-section fullwidth-slideshow black-arrows bg-dark '.$class.'">';
      if (!empty($background)) {
        $images = explode(',', $background);
        foreach ($images as $image) {
          $image_src = wp_get_attachment_image_src($image, 'full');
          $output .=  '<section class="home-section bg-scroll bg-dark" data-background="'.esc_url($image_src[0]).'">';
          $output .=  '<div class="js-height-full container">';
          $output .=  '</div>';
          $output .=  '</section>';
        }
      }
      $output .=  '</div>';
      $output .=  '<div class="fullwidth-slideshow-pager-wrap">';
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-md-8 col-md-offset-2">';
      $output .=  '<div class="fullwidth-slideshow-pager">';
      if (!empty($background)) {
        $images = explode(',', $background);
        foreach ($images as $image) {
          $image_src = wp_get_attachment_image_src($image, 'ts-horizontal-thumb');
          $output .=  '<div class="fsp-item">';
          $output .=  '<img src="'.esc_url($image_src[0]).'" alt="" />';
          $output .=  '</div>';
        }
      }
      $output .=  '</div></div></div></div></div>';
      wp_enqueue_script('owl-carousel');
      break;

		case 'bigger_with_buttons_white':
		default:

			$output = '<section ' . $id . ' class="page-section' . $class . '" id="home">';
			$output .= '<div class="relative container">';
			$output .= '<div class="align-center">';
			$output .= '<h1 class="' . $d_small_heading_font_size . ' no-transp font-alt mb-50 mb-xs-30"' . $el_small_heading . '>' . esc_html($small_heading) . '</h1>';
			$output .= '<h2 class="' . $d_big_heading_font_size . ' font-alt mb-50 mb-xs-30"' . $el_big_heading . '>' . esc_html($big_heading) . '</h2>';

			if (!empty($btn_text_2) || !empty($btn_text)):
				$output .= '<div class="local-scroll">';
				if (!empty($btn_text)):
					$output .= '<a href="' . esc_url($href) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target) . '" class="btn btn-mod btn-border btn-medium ' . $btn_style . ' hidden-xs ' . $lightbox . '">' . esc_html($btn_text) . '</a> ';
				endif;
				$output .= '<span class="hidden-xs">&nbsp;&nbsp;</span>';
				if (!empty($btn_text_2)):
					$output .= '<a href="' . esc_url($href_2) . '" title="' . esc_attr($title_2) . '" target="' . esc_attr($target_2) . '" class="btn btn-mod btn-border btn-medium ' . $btn_style . ' ' . $lightbox_2 . '">' . esc_html($btn_text_2) . '</a>';
				endif;
				$output .= '</div>';
			endif;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';

			break;
	}

	wp_enqueue_script('jquery-magnific-popup');

	return $output;
}

add_shortcode('rs_banner', 'rs_banner');
