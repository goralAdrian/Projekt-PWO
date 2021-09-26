<?php


namespace CoreFortress\Slider;


class Shortcode
{
    public function __construct()
    {
        add_action('init', array($this, 'initShortcode'));
    }

    public function initShortcode()
    {
        add_shortcode('corefortress_slider', array($this, 'runShortcode'));
    }

    public function runShortcode($atts)
    {
        if (!isset($atts['id']) || empty($atts['id']) || absint($atts['id']) != $atts['id']) {
            return 'Invalid shortcode parameter';
        }
        global $wpdb;
        $id = absint($atts['id']);

        $slider = $wpdb->get_row($wpdb->prepare('select * from `' . $wpdb->prefix . 'corefortress_sliders` where id=%d', $id));
        $theme = $wpdb->get_row($wpdb->prepare('select * from `'.$wpdb->prefix.'corefortress_slider_themes` where id=%d', $slider->theme_id));

        $themeSettings = json_decode($theme->settings, true);

        if (empty($slider)) {
            return 'Invalid Slider ID';
        }

        $slides = $wpdb->get_results($wpdb->prepare('select * from `'.$wpdb->prefix.'corefortress_slides` where slider_id=%d order by sort_order asc, id asc', $id));

        wp_enqueue_script('corefortress_slider_swiper', COREFORTRESS_SLIDER_URL.'assets/swiper/js/swiper.js');
        wp_enqueue_script('corefortress_slider_front', COREFORTRESS_SLIDER_URL.'assets/js/front.js', array('corefortress_slider_swiper','jquery'));
        wp_enqueue_style('corefortress_slider_swiper', COREFORTRESS_SLIDER_URL.'assets/swiper/css/swiper.min.css');
        wp_enqueue_style('corefortress_slider_front', COREFORTRESS_SLIDER_URL.'assets/styles/front.css');

        ob_start();
        require_once COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'front' . DIRECTORY_SEPARATOR . 'helper.php';
        require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'front' . DIRECTORY_SEPARATOR . 'shortcode.php';
        return ob_get_clean();
    }
}