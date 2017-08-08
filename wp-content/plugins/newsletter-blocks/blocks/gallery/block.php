<?php
/*
 * Name: Gallery
 * Section: content
 * Description: Extract an embed all the media from a post gallery
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */
?>
<style>
    .gallery-medium-img {
        max-width: 100%!important;
        width: 280px!important;
    }

</style>


<?php if (!empty($options)) { ?>
    <?php if ($options['layout'] == 1) { ?>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td align="center" style="text-align: center">
                    <?php for ($i = 1; $i <= 8; $i++) { ?>
                        <?php
                        if (empty($options['image_' . $i]['id'])) {
                            continue;
                        }
                        $media = wp_get_attachment_image_src($options['image_' . $i]['id'], 'thumbnail');
                        if ($media === false)
                            continue;
                        $src = $media[0];
                        ?>
                        <span class="tnpc-row-edit gallery-thumbnail-img" data-type="image" style="display: inline-block;">
                            <a href="<?php echo $options['url'] ?>" target="_blank"><img src="<?php echo esc_attr($src) ?>"></a>
                        </span>
                    <?php } ?>
                </td>
            </tr>
        </table>
    <?php } ?>

    <?php if ($options['layout'] == 2) { ?>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td align="center" style="text-align: center">

                    <?php for ($i = 1; $i <= 8; $i++) { ?>
                        <?php
                        if (empty($options['image_' . $i]['id'])) {
                            continue;
                        }
                        if ($media === false)
                            continue;
                        $media = wp_get_attachment_image_src($options['image_' . $i]['id'], 'medium');
                        $src = $media[0];
                        ?>
                        <div class="gallery-medium tnpc-row-edit" data-type="image">
                            <a href="<?php echo $options['url'] ?>" target="_blank"><img class="gallery-medium-img" src="<?php echo esc_attr($src) ?>"></a>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        </table>
    <?php } ?>



<?php } else { ?>

    <div style="text-align: center">
        <img style="max-width: 100%" src="<?php echo plugins_url('newsletter-blocks') . '/blocks/gallery/images/placeholder.png' ?>">
    </div>

<?php } ?>
