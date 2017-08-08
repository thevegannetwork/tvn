<?php

global $controls;
require_once dirname(__FILE__) . '/controls.php';
$module = NewsletterLeads::$instance;
$controls = new NewsletterControls();

if (!$controls->is_action()) {
    $controls->data = $module->options;
} else {

    if ($controls->is_action('save')) {

        if (!is_numeric($controls->data['width'])) {
            $controls->data['width'] = 600;
        }
        if (!is_numeric($controls->data['height'])) {
            $controls->data['height'] = 500;
        }
        if (!is_numeric($controls->data['days'])) {
            $controls->data['days'] = 365;
        }
        if (!is_numeric($controls->data['delay'])) {
            $controls->data['delay'] = 2;
        }   

        $module->save_options($controls->data);
        $controls->messages = 'Saved.';
    }

    if ($controls->is_action('test')) {
        
    }
}
?>

<style>
<?php include dirname(__FILE__) . '/css/leads-admin.css' ?>
</style>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_DIR . '/tnp-header.php' ?>
    <div id="tnp-heading">

        <h2>Newsletter Leads Configuration</h2>

        <?php $controls->show(); ?>
    </div>

    <div id="tnp-body">
        <form action="" method="post">
            <?php $controls->init(); ?>
            <p>
                <?php $controls->button_primary('save', __('Save', 'newsletter')); ?>
                <a href="<?php echo get_option('home'); ?>?newsletter_leads=1" target="home" class="button-primary">Preview on your website</a>
            </p>


            <div class="tabordion">
                <section id="section1">
                    <input type="radio" name="sections" id="option1" checked>
                        <label for="option1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 48 48"><g ><path fill="#EA9860" d="M47,22C47,11.52344,36.68262,3,24,3S1,11.52344,1,22s10.31738,19,23,19
                                                                                                                                                                                                        c2.03809,0,4.08594-0.23047,6.09277-0.68652l11.53613,4.61523C41.74902,44.97656,41.875,45,42,45
                                                                                                                                                                                                        c0.21582,0,0.42871-0.06934,0.60547-0.2041c0.28027-0.21289,0.42676-0.55664,0.38867-0.90625l-1.10645-9.9502
                                                                                                                                                                                                        C45.18848,30.56641,47,26.34473,47,22z"/>
                                    <path fill="#FFFFFF" d="M32,19H16c-0.55273,0-1-0.44727-1-1s0.44727-1,1-1h16c0.55273,0,1,0.44727,1,1S32.55273,19,32,19z"/>
                                    <path fill="#FFFFFF" d="M26,27H16c-0.55273,0-1-0.44727-1-1s0.44727-1,1-1h10c0.55273,0,1,0.44727,1,1S26.55273,27,26,27z"/></g></svg>Popup</label>
                        <article>
                            <div class="tnp-option">
                                <h6 class="tnp-option-title">Status </h6>
                                <div class="tnp-option-content">
                                    <span>Enabled</span>
                                    <?php $controls->yesno('popup-enabled'); ?>
                                </div>
                            </div>
                            <div class="tnp-option">
                                <h6 class="tnp-option-title">Visibility</h6>
                                <div class="tnp-option-content">
                                    <span>Show on</span>
                                    <?php $controls->select('count', array('0' => 'first', '1' => 'second', '2' => 'third', '4' => 'fourth')); ?>
                                    <span>page view</span>
                                </div>
                                <div class="tnp-option-content">
                                    <span>Show after </span>
                                    <?php $controls->text('delay', 6); ?>
                                    <span> seconds.  <div class="tooltip"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 48 48"><g ><path fill="#43A6DD" d="M24,1C11.31738,1,1,11.31787,1,24s10.31738,23,23,23s23-10.31787,23-23S36.68262,1,24,1z"/>
                                                    <path fill="#FFFFFF" d="M28,33h-3V22c0-0.55225-0.44727-1-1-1h-4c-0.55273,0-1,0.44775-1,1s0.44727,1,1,1h3v10h-3
                                                          c-0.55273,0-1,0.44775-1,1s0.44727,1,1,1h8c0.55273,0,1-0.44775,1-1S28.55273,33,28,33z"/><circle fill="#FFFFFF" cx="24" cy="16" r="2"/></g></svg>
                                            <span class="tooltiptext">How many seconds have to pass, after the page is fully loaded, before the pop up is shown.
                                                Decimal values allowed (for example 0.5 for half a second).</span>
                                        </div></span>
                                </div>
                                <div class="tnp-option-content">
                                    <span>Restart counting after </span>
                                    <?php $controls->text('days', 5); ?>
                                    <span> days.  <div class="tooltip"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 48 48"><g ><path fill="#43A6DD" d="M24,1C11.31738,1,1,11.31787,1,24s10.31738,23,23,23s23-10.31787,23-23S36.68262,1,24,1z"/>
                                                    <path fill="#FFFFFF" d="M28,33h-3V22c0-0.55225-0.44727-1-1-1h-4c-0.55273,0-1,0.44775-1,1s0.44727,1,1,1h3v10h-3
                                                          c-0.55273,0-1,0.44775-1,1s0.44727,1,1,1h8c0.55273,0,1-0.44775,1-1S28.55273,33,28,33z"/><circle fill="#FFFFFF" cx="24" cy="16" r="2"/></g></svg>
                                            <span class="tooltiptext">The number of days the system should retain memory of shown pop up to a user before
                                                restart the process.</span>
                                        </div></span>
                                </div>
                            </div>
                            <div class="tnp-option">
                                <h6 class="tnp-option-title">Visual Options</h6>
                                <input type="hidden" name="options[theme]" value="default" />
                                <div class="tnp-option-content">
                                    <span>Aspect Ratio </span><?php $controls->text('width', 5); ?> x <?php $controls->text('height', 5); ?> pixels.
                                </div>
                                <div class="tnp-option-content">
                                    <span>Title </span><?php $controls->text('theme_title'); ?> 
                                </div>
                                <div class="tnp-option-content">
                                    <span>Pre Form Text </span><?php $controls->textarea('theme_pre'); ?>
                                </div>
                                <div class="tnp-option-content">
                                    <span>Post Form Text </span><?php $controls->textarea('theme_post'); ?>
                                </div>
                                <div class="tnp-option-content">
                                    <span>Show the Name field </span><?php $controls->checkbox('theme_field_name'); ?>
                                </div>
                                <div class="tnp-option-content">
                                    <span>Button Label </span><?php $controls->text('theme_subscribe_label', 70); ?>
                                </div>
                                <div class="tnp-option-content">
                                    <span class="clear">Color Palette </span>
                                    <div>
                                        <?php foreach (array_keys(NewsletterLeads::$leads_colors) AS $name) { ?>
                                            <span class="tnp-option-color <?php echo $name ?>">
                                                <input type="radio" name="options[theme_popup_color]" id="popup-<?php echo $name ?>" 
                                                       value="<?php echo $name ?>" <?php if ($controls->data['theme_popup_color'] == $name) { ?>checked="true"<?php } ?>>
                                                    <label for="popup-<?php echo $name ?>"><?php echo ucfirst($name) ?></label>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <?php $controls->button('save', 'Save'); ?>
                            </p>
                        </article>
                </section>
                <section id="section2">
                    <input type="radio" name="sections" id="option2">
                        <label for="option2"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 48 48"><g >
                                    <path fill="#444444" d="M45,46H3c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h42c1.105,0,2,0.895,2,2v36C47,45.105,46.105,46,45,46z
                                          "/>
                                    <rect x="3" y="13" fill="#FFFFFF" width="42" height="31"/>
                                    <circle fill="#E86C60" cx="4.5" cy="9.5" r="1.5"/>
                                    <circle fill="#EFD358" cx="9.5" cy="9.5" r="1.5"/>
                                    <circle fill="#72C472" cx="14.5" cy="9.5" r="1.5"/>
                                    <path fill="#A67C52" d="M38.172,2.828c-1.105-1.105-2.895-1.105-4,0L21.536,15.464c0.988,0.181,1.899,0.65,2.625,1.376
                                          c0.726,0.726,1.194,1.636,1.375,2.624L38.172,6.828C39.276,5.724,39.276,3.933,38.172,2.828z"/>
                                    <path fill="#E6E6E6" d="M21.536,15.464L16,21l4,4l5.536-5.536c-0.181-0.988-0.65-1.899-1.375-2.624
                                          C23.435,16.115,22.524,15.646,21.536,15.464z"/>
                                    <path fill="#E86C60" d="M41,41H7c-0.552,0-1-0.448-1-1v-7c0-0.552,0.448-1,1-1h34c0.552,0,1,0.448,1,1v7C42,40.552,41.552,41,41,41z
                                          "/>
                                    <path fill="#444444" d="M20.863,27.192c0.89-0.934,1.387-2.146,1.387-3.441c0-1.336-0.52-2.591-1.464-3.535s-2.2-1.465-3.536-1.465
                                          c-1.336,0-2.591,0.521-3.536,1.465c-1.056,1.056-1.467,3.263-1.623,5.089c1.596,0.415,2.689,0.727,3.846,1.04
                                          C17.368,26.73,18.844,27.132,20.863,27.192z"/>
                                    <path fill="#E86C60" d="M12.008,28.02l0.025,0.948l0.947,0.025C13.109,28.996,13.304,29,13.552,29c1.667,0,5.687-0.168,7.233-1.715
                                          c0.029-0.029,0.049-0.064,0.077-0.094c-3.56-0.974-5.061-2.161-8.771-1.888C11.985,26.549,11.997,27.618,12.008,28.02z"/>
                                </g></svg>Fixed Bar</label>
                        <article>
                            <div class="tnp-option">
                                <h6 class="tnp-option-title">Status </h6>
                                <div class="tnp-option-content">
                                    <span>Enabled</span>
                                    <?php $controls->yesno('bar-enabled'); ?>
                                </div>
                            </div>
                            <div class="tnp-option">
                                <h6 class="tnp-option-title">Position</h6>
                                <div class="tnp-option-content">
                                    <span>Show on </span>
                                    <?php $controls->select('position', array('top' => 'Top', 'bottom' => 'Bottom')); ?>
                                    <span>of the page</span>
                                </div>
                            </div>
                            <div class="tnp-option">
                                <h6 class="tnp-option-title">Visual Options</h6>    
                                <div class="tnp-option-content">
                                    <span>Button Label </span><?php $controls->text('bar_subscribe_label', 70); ?>
                                </div>
                                <div class="tnp-option-content">
                                    <span>Email field placeholder </span><?php $controls->text('bar_placeholder', 70); ?>
                                </div>
                                <div class="tnp-option-content">
                                    <span class="clear">Color Palette </span>
                                    <div>
                                        <?php foreach (array_keys(NewsletterLeads::$leads_colors) AS $name) { ?>
                                            <span class="tnp-option-color <?php echo $name ?>">
                                                <input type="radio" name="options[theme_bar_color]" id="bar-<?php echo $name ?>" 
                                                       value="<?php echo $name ?>" <?php if ($controls->data['theme_bar_color'] == $name) { ?>checked="true"<?php } ?>>
                                                    <label for="bar-<?php echo $name ?>"><?php echo ucfirst($name) ?></label>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <?php $controls->button('save', 'Save'); ?>
                            </p>
                        </article>
                </section>
                <section id="section3" style="display:none;">
                    <input type="radio" name="sections" id="option3">
                        <label for="option3"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 48 48"><g >
                                    <path fill="#EFD358" d="M39,46V7c0-2.761-2.239-5-5-5H6c1.634,0,1.088,1.788,2,3c0.629,0.836,3,0.873,3,2v34c0,2.761,2.239,5,5,5H39
                                          z"/>
                                    <path fill="#A67C52" d="M11,8H1V7c0-2.761,2.239-5,5-5h0c2.761,0,5,2.239,5,5V8z"/>
                                    <path fill="#A67C52" d="M21,40v1c0,4.5-5,5-5,5s23.657,0,24,0c2.761,0,5-2.239,5-5v-1H21z"/>
                                    <path fill="#5A7A84" d="M45.172,6.828c-1.105-1.105-2.895-1.105-4,0L28.536,19.464c0.988,0.181,1.899,0.65,2.625,1.376
                                          c0.726,0.726,1.194,1.636,1.375,2.624l12.636-12.636C46.276,9.724,46.276,7.933,45.172,6.828z"/>
                                    <path fill="#E6E6E6" d="M28.536,19.464L23,25l4,4l5.536-5.536c-0.181-0.988-0.65-1.899-1.375-2.624
                                          C30.435,20.115,29.524,19.646,28.536,19.464z"/>
                                    <path fill="#444444" d="M27.785,24.215c-0.944-0.944-2.2-1.465-3.536-1.465c-1.336,0-2.591,0.521-3.536,1.465
                                          c-1.776,1.776-1.733,6.813-1.707,7.805l0.025,0.948l0.947,0.025C20.109,32.996,20.304,33,20.552,33c1.667,0,5.687-0.168,7.233-1.715
                                          c0.944-0.944,1.464-2.199,1.464-3.535S28.73,25.159,27.785,24.215z"/>
                                </g></svg>Visual</label>
                        <article>
                            <p>How many seconds to wait, after the page is full loaded, before show the pop up.
                                Decimal values allowed (for example 0.5 for half a second).</p>
                        </article>
                </section>
                
            </div>

            

        </form>
    </div>
    <?php @include NEWSLETTER_DIR . '/tnp-footer.php' ?>
</div>
