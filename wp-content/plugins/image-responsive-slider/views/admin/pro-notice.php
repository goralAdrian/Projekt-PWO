<?php
$dismiss = get_transient('corefortress_hide_notice');
if ($dismiss !== 'yes'):
    if (isset($_GET['page']) && $_GET['page'] === 'corefortress_slider_themes') {
        $headline = 'Theme Customizations are available in Premium version of the plugin.';
    } else {
        $headline = 'You are using Free version of CoreFortress Slider.<br />With Premium version you get <u>Theme Customizations</u> and options to create  <u>Video & Post Slides</u>';
    }

    ?>
    <div class="corefortress-pro-notice">
        <span class="corefortress-pro-dismiss">X</span>
        <img src="<?php echo COREFORTRESS_SLIDER_URL . "assets/img/logo.png"; ?>" alt="Slider Pro"/>
        <div class="corefortress-pro-content">
            <p><?php echo $headline ?> It's a one-time payment which helps us to buy coffee while we're crafting next
                update for you :)</p>
            <a href="https://corefortress.net/downloads/slider/" target="_blank">Upgrade For $9.99 Now</a>
        </div>
    </div>
<?php
endif;