<?php

/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */

?>

<p>
    Extract the full text from a post
</p>
<table class="form-table">
    <tr>
    <th>Post</th>
    <td><?php $controls->posts_select('post', 100) ?></td>
    </tr>
</table>
