<?php
defined('ABSPATH') || exit;

if (isset($_GET['subpage'])) {
    include __DIR__ . '/summary.php';
    return;
}

@include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = NewsletterGeo::$instance;



if ($controls->is_action('run')) {
    $result = $module->run(true);
    if (is_wp_error($result)) {
        $controls->errors .= $result->get_error_message();
    } else {
        $controls->messages .= 'Success (test IP resolved to ' . json_encode($result) . ')';
    }
}

if ($controls->is_action('run_now')) {
    $result = $module->run();
    $controls->messages .= 'Processed ' . $result . ' subscribers.';
}

if ($controls->is_action('reset')) {
    $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set country='', city='', region=''");
    $controls->messages = 'All geolocation reset.';
}

if ($controls->is_action('reset_unresolved')) {
    $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set country='', city='', region='' where country='XX'");
    $controls->messages = 'Unresolved subscribers reset.';
}
?>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>

    <div id="tnp-heading">

        <h2>Geolocation</h2>

    </div>

    <div id="tnp-body">

        <form method="post" action="">
            <?php $controls->init(); ?>

            <?php $controls->button_confirm('reset', 'Reset all data', 'Warning: all subscribers will be reprocessed!')?>
            <?php $controls->button('run', 'Run a test') ?>
            <?php $controls->button('run_now', 'Run now') ?>
            <a class="button-primary" href="?page=newsletter_geo_index&subpage=summary">Summary</a>
            
            <table class="form-table">
                <tr>
                    <th>Geolocation last run</th>
                    <td>
                        <?php echo $controls->print_date($module->get_last_run()); ?>
                        <p class="description">
                            The country detection finds the countries from which the users subscribed (visible on user statistic panel) and
                            the countries from ehich the single newsletters have been read.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>Geolocation next run</th>
                    <td>
                        <?php echo $controls->print_date(wp_next_scheduled('newsletter_geo_run')); ?> 

                    </td>
                </tr>
                <tr>
                    <th>Country detection data</th>
                    <td>
                        Subscribers to be processed: <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where ip<>'' and country=''"); ?>
                        <br>
                        Subscribers resolved: <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where ip<>'' and country<>'' and country<>'XX'"); ?>
                        <br>
                        Subscribers not resolvable: <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where ip<>'' and country='XX'"); ?>

                        <?php $controls->button_confirm('reset', 'Reset all data', 'Warning: all subscribers will be reprocessed!')?>
                        <?php $controls->button_confirm('reset_unresolved', 'Reset unresolved', 'Proceed?')?>
                        <p class="description">
                            Totals refer only to subscribers or statistic entries which have an IP address. Some may have not.
                        </p>
                    </td>
                </tr>            

            </table>

        </form>
    </div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>

</div>