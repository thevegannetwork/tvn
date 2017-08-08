<?php
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
require_once dirname(__FILE__) . '/helper.php';

$module = NewsletterStatistics::instance();
$helper = new NewsletterStatisticsHelper();
$controls = new NewsletterControls();

wp_enqueue_script('tnp-chart');

$email_id = (int) $_GET['id'];
$email = $module->get_email($email_id);

$module->maybe_fix_sent_stats($email);
$module->update_stats($email);

$total_count = $module->get_total_count($email_id);
$open_count = $module->get_open_count($email_id);
$click_count = $module->get_click_count($email_id);
$error_count = $module->get_error_count($email_id);

//$events = $helper->aggregate_events_by_day($helper->get_events($email_id));
$open_events = $helper->get_open_events($email_id);
$click_events = $helper->get_click_events($email_id);
$unsub_count = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_USERS_TABLE . " where unsub_email_id=%d", $email->id));
?>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_DIR . '/tnp-header.php' ?>
    <div id="tnp-heading">
        <h2 class="">Newsletter Statistics</h2>

        <div class="tnp-statistics-general-box">
            <p><span class="tnp-statistics-general-title">Subject</span> "<?php echo esc_html($email->subject); ?>"</p>

            <?php if ($email->status != 'new') { ?>
            
            <p><span class="tnp-statistics-general-title">Status</span>
                <?php if ($email->status == 'sending'): ?>
                    Sending...
                <?php elseif ($email->status == 'paused'): ?>
                    Paused
                <?php else: ?>
                    Sent on <?php echo strftime('%a, %e %b %Y', $email->send_on) ?>
                <?php endif; ?>
            </p>
            <?php } ?>
        </div>

        <?php $controls->show(); ?>

    </div>


    <div id="tnp-body" style="min-width: 500px">
        
        <?php if (false && $email->status == 'new') { ?>
        
        <div class="tnp-warning"><?php _e('No data, newsletter not sent yet.', 'newsletter')?></div>
        
        <?php } else { ?>

        <form action="" method="post">
            <?php $controls->init(); ?>

            <div class="row">

                <div class="col-md-6">
                    <!-- START Statistics -->
                    <div class="tnp-widget">

                        <h3>Subscribers Reached <a href="admin.php?page=newsletter_reports_view_users&id=<?php echo $email->id ?>">Details</a>
                            <a href="admin.php?page=newsletter_reports_view_retarget&id=<?php echo $email->id ?>">Retarget</a></h3>
                        <div class="inside">
                            <div class="row tnp-row-pie-charts">
                                <div class="col-md-6">
                                    <canvas id="tnp-rates1-chart" style="width: 200px!important; height: 200px!important"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="tnp-rates2-chart" style="width: 200px!important; height: 200px!important"></canvas>
                                </div>
                            </div>

                            <script type="text/javascript">

                                var rates1 = {
                                    labels: [
                                        "Not opened",
                                        "Opened"
                                    ],
                                    datasets: [
                                        {
                                            data: [<?php echo $total_count - $open_count - $error_count; ?>, <?php echo $open_count; ?>, <?php echo $error_count; ?>],
                                            backgroundColor: [
                                                "#E67E22",
                                                "#2980B9",
                                                "#E62222"
                                            ],
                                            hoverBackgroundColor: [
                                                "#E67E22",
                                                "#2980B9",
                                                "#E62222"
                                            ]
                                            
                                        }]};

                                var rates2 = {
                                    labels: [
                                        "Not Clicked",
                                        "Clicked"
                                    ],
                                    datasets: [
                                        {
                                            data: [<?php echo $open_count-$click_count; ?>, <?php echo $click_count; ?>],
                                            backgroundColor: [
                                                "#2980B9",
                                                "#27AE60"
                                            ],
                                            hoverBackgroundColor: [
                                                "#2980B9",
                                                "#27AE60"
                                            ]
                                        }]};

                                jQuery(document).ready(function ($) {
                                    ctx1 = $('#tnp-rates1-chart').get(0).getContext("2d");
                                    ctx2 = $('#tnp-rates2-chart').get(0).getContext("2d");
                                    myPieChart1 = new Chart(ctx1, {type: 'doughnut', data: rates1, options: {responsive: false, legend: {labels: {boxWidth: 10}}}});
                                    myPieChart2 = new Chart(ctx2, {type: 'doughnut', data: rates2, options: {responsive: false, legend: {labels: {boxWidth: 10}}}});
                                });
                            </script>

                            <div class="row tnp-row-values">
                                <div class="col-md-4">
                                    <div class="tnp-data">
                                        <?php if ($email->status == 'sending' || $email->status == 'paused'): ?>
                                            <div class="tnp-data-title">Sent (till now)</div>
                                            <div class="tnp-data-value"><?php echo $total_count; ?> of <?php echo $email->total; ?></div>
                                        <?php else: ?>
                                            <div class="tnp-data-title">Sent</div>
                                            <div class="tnp-data-value"><?php echo $total_count; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                

                                <div class="col-md-4">
                                    <div class="tnp-data">
                                        <div class="tnp-data-title">Opened</div>
                                        <div class="tnp-data-value"><?php echo $open_count ?> (<?php echo NewsletterModule::percent($open_count, $total_count); ?>)</div>
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="tnp-data">
                                        <div class="tnp-data-title">Clicked</div>
                                        <div class="tnp-data-value"><?php echo $click_count; ?> (<?php echo NewsletterModule::percent($click_count, $total_count); ?>)</div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="row tnp-row-values">
                                <div class="col-md-4">
                                    <div class="tnp-data">
                                        <div class="tnp-data-title">Errors</div>
                                        <div class="tnp-data-value"><?php echo $error_count; ?> (<?php echo NewsletterModule::percent($error_count, $total_count); ?>)</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="tnp-data">
                                        <div class="tnp-data-title">Unsubscribed</div>
                                        <div class="tnp-data-value"><?php echo $unsub_count; ?></div>
                                    </div>
                                </div>
                                
                            </div>
                            

                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tnp-widget">
                        <h3>Opens World Distribution</h3>
                        <div class="inside">
                            <?php
                            $countries = $wpdb->get_results($wpdb->prepare("select country, count(distinct user_id) as total from {$wpdb->prefix}newsletter_sent ns join " . NEWSLETTER_USERS_TABLE . " n on n.id=ns.user_id where ns.open > 0 and ns.email_id=%d and n.country<>'' group by n.country order by total", $email_id));
                            $data = array();
                            foreach ($countries as $country) {
                                $data[strtolower($country->country)] = (int)$country->total;
                            }
                            ?>

                            <?php if (empty($countries)) { ?> 
                                <p class="tnp-map-legend">No data available, just wait some time to let the processor work to resolve the countries. Thank you.</p>
                            <?php } else { ?>
                                <p class="tnp-map-legend">The map shows in which countries<br>the newsletter has been opened.</p>
                                <div id="tnp-map-chart"></div>

                                <script type="text/javascript">
                                    var world_data = <?php echo json_encode($data) ?>;
                                    jQuery(document).ready(function ($) {
                                        $('#tnp-map-chart').vectorMap({
                                            map: 'world_en',
                                            backgroundColor: null,
                                            color: '#ffffff',
                                            hoverOpacity: 0.7,
                                            selectedColor: '#666666',
                                            enableZoom: true,
                                            showTooltip: true,
                                            values: world_data,
                                            scaleColors: ['#C8EEFF', '#006491'],
                                            normalizeFunction: 'polynomial',
                                            onLabelShow: function (event, label, code) {
                                                label.text(label.text() + ': ' + world_data[code]);
                                            }
                                        });
                                    });
                                </script>

                            <?php } ?>


                        </div>
                    </div>
                </div>

            </div><!-- row -->


            <!-- Second row -->
            <div class="row">

                <div class="col-md-6">
                    <div class="tnp-widget">
                        <h3>Subscribers Gender</h3>
                        <div class="inside">

                            <?php
                            $gender_total = array();
                            $gender_total['f'] = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id where u.sex='f' and email_id=%d", $email_id));
                            $gender_total['m'] = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id where u.sex='m' and email_id=%d", $email_id));
                            $gender_total['n'] = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id where u.sex='n' and email_id=%d", $email_id));


                            $gender_open = array();
                            $gender_open['f'] = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id where s.open>0 and u.sex='f' and email_id=%d", $email_id));
                            $gender_open['m'] = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id where s.open>0 and u.sex='m' and email_id=%d", $email_id));
                            $gender_open['n'] = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id where s.open>0 and u.sex='n' and email_id=%d", $email_id));

                            $gender_click = array();
                            $gender_click['f'] = $wpdb->get_var($wpdb->prepare("select count(distinct u.id) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id  and s.open>1 where u.sex='f' and email_id=%d", $email_id));
                            $gender_click['m'] = $wpdb->get_var($wpdb->prepare("select count(distinct u.id) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id  and s.open>1 where u.sex='m' and email_id=%d", $email_id));
                            $gender_click['n'] = $wpdb->get_var($wpdb->prepare("select count(distinct u.id) from " . NEWSLETTER_SENT_TABLE . " s join " . NEWSLETTER_USERS_TABLE .
                                            " u on u.id=s.user_id  and s.open>1 where u.sex='n' and email_id=%d", $email_id));
                            ?>

                            <div id="tnp-gender-chart">
                                <p class="tnp-gender-legend">The graph shows subscribers gender<br>based on interaction kind.</p>
                                <canvas id="tnp-gender-chart-canvas" class="tnp-chart"></canvas>
                            </div>

                            <script type="text/javascript">

                                var gender_data = {
                                    labels: ["Nothing", "Opens", "Clicks"],
                                    datasets: [
                                        {
                                            label: "Female",
                                            backgroundColor: "#FFEEE4",
                                            borderColor: "#FFEEE4",
                                            hoverBackgroundColor: "#FFEEE4",
                                            hoverBorderColor: "#FFEEE4",
                                            data: [<?php echo $gender_total['f'] - $gender_open['f']; ?>, <?php echo $gender_open['f'] - $gender_click['f']; ?>, <?php echo $gender_click['f']; ?>]
                                        },
                                        {
                                            label: "Male",
                                            backgroundColor: "#30A9DE",
                                            borderColor: "#30A9DE",
                                            hoverBackgroundColor: "#30A9DE",
                                            hoverBorderColor: "#30A9DE",
                                            data: [<?php echo $gender_total['m'] - $gender_open['m']; ?>, <?php echo $gender_open['m'] - $gender_click['m']; ?>, <?php echo $gender_click['m']; ?>]
                                        }
                                        ,
                                        {
                                            label: "Unknown",
                                            backgroundColor: "#909090",
                                            borderColor: "#909090",
                                            hoverBackgroundColor: "#909090",
                                            hoverBorderColor: "#909090",
                                            data: [<?php echo $gender_total['n'] - $gender_open['n']; ?>, <?php echo $gender_open['n'] - $gender_click['n']; ?>, <?php echo $gender_click['n']; ?>]
                                        }
                                    ]
                                };

                                jQuery(document).ready(function ($) {
                                    genderCtx = $('#tnp-gender-chart-canvas').get(0).getContext("2d");
                                    genderChart = new Chart(genderCtx, {type: 'bar', data: gender_data});
                                });

                            </script>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="tnp-widget">
                        <h3>Interactions Over Time</h3>
                        <div class="inside">
                            <?php
                            $events_data = array();
                            $clicks_data = array();
                            $events_labels = array();
                            $max = 0;
                            for ($i = 0; $i < 15; $i++) {
                                $events_labels[] = strftime('%a, %e %b', $email->send_on + $i * 86400);
                                $opens = 0;
                                foreach ($open_events as $e) {
                                    if (date("Y-m-d", $email->send_on + $i * 86400) == $e->event_day) {
                                        $opens = (int) $e->events_count;
                                        $max = max($opens, $max);
                                    }
                                }
                                $events_data[] = $opens;
                                $clicks = 0;
                                foreach ($click_events as $e) {
                                    if (date("Y-m-d", $email->send_on + $i * 86400) == $e->event_day) {
                                        $clicks = (int) $e->events_count;
                                    }
                                }
                                $click_data[] = $clicks;
                            }
                            ?>

                            <p class="tnp-events-legend">Subscribers interactions distribution over time,<br>starting from the sending day.</p>

                            <?php if (empty($events_data)) { ?>
                                <p>Still no data.</p>
                            <?php } else { ?>

                                <div id="tnp-events-chart">
                                    <canvas id="tnp-events-chart-canvas"></canvas>
                                </div>

                                <script type="text/javascript">
                                    var events_data = {
                                        labels: <?php echo json_encode($events_labels) ?>,
                                        datasets: [
                                            {
                                                label: "Open",
                                                fill: false,
                                                strokeColor: "#27AE60",
                                                backgroundColor: "#27AE60",
                                                borderColor: "#27AE60",
                                                pointBorderColor: "#27AE60",
                                                pointBackgroundColor: "#27AE60",
                                                data: <?php echo json_encode($events_data) ?>
                                            },
                                            {
                                                label: "Click",
                                                fill: false,
                                                strokeColor: "#C0392B",
                                                backgroundColor: "#C0392B",
                                                borderColor: "#C0392B",
                                                pointBorderColor: "#C0392B",
                                                pointBackgroundColor: "#C0392B",
                                                data: <?php echo json_encode($click_data) ?>,
                                                yAxisID: "y-axis-2"
                                            }
                                        ]
                                    };

                                    jQuery(document).ready(function ($) {
                                        ctxe = $('#tnp-events-chart-canvas').get(0).getContext("2d");
                                        eventsLineChart = new Chart(ctxe, {type: 'line', data: events_data,
                                            options: {
                                                scales: {
                                                    xAxes: [{type: "category", "id": "x-axis-1", gridLines: {display: false}, ticks: {fontFamily: "Source Sans Pro"}}],
                                                    yAxes: [
                                                        {type: "linear", "id": "y-axis-1", gridLines: {display: false}, ticks: {fontColor: "#27AE60", fontFamily: "Source Sans Pro"}},
                                                        {type: "linear", "id": "y-axis-2", position: "right", gridLines: {display: false}, ticks: {fontColor: "#C0392B", fontFamily: "Source Sans Pro"}}
                                                    ]
                                                },
                                            }
                                        });
                                    });
                                </script>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tnp-urls-chart" class="row">
                <div class="col-md-12">
                    <div class="tnp-widget">
                        <h3>URLs <a href="admin.php?page=newsletter_reports_view_urls&id=<?php echo $email->id ?>">Details</a></h3>
                        <div class="inside">
                            <?php
                            $urls = $wpdb->get_results("select url, count(distinct user_id) as number from " . NEWSLETTER_STATS_TABLE . " where url<>'' and email_id=" . ((int) $email_id) . " group by url order by number desc limit 8");
                            $total = $wpdb->get_var("select count(distinct user_id) from " . NEWSLETTER_STATS_TABLE . " where url<>'' and email_id=" . ((int) $email_id));
                            ?>

                            <?php if (empty($urls)) { ?>    
                                <p>No clicks by now.</p>

                            <?php } else { ?>

                                <table class="widefat">
                                    <thead>
                                        <tr>
                                            <th>URL</th>
                                            <th>Unique Clicks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($urls); $i++) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($urls[$i]->url) ?></td>
                                                <td><?php echo $urls[$i]->number ?></td>
                                            <tr>
                                            <?php } ?>
                                    </tbody>
                                </table>

                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

        </form>
        
        <?php } // if "new" ?>

    </div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php' ?>

</div>
