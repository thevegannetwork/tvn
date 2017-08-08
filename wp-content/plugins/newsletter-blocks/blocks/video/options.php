<?php

/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */

?>

<p>
    Supported: Vimeo, YouTube, DailyMotion, TED and many other. The video cover size is force by the video
    provider. The video cover will be linked to the video page.
</p>
<table class="form-table">
    <tr>
    <th>Video URL</th>
    <td><?php $controls->text('url', 50) ?></td>
    </tr>
</table>
