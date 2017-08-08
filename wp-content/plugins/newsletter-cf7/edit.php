<?php
defined('ABSPATH') || exit;
global $controls;
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$module = NewsletterCF7::$instance;
$controls = new NewsletterControls();

$form_id = (int) $_GET['id'];

if (!$controls->is_action()) {
    $controls->data = get_option('newsletter_cf7_' . $form_id, array());
} else {
    if ($controls->is_action('save')) {
        add_option('newsletter_cf7_' . $form_id, array(), '', 'no');
        update_option('newsletter_cf7_' . $form_id, $controls->data);
        $controls->messages = 'Saved.';
    }
}

$form = WPCF7_ContactForm::get_instance($form_id);
$form_fields = $form->form_scan_shortcode();
$fields = array();
foreach ($form_fields as $form_field) {
    $field_name = str_replace('[]', '', $form_field['name']);
    if (empty($field_name))
        continue;
    $fields[$field_name] = $field_name;
}
?>

<style>
    /* To be used when a field cell is a grid of labels and values */
    .form-table table {
        border-collapse: collapse;
    }
    
    .form-table table td, .form-table table th {
        padding: 5px;
        font-size: .9em;
        font-weight: normal;
        border: 1px solid #eee;
    }
    
    .form-table table thead th {
        text-align: left;
        font-weight: bold;
    }
</style>

<div class="wrap" id="tnp-wrap">
    <?php @include NEWSLETTER_DIR . '/tnp-header.php' ?>

    <div id="tnp-heading">
        <h2>Form "<?php echo esc_html($form->title()) ?>" linking</h2>

        <p>
            See the <a href="http://www.thenewsletterplugin.com/plugins/newsletter/contact-form-7-extension" target="_blank">official documentation</a>
            to correctly configure your Contact Form 7 forms.
        </p>
    </div>

    <?php $controls->show(); ?>

    <div id="tnp-body">
        <form action="" method="post">
            <?php $controls->init(); ?>
            <p>    
                <?php $controls->button('save', __('Save', 'newsletter')); ?> <a href="?page=newsletter_cf7_index" class="button-secondary">Back</a>
            </p>


            <table class="form-table">
                <tr valign="top">
                    <th>Email field</th>
                    <td>
                        <?php $controls->select('email', $fields, 'Select...'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th>Subscription checkbox field</th>
                    <td>
                        <?php $controls->select('newsletter', $fields, 'Select...'); ?>
                        <p class="description">
                            Add a checkbox type field in the form to be used as subscription indicator for
                            example <code>[checkbox newsletter "Subscribe to my newsletter"]</code>.
                        </p>
                    </td>
                </tr>  
                <tr valign="top">
                    <th>First or full name field</th>
                    <td>
                        <?php $controls->select('name', $fields, 'Select...'); ?>
                    </td>
                </tr>  
                <tr valign="top">
                    <th>Last name field</th>
                    <td>
                        <?php $controls->select('surname', $fields, 'Select...'); ?>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th>Gender field</th>
                    <td>
                        <?php $controls->select('gender', $fields, 'Select...'); ?>
                        <p>Warning: the valued collected by CF7 must be "f" or "m". For example [select gender "Female|f" "Male|m"]</p>
                    </td>
                </tr>                

                <tr valign="top">
                    <th>Extra profile fields</th>
                    <td>
                        <?php
                        // Use an API for this
                        $options_profile = get_option('newsletter_profile');
                        ?>
                        <table style="width: auto">
                            <thead>
                                <tr>
                                    <th>
                                        Newsletter field
                                    </th>
                                    <th>
                                        CF7 field
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                for ($i = 1; $i <= NEWSLETTER_PROFILE_MAX; $i++) {
                                    if (empty($options_profile['profile_' . $i])) {
                                        continue;
                                    }
                                    echo '<tr><td>' . esc_html($options_profile['profile_' . $i]) . '</td><td>';

                                    $controls->select('profile_' . $i, $fields, 'Select...');
                                    echo '</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th>Add subscribers to these lists</th>
                    <td><?php $controls->preferences() ?></td>
                </tr>
            </table>
            <p>    
                <?php $controls->button('save', __('Save', 'newsletter')); ?> <a href="?page=newsletter_cf7_index" class="button-secondary">Back</a>
            </p>
        </form>
    </div>

    <?php @include NEWSLETTER_DIR . '/tnp-footer.php' ?>

</div>