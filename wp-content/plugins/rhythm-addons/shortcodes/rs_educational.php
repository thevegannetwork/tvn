<?php
/**
 *
 * RS vcard
 * @version 1.0.0
 *
 *
 */
function rs_sc_educational( $atts, $content = '', $id = '' ) {
	extract(shortcode_atts(array(
		'id'                => '',
		'class'             => '',
		'years'             => '',
		'title'             => '',
		'institution'       => '',
		'style'             => '',
		'hide_hr'           => '',
		
		//colors
		'years_color'        => '',
		'title_color'       => '',
		'institution_color' => '',

		
	), $atts));

	$id    = ( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes( $class ) : '';
	
	$title_style = '';
	if (! empty( $title_color ) ){
		$title_style = 'style=color:' . esc_attr( $title_color ) . '';
	}

	$years_style = '';
	if (! empty( $years_color ) ){
		$years_style = 'style=color:' . esc_attr( $years_color ) . '';
	}
	
	$col_one = 'col-md-3';
	$col_two = 'col-md-9';
	
	if( 'large' === $style ) {
		$col_one = 'col-md-2';
		$col_two = 'col-md-10';
	}

	ob_start();

?>
<div class="row">
	<div class="<?php echo $col_one; ?> black" <?php echo esc_attr( $years_style ); ?>><?php echo esc_html( $years ); ?></div>
	<div class="<?php echo $col_two; ?>">
	<h4 class="mt-0 mb-0" <?php echo esc_attr( $title_style ); ?>><?php echo esc_html( $title); ?></h4>
		<?php echo esc_html( $institution ); ?>
	</div>
</div>
<?php if ( !$hide_hr ) { ?>
	<hr>
<?php } ?>
<?php

	$output = ob_get_clean();
	return $output;
}

add_shortcode('rs_educational', 'rs_sc_educational');