<?php
/**
 * 
 */
global $wpdb;

$user = Newsletter::instance()->get_user($id);
// Total email sent to this subscriber
$total_count = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " where user_id=%d", $id));
$open_count = $wpdb->get_var($wpdb->prepare("select count(distinct email_id) from " . NEWSLETTER_SENT_TABLE . " where user_id=%d and open>0", $id));
$click_count = $wpdb->get_var($wpdb->prepare("select count(*) from " . NEWSLETTER_SENT_TABLE . " where user_id=%d and open=2", $id));

?>

<div class="row" style="background-color: #fff">

    <div class="col-md-3">
        <br>
        <div style="text-align: center;">
            <img src="http://www.gravatar.com/avatar/<?php echo md5($user->email) ?>?s=250" style="width: 150px">
        </div>
        <br>

        
    </div>
    <div class="col-md-3">
       
    <br>
    <strong>Geolocation</strong>
    <br><br>
        Country: <?php echo esc_html($controls->countries[$user->country]) ?><br>
        Region: <?php echo esc_html($user->region) ?><br>
        City: <?php echo esc_html($user->city) ?><br>
    </div>
    
    <div class="col-md-3">
        <br>
        <?php if (!$total_count) { ?>
        Still no data for this subscriber
        <?php } else { ?>
        
        <div style="width: 200px!important; height: 200px!important">
        <canvas id="tnp-rates" width="400" height="400"></canvas>
        </div>


        <script type="text/javascript">

            var rates = {
                labels: [
                    "Not opened",
                    "Opened",
                    "Clicked"
                ],
                datasets: [
                    {
                        data: [<?php echo $total_count - $open_count; ?>, <?php echo $open_count - $click_count; ?>, <?php echo $click_count; ?>],
                        backgroundColor: [
                            "#E67E22",
                            "#2980B9",
                            "#27AE60"
                        ],
                        hoverBackgroundColor: [
                            "#E67E22",
                            "#2980B9",
                            "#27AE60"
                        ]
                    }]};




            jQuery(document).ready(function ($) {
                ctx1 = $('#tnp-rates').get(0).getContext("2d");
                myPieChart1 = new Chart(ctx1, {type: 'pie', data: rates});

            });

        </script>
        <br>
 <?php } ?>
    </div>
    
       
            <div class="col-md-3">
                <br>
                <strong>Newsletters</strong>
                <br><br>
                Total: <?php echo $total_count; ?>
                <br>
                
            Opened: <?php echo $open_count; ?> (<?php echo NewsletterModule::percent($open_count, $total_count); ?>)
    <br>

           Clicked: <?php echo $click_count; ?> (<?php echo NewsletterModule::percent($click_count, $total_count); ?>)
            </div>
       
       

    </div>




