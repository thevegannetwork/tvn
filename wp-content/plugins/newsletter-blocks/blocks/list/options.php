<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
?>

<table class="form-table">
    <tr>
        <th>Bullet</th>
        <td>
            <?php
            $bullets = array();
            $url = plugins_url('newsletter-blocks') . '/blocks/list/images/';
            for ($i=1; $i<=20; $i++) {
            $bullets["$i"] = array('label'=>'Bullet ' . $i, 'image'=>$url . 'bullet-' . $i . '.png');
            }
            
                $controls->select_images('bullet', $bullets);
            ?>
        </td>
    </tr>
    <tr>
        <th>Items</th>
        <td>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                $controls->text('text_' . $i, 50);
            }
            ?>
        </td>
    </tr>
</table>
