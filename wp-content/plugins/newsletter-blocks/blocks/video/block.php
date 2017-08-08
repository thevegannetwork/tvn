<?php
/*
 * Name: Video
 * Section: content
 * Description: Embed a video from YouTube
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */

require_once ABSPATH . 'wp-includes/class-oembed.php';

if (!empty($options['url'])) {
    $wp_oembed = new WP_oEmbed();
    $provider = $wp_oembed->get_provider($options['url']);
    //var_dump($provider);

    if ($provider) {
        $response = wp_remote_get($provider . '?url=' . urlencode($options['url']));
        if (!is_wp_error($response)) {
            $data = json_decode(wp_remote_retrieve_body($response));
            if (isset($data->thumbnail_url_with_play_button)) {
                $src = $data->thumbnail_url_with_play_button;
                $show_play = false;
            } else {
                $src = $data->thumbnail_url;
                $show_play = true;
            }
            $link = $options['url'];
        }
    }
}

if (!isset($src)) {
    $src = plugins_url('newsletter-blocks') . '/blocks/video/images/placeholder.jpg';
    $link = '#';
}
?>
<style>
    .img {
        max-width: 100%!important;
    }
</style>

<table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
        <td>
            <p>&nbsp;</p>
            <a href="<?php echo esc_attr($options['url']) ?>" target="_blank" style="display: block; line-height: 0">
                <img class="img" src="<?php echo esc_attr($src) ?>" style="display: block;">
            </a>
        </td>
    </tr>
    <?php if ($show_play) { ?>
    <tr>
        <td align="center" style="background-color: black">
            <a href="<?php echo esc_attr($options['url']) ?>" target="_blank">
                <img class="img" src="<?php echo plugins_url('newsletter-blocks') . '/blocks/video/images/play.png' ?>">
            </a>
        </td>
    </tr>
    <?php } ?>
</table>
