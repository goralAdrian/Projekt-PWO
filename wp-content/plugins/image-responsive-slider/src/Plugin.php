<?php


namespace CoreFortress\Slider;

/**
 * Singleton
 * Class Plugin
 * @package CoreFortress\Slider
 */
final class Plugin
{
    private static $instance = null;

    /**
     * @var array
     */
    public $pages;

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Plugin();
        }

        return self::$instance;
    }

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        // The expensive process (e.g.,db connection) goes here.

        add_action('admin_menu', array($this, 'adminMenu'));
        add_action('admin_enqueue_scripts', array($this, 'adminScripts'));
        add_action('admin_notices', array($this, 'adminNotices'));
        add_action('wp_ajax_corefortress_post_search_ajax', array($this, 'postSearch'));
        add_action('wp_ajax_corefortress_dismiss_pro_notice',array($this,'dismissProNotice'));
        add_action('elementor/widgets/widgets_registered', array($this, 'elementorWidgets'));
        add_filter('block_categories', array($this, 'gutenbergBlockCategory'), 10, 2);
        add_action('init', array($this, 'gutenbergBlock'));
        add_action('media_buttons', array($this, 'classicPostEditorMediaButton'));
        $shortcode = new Shortcode();
    }

    public function dismissProNotice()
    {
        set_transient('corefortress_hide_notice', 'yes',86400);
    }

    public function classicPostEditorMediaButton($context)
    {
        global $wpdb;
        $slidersTable = $wpdb->prefix . 'corefortress_sliders';
        $sliders = $wpdb->get_results("SELECT id, name FROM `" . $slidersTable . "` order by id desc ");
        $slidersOptions = array(
            0 => __('Select Slider', 'corefortress_slider')
        );

        if (!empty($slidersOptions)) {
            foreach ($sliders as $slider) {
                $slidersOptions[$slider->id] = $slider->name;
            }
        }
        ?>
        <div id="corefortress_add_post_slider" style="display: none;">
            <p style="text-align: center;">
                <label>
                    <select id="corefortress_slider_select">
                        <?php foreach ($slidersOptions as $key => $slidersOption) {
                            ?>
                            <option value="<?php echo $key; ?>"><?php echo $slidersOption; ?></option>
                            <?php
                        } ?>
                    </select>
                </label>
            </p>
            <p style="text-align: center;">
                <a href="#" class="button button-primary" id="corefortress_insert_slider">Done</a>
            </p>
            <script>
                let corefortressMediaInsert = document.getElementById('corefortress_insert_slider');
                corefortressMediaInsert.addEventListener('click', function (e) {
                    e.preventDefault();

                    let selection = document.getElementById('corefortress_slider_select').value;

                    if (typeof selection != 'undefined' && selection != 0) {
                        window.parent.send_to_editor('[corefortress_slider id="' + selection + '"]');
                    }

                    window.parent.tb_remove();
                    return false;
                });
            </script>
        </div>
        <a href="#TB_inline?width=300&height=300&inlineId=corefortress_add_post_slider" title="Add Slider"
           class="thickbox button"><img src="<?php echo COREFORTRESS_SLIDER_URL . "assets/img/admin-icon.png"; ?>" alt="Slider" width="21px" height="21px" style="vertical-align: middle; margin-bottom:2px;" />Insert Slider</a>
        <?php
    }

    public function gutenbergBlock()
    {
        if (!function_exists('register_block_type')) {
            return;
        }

        wp_register_script(
            'corefortress_slider_gutenberg_block',
            COREFORTRESS_SLIDER_URL . 'assets/js/gutenberg.js',
            array('wp-blocks', 'wp-element', 'wp-components')
        );

        global $wpdb;
        $slidersTable = $wpdb->prefix . 'corefortress_sliders';
        $sliders = $wpdb->get_results("SELECT id, name FROM `" . $slidersTable . "` order by id desc ");
        $sliderOptions = array(
            array(
                'value' => 0,
                'label' => 'Select'
            ),
        );
        $sliderMetas = array();
        if (!empty($sliders)) {
            foreach ($sliders as $slider) {
                $sliderOptions[] = [
                    'value' => $slider->id,
                    'label' => $slider->name,
                ];
                $sliderMetas[$slider->id] = $slider->name;
            }
        }

        wp_localize_script('corefortress_slider_gutenberg_block', 'corefortressSliderBlockI10n', array(
            'sliders' => $sliderOptions,
            'sliderMetas' => $sliderMetas
        ));

        register_block_type('corefortress/slider', array(
            'editor_script' => 'corefortress_slider_gutenberg_block',
            'editor_style' => null,
        ));
    }

    public function gutenbergBlockCategory($categories, $post)
    {

        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'corefortress',
                    'title' => __('CoreFortress', 'corefortress_slider'),
                ),
            )
        );
    }

    public function elementorWidgets()
    {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ElementorWidget());
    }

    public function postSearch()
    {
        if (!isset($_POST['s']) || empty($_POST['s'])) {
            echo json_encode(array('success' => 0));
            exit;
        }
        $args = array(
            'post_type' => 'post',
            'order' => 'DESC',
            'posts_per_page' => 20,
            's' => sanitize_text_field($_POST['s'])
        );
        $loop = new \WP_Query($args);

        echo json_encode(array('success' => 1, 'data' => $loop->get_posts()));
        exit;
    }

    public function adminNotices()
    {
        $message = get_transient('corefortress_slider_message');
        $message_class = get_transient('corefortress_slider_message_class');

        if (empty($message)) {
            return;
        } else {
            delete_transient('corefortress_slider_message');
            delete_transient('corefortress_slider_message_class');
        }
        ?>
        <div class="notice notice-<?php echo $message_class; ?>">
            <p><?php echo $message; ?></p>
        </div>
        <?php
    }

    public function adminScripts($hook)
    {
        wp_enqueue_style('corefortress_admin_global', COREFORTRESS_SLIDER_URL . 'assets/styles/admin.global.css');
        if (in_array($hook, $this->pages)) {
            wp_enqueue_style('corefortress_admin', COREFORTRESS_SLIDER_URL . 'assets/styles/admin.css');
            wp_enqueue_script('corefortress_admin', COREFORTRESS_SLIDER_URL . 'assets/js/admin.js', array('jquery', 'wp-color-picker', 'jquery-ui-sortable', 'jquery-masonry'));

            wp_localize_script('corefortress_admin', 'corefortressAdminL10nn', array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
            ));

            if (isset($_GET['action']) && $_GET['action'] === 'edit') {

                wp_enqueue_media();
                wp_enqueue_style('wp-color-picker');
            }
        }/*elseif($hook === 'post.php'){
            add_thickbox();
        }*/

    }

    public function adminMenu()
    {
        $adminSliders = new AdminSliders();
        $adminThemes = new AdminThemes();
        $this->pages['main'] = add_menu_page(__('Slider', 'corefortress_slider'), __('Slider', 'corefortress_slider'), 'manage_options', 'corefortress_slider_sliders', array(
            $adminSliders,
            'renderPage'
        ), COREFORTRESS_SLIDER_URL . "assets/img/admin-icon.png");

        $this->pages['sliders'] = add_submenu_page('corefortress_slider_sliders', __('Sliders', 'corefortreses_slider'), __('Sliders', 'corefortreses_slider'), 'manage_options', 'corefortress_slider_sliders', array(
            $adminSliders,
            'renderPage'
        ));

        $this->pages['sliders'] = add_submenu_page('corefortress_slider_sliders', __('Themes', 'corefortreses_slider'), __('Themes', 'corefortreses_slider'), 'manage_options', 'corefortress_slider_themes', array(
            $adminThemes,
            'renderPage'
        ));
    }

    public function hex2rgba($color, $opacity = false)
    {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty($color))
            return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity !== false) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        //Return rgb(a) color string
        return $output;
    }

}