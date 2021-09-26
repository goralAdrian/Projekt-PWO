<?php
/*
Plugin Name: Image Responsive Slider
Plugin URI: https://corefortress.net/downloads/slider/
Description: Having a team of creative designers and developers
Version: 1.0.1
Author: CoreFortress
Author URI: https://corefortress.net
Domain Path: /languages/
License: GNU/GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
define('COREFORTRESS_SLIDER_VERSION', '1.0.1');
define('COREFORTRESS_SLIDER_URL', plugins_url('/', __FILE__));
define('COREFORTRESS_SLIDER_PATH', plugin_dir_path(__FILE__));

require_once(__DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php");

$GLOBALS['corefortress_slider'] = \CoreFortress\Slider\Plugin::getInstance();

register_activation_hook(__FILE__, array(\CoreFortress\Slider\Installation::class, 'install'));