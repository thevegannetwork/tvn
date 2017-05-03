<?php
/**
 *
 * RS Team
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_team( $atts, $content = '', $id = '' ) {

  global $wp_query, $post;

  extract( shortcode_atts( array(
    'id'                 => '',
    'class'              => '',
    'style'              => '',
    'person_id'          => 0,
    'animation'          => '',
    'animation_delay'    => '',
    'animation_duration' => '',

  ), $atts ) );

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. $class : '';

  $animation          = ( $animation ) ? ' wow '. sanitize_html_classes($animation) : '';
  $animation_duration = ( $animation_duration ) ? ' data-wow-duration="'.esc_attr($animation_duration).'s"':'';
  $animation_delay    = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';

	if (function_exists('icl_object_id')) {
		$person_id = icl_object_id( $person_id, 'post', false, ICL_LANGUAGE_CODE );
	}

	$args = array(
		'post_type'      => 'team',
		'posts_per_page' => 1,
		'post__in'       => explode( ',', $person_id ),
	);

  $tmp_query  = $wp_query;
  $wp_query   = new WP_Query( $args );

  ob_start();

  while( have_posts() ) : the_post();

  // get the meta values
  $team_position  = ts_get_post_opt('team-position');
  $team_header    = ts_get_post_opt('team-header');
  $team_facebook  = ts_get_post_opt('team-facebook');
  $team_twitter   = ts_get_post_opt('team-twitter');
  $team_pinterest = ts_get_post_opt('team-pinterest');


switch ( $style ) {
	
	case 'presto': ?>

<div <?php echo $id; ?> class="team-item <?php echo sanitize_html_classes($animation); ?><?php echo sanitize_html_classes($class); ?>"<?php echo $animation_duration; ?><?php echo $animation_delay; ?>>
    <?php if(has_post_thumbnail()): ?>
    <div class="team-item-image team-item-image-style2">
      <?php the_post_thumbnail('ts-vertical'); ?>
        <div class="team-item-detail team-item-detail-style2">

            <h4 class="normal"><?php echo esc_html($team_header); ?></h4>

            <?php the_content(); ?>

            <?php if(!empty($team_facebook) || !empty($team_twitter) || !empty($team_pinterest)) : ?>
            <div class="team-social-links team-social-links-style2 brand-bg">
                <?php if(!empty($team_facebook)): ?>
                  <a href="<?php echo esc_url($team_facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                <?php endif; ?>
                <?php if(!empty($team_twitter)): ?>
                  <a href="<?php echo esc_url($team_twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                <?php endif;?>
                <?php if(!empty($team_pinterest)): ?>
                  <a href="<?php echo esc_url($team_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>

    <div class="team-item-descr">

        <div class="team-item-name team-item-name-style2">
            <?php the_title(); ?>
        </div>

        <div class="team-item-role team-item-role-style2">
            <?php echo esc_html($team_position); ?>
        </div>

    </div>
  </div>
	
	
<?php	
	
	break;
	default:
  ?>

<div <?php echo $id; ?> class="team-item <?php echo sanitize_html_classes($animation); ?><?php echo sanitize_html_classes($class); ?>"<?php echo $animation_duration; ?><?php echo $animation_delay; ?>>
    <?php if(has_post_thumbnail()): ?>
    <div class="team-item-image">
      <?php the_post_thumbnail('ts-vertical'); ?>
        <div class="team-item-detail">

            <h4 class="font-alt normal"><?php echo esc_html($team_header); ?></h4>

            <?php the_content(); ?>

            <?php if(!empty($team_facebook) || !empty($team_twitter) || !empty($team_pinterest)) : ?>
            <div class="team-social-links">
                <?php if(!empty($team_facebook)): ?>
                  <a href="<?php echo esc_url($team_facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                <?php endif; ?>
                <?php if(!empty($team_twitter)): ?>
                  <a href="<?php echo esc_url($team_twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                <?php endif;?>
                <?php if(!empty($team_pinterest)): ?>
                  <a href="<?php echo esc_url($team_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>

    <div class="team-item-descr font-alt">

        <div class="team-item-name">
            <?php the_title(); ?>
        </div>

        <div class="team-item-role">
            <?php echo esc_html($team_position); ?>
        </div>

    </div>
  </div>


  <?php
	  
	}  

  endwhile;
  wp_reset_query();
  wp_reset_postdata();
  $wp_query = $tmp_query;

  $output = ob_get_clean();

  return $output;

}
add_shortcode('rs_team', 'rs_team');
