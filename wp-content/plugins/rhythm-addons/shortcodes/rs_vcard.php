<?php
/**
 *
 * RS vcard
 * @version 1.0.0
 *
 *
 */
function rs_sc_vcard( $atts, $content = '', $id = '' ) {
	extract(shortcode_atts(array(
		'id'               => '',
		'class'            => '',
		'image'            => '',
		'name'             => '',
		'position'         => '',
		
		//colors
		'name_color'       => '',
		'position_color'   => '',

		
	), $atts));

	$id    = ( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes( $class ) : '';
	
	$name_style = '';
	if (! empty( $name_color ) ){
		$name_style = 'style=color:' . esc_attr( $name_color ) . '';
	}

	$position_style = '';
	if (! empty( $position_color ) ){
		$position_style = 'style=color:' . esc_attr( $position_color ) . '';
	}

	ob_start();

	$image_url = '';
	if (is_numeric($image) && !empty($image)) {
		$image_src = wp_get_attachment_image_src($image, 'full');
		if (isset($image_src[0])) {
			$image_url = esc_url($image_src[0]);
		}
	}

?>
<div class="relative container">

<!-- Hero Content -->
<div class="home-content">
	<div class="home-text">
		<div class="row mt-60 mt-xs-20">
			<div class="col-sm-6 col-lg-5 align-center pt-20 pt-lg-0 mb-xs-30">
				<div class="hs-line-4 font-alt mb-20" <?php echo esc_attr( $name_style ); ?>><?php echo esc_html( $name ); ?></div>
				<h1 class="hs-line-15 font-alt mb-40 mb-xs-20" <?php echo esc_attr( $position_style ); ?>><?php echo esc_html( $position ); ?></h1>
				<?php echo do_shortcode( $content ); ?>
			</div>
			
			<div class="col-sm-6 col-lg-offset-1">
				<img src="<?php echo esc_url($image_url);?>" alt=""/>
			</div>
		
		</div>
	</div>
</div>
<!-- End Hero Content -->

</div>
<?php

	$output = ob_get_clean();
	return $output;
}


add_shortcode('rs_vcard', 'rs_sc_vcard');