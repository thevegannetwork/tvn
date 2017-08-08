<?php
/*
 * Name: A single full post
 * Section: content
 * Description: Use the full content of post
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */

function tnp_gallery_shortcode($atts) {
    global $post;
    $buffer = '<div style="text-align: center" class="single-post-gallery">';
    if (isset($atts['ids'])) {
        $ids = explode(',', $atts['ids']);
        foreach ($ids as $id) {
            $src = wp_get_attachment_image_src($id, 'thumbnail');
            $buffer .= '<img src="' . $src[0] . '"> ';
        }
    } else {
        $attachments = get_children(array('post_parent' => $options['post'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order'));
        if (!empty($attachments)) {
            foreach ($attachments as $id => &$attachment) {
                $src = wp_get_attachment_image_src($id, 'thumbnail');
                if (!$src) {
                    continue;
                }
                $buffer .= '<img src="' . $src[0] . '"> ';
            }
        }
    }

    $buffer .= '</div>';
    return $buffer;
}
?>
<style>
    .paragraph {
        text-align: left;
        font-size: 16px; 
        line-height: 25px; 
        color: #666666;
        font-family: Helvetica, Arial, sans-serif;
    }
</style>

<?php if (!empty($options['post'])) { ?>

    <?php
    $post = get_post($options['post']);
    $content = $post->post_content;
    $content = wpautop($content);
    if (true || $options['enable shortcodes']) {
        remove_shortcode('gallery');
        add_shortcode('gallery', 'tnp_gallery_shortcode');
        $content = do_shortcode($content);
    }
    $content = str_replace('<p>', '<p class="paragraph">', $content);
    ?>

<div style="padding:20px;">
    <h1 class="tnpc-row-edit" data-type="title" style="font-size: 25px; color: #333333; padding-top: 30px; font-family: Helvetica, Arial, sans-serif;"><?php echo $post->post_title ?></h1>
    <div class="tnpc-row-edit" data-type="text"><?php echo $content ?></div>
</div>

<?php } else { ?>

    <h1 class="title">Select a post on block options</h1>
    <p>Dummy text</p>

<?php } ?>
