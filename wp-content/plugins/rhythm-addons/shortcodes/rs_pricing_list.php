<?php

/**
 *
 * RS Promo Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_pricing_list($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'id'               => '',
    'class'            => '',
    'header'           => '',
  ), $atts));

  $id                        = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
  $class                     = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
  
  ob_start();
  ?>
  <table class="table table-hover pricing-list"> 
	  
	  <?php if ( ! empty( $header ) ) { ?>                                
      <thead>
          <tr>
              <th>
                  <?php echo esc_html($header); ?>
              </th>
              <th style="width:20%;"></th>
          </tr>
      </thead>
      <?php } ?>
      
      <tbody>
          <?php echo do_shortcode(wp_kses_data($content)); ?>
      </tbody>
  </table>
  <?php

  $output = ob_get_clean();
  return $output;
}

add_shortcode('rs_pricing_list', 'rs_pricing_list');

function rs_pricing_list_item($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'item' => '',
    'description' => '',
    'price' => '',
    
  ), $atts));


  ob_start();
  ?>
    <tr>
        <td>
            <?php echo wp_kses_data($item); ?>
            <div class="small">
                <?php echo wp_kses_data($description); ?>
            </div>
        </td>
        <td class="align-right">
            <?php echo esc_html($price); ?>
        </td>
    </tr>
  <?php

  $output = ob_get_clean();
  return $output;
}

add_shortcode('rs_pricing_list_item', 'rs_pricing_list_item');
