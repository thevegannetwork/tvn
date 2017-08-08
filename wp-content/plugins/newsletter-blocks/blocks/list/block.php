<?php
/*
 * Name: List
 * Section: content
 * Description: A well designed list for your strength points
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */

require_once ABSPATH . 'wp-includes/class-oembed.php';

if (empty($options)) {
    $options['bullet'] = '1';
    $options['text_1'] = 'Element 1';
    $options['text_2'] = 'Element 2';
    $options['text_3'] = 'Element 3';
}
?>
<style>
    .img {
        max-width: 100%;
    }
    .list-text {
        font-size: 17px;
        color: #777;
    }
</style>

<table cellspacing="0" cellpadding="10" border="0" style="width: 100%" width="100%">
    <tr>
        <td>
            <br><br>
            <table cellspacing="0" cellpadding="3" align="center">
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    if (empty($options['text_' . $i])) {
                        continue;
                    }
                    echo '<tr>';
                    echo '<td width="32"><img style="width:15px;" src="', plugins_url('newsletter-blocks'), '/blocks/list/images/bullet-', $options['bullet'], '.png"></td>';
                    echo '<td class="list-text"><span class="mobile">', $options['text_' . $i], '</span></td>';
                    echo '</td></tr>';
                }
                ?>
            </table>

        </td>
    </tr>
</table>

