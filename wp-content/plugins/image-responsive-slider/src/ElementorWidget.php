<?php


namespace CoreFortress\Slider;


class ElementorWidget extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'corefortress_slider';
    }

    public function get_title() {
        return __( 'CoreFortress Slider', 'corefortress_slider' );
    }

    public function get_icon() {
        return 'fa fa-code';
    }

    public function get_categories() {
        return array('basic');
    }

    protected function _register_controls() {
        global $wpdb;
        $slidersTable = $wpdb->prefix.'corefortress_sliders';
        $sliders = $wpdb->get_results("SELECT id, name FROM `".$slidersTable."` order by id desc ");

        $slidersOptions = array(
            0  => __( 'Select', 'corefortress_slider' )
        );

        if(!empty($slidersOptions)) {
            foreach ($sliders as $slider) {
                $slidersOptions[$slider->id] = $slider->name;
            }
        }

        $this->start_controls_section(
            'content_section',
            array(
                'label' => __( 'Content', 'corefortress_slider' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'slider_id',
            array(
                'label' => __( 'Select Slider', 'corefortress_slider' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 0,
                'options' => $slidersOptions,
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo do_shortcode('[corefortress_slider id="'.$settings['slider_id'].'"]');
    }
}