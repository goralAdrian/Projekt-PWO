<?php


namespace CoreFortress\Slider;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Class AdminSliders
 * @package CoreFortress\Slider
 */
class AdminSliders
{

    public function __construct()
    {
        add_action('admin_init', array($this,'actions'));
    }

    public function actions()
    {
        if(isset($_GET['page']) && $_GET['page'] === 'corefortress_slider_sliders' && isset($_GET['action']) && !empty($_GET['action'])) {
            $action = sanitize_text_field($_GET['action']);

            switch($action){
                case 'create':
                    //nonce
                    if(!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'corefortress_slider_create')){
                        wp_die('Invalid Request');
                    }

                    global $wpdb;

                    $firstTheme = $wpdb->get_col('select id from '.$wpdb->prefix.'corefortress_slider_themes order by id asc limit 1');

                    $res = $wpdb->insert($wpdb->prefix.'corefortress_sliders', array(
                        'name' => 'New Slider',
                        'theme_id' => $firstTheme[0]
                    ));
                    $id = $wpdb->insert_id;

                    if($res != false) {
                        set_transient('corefortress_slider_message', 'Slider Created Successfully',100);
                        set_transient('corefortress_slider_message_class', 'success',100);
                    } else {
                        set_transient('corefortress_slider_message', 'Something went wrong while creating new Slider, please try again. If the error keeps showing up try finding solution in <a href="https://wordpress.org/support/plugin/image-responsive-slider/">Community Forums</a>.',100);
                        set_transient('corefortress_slider_message_class', 'error',100);
                    }

                    wp_redirect(admin_url('admin.php?page=corefortress_slider_sliders&action=edit&id='.$id));
                    exit;
                    break;
                case 'delete':
                    //nonce
                    if(!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'corefortress_slider_delete')){
                        wp_die('Invalid Request');
                    }
                    if(!isset($_POST['id']) || empty($_POST['id']) || (absint($_POST['id']) != $_POST['id'])) {
                        wp_die('Invalid Request');
                    }

                    global $wpdb;
                    $res = $wpdb->delete($wpdb->prefix.'corefortress_sliders', array('id' => absint($_POST['id'])));

                    if($res != false) {
                        set_transient('corefortress_slider_message', 'Slider Deleted Successfully',100);
                        set_transient('corefortress_slider_message_class', 'success',100);
                    } else {
                        set_transient('corefortress_slider_message', 'Something went wrong while deleting the selected slider, please try again. If the error keeps showing up try finding solution in <a href="https://wordpress.org/support/plugin/image-responsive-slider/">Community Forums</a>.',100);
                        set_transient('corefortress_slider_message_class', 'error',100);
                    }

                    wp_redirect(admin_url('admin.php?page=corefortress_slider_sliders'));
                    exit;
                    break;
                case 'update':
                    if(!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'corefortress_slider_update')){
                        wp_die('Invalid Request');
                    }
                    if(!isset($_POST['id']) || empty($_POST['id']) || (absint($_POST['id']) != $_POST['id'])) {
                        wp_die('Invalid Request');
                    }

                    global $wpdb;
                    $slider_id = absint($_POST['id']);
                    $slidesTable = $wpdb->prefix.'corefortress_slides';
                    $slidersTable = $wpdb->prefix.'corefortress_sliders';
                    $results = array();

                    if (isset($_POST['remove_slide']) && !empty($_POST['remove_slide']) && absint($_POST['remove_slide']) == $_POST['remove_slide']) {
                        $remove_id = absint($_POST['remove_slide']);

                        $results[] = $wpdb->delete($slidesTable, array('id' => $remove_id));
                    }

                    if(isset($_POST['add_slides']) && !empty($_POST['add_slides'])){
                        $add_slides = sanitize_text_field($_POST['add_slides']);
                        $add_slides = @json_decode(wp_unslash($add_slides),true);
                        if(!empty($add_slides)) {
                            foreach ($add_slides as $add_slide) {
                                $new_slide_data = array(
                                    'slider_id' => $slider_id
                                );
                                if (isset($add_slide['media_type'])) {
                                    $new_slide_data['media_type'] = $add_slide['media_type'];
                                } else {
                                    continue;
                                }

                                if($add_slide['media_type'] === 'image') {
                                    if(!isset($add_slide['media_image_id']) || empty($add_slide['media_image_id'])){
                                        continue;
                                    }
                                    $new_slide_data['media_image_id'] = $add_slide['media_image_id'];
                                }else if($add_slide['media_type'] === 'video') {
                                    if(!isset($add_slide['media_video_url']) || empty($add_slide['media_video_url'])){
                                        continue;
                                    }

                                    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';

                                    if (preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $add_slide['media_video_url'], $match ) ) {
                                        $youtube_id = $match[1];
                                        $new_slide_data['media_image_url'] = 'http://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';
                                    } elseif (strpos( $add_slide['media_video_url'], 'vimeo' ) !== false) {
                                        $vimeoid = explode( "/", $add_slide['media_video_url']   );
                                        $vimeoid = end( $vimeoid );

                                        $hash = unserialize(wp_remote_fopen($protocol . "vimeo.com/api/v2/video/" . $vimeoid . ".php"));
                                        $new_slide_data['media_image_url'] = $hash[0]['thumbnail_large'];
                                    } else {
                                        continue;
                                    }

                                    $new_slide_data['media_video_url'] = $add_slide['media_video_url'];
                                } else if($add_slide['media_type'] === 'post') {
                                    if(!isset($add_slide['media_post_id']) || empty($add_slide['media_post_id'])){
                                        continue;
                                    }
                                    $new_slide_data['media_post_id'] = $add_slide['media_post_id'];
                                    $thumbnail = get_post_thumbnail_id($add_slide['media_post_id']);
                                    if(!empty($thumbnail)) {
                                        $new_slide_data['media_image_id'] = $thumbnail;
                                    }
                                    $post = get_post($add_slide['media_post_id']);
                                    $new_slide_data['title'] = $post->post_title;
                                    $new_slide_data['description'] = $post->post_excerpt;
                                }


                                //sort order sync
                                $slidesCount = $slides = $wpdb->get_col($wpdb->prepare('SELECT COUNT(*) as sl_count FROM `' . $slidesTable . '` WHERE slider_id=%d', $slider_id));
                                $slCount = intval($slidesCount[0]);
                                if($slCount > 0) {
                                    $new_slide_data['sort_order'] = $slCount - 1;
                                }

                                $results[] = $wpdb->insert($slidesTable, $new_slide_data);

                            }
                        }
                    }


                    if(isset($_POST['slider_params']) && !empty($_POST['slider_params']) && is_array($_POST['slider_params'])) {
                        $slider_params = $this->sanitizeSliderParams($_POST['slider_params']);

                        $results[] = $wpdb->update($slidersTable, $slider_params, array('id'=>$slider_id));
                    }

                    if(isset($_POST['slides']) && !empty($_POST['slides']) && is_array($_POST['slides'])) {
                        $slides_params = $this->sanitizeSlideParams($_POST['slides']);

                        foreach ($slides_params as $slide_id => $slide_params) {
                            if(isset($remove_id) && $remove_id === $slide_id) {
                                continue;
                            }

                            if($slide_params['media_type'] === 'post'){
                                $post = get_post($slide_params['media_post_id']);
                                $slide_params['title'] = $post->post_title;
                                $slide_params['description'] = $post->post_excerpt;
                                $thumbnail = get_post_thumbnail_id($slide_params['media_post_id']);
                                if(!empty($thumbnail)) {
                                    $slide_params['media_image_id'] = $thumbnail;
                                }
                            }

                            $results[] = $wpdb->update($slidesTable, $slide_params, array('id' => $slide_id));
                        }
                    }

                    $hasErrors = true;
                    if(!empty($results)){
                        foreach ($results as $result) {
                            if(!is_wp_error($result) && false !== $result) {
                                $hasErrors = false;
                            }
                        }
                    }

                    if(!$hasErrors) {
                        set_transient('corefortress_slider_message', 'Slider Updated Successfully',100);
                        set_transient('corefortress_slider_message_class', 'success',100);
                    } else {
                        set_transient('corefortress_slider_message', 'Something went wrong while updating Slider, please try again. If the error keeps showing up try finding solution in <a href="https://wordpress.org/support/plugin/image-responsive-slider/">Community Forums</a>.',100);
                        set_transient('corefortress_slider_message_class', 'error',100);
                    }

                    wp_redirect(admin_url('admin.php?page=corefortress_slider_sliders&action=edit&id='.$slider_id));
                    exit();

                    break;
            }
        }
    }

    private function sanitizeSliderParams($data)
    {
        $sanitizedData = array();
        foreach ($data as $key=>$value) {
            switch ($key) {
                case 'name':
                case 'direction':
                case 'effect':
                    $sanitizedData[$key] = sanitize_text_field($value);
                    break;
                case 'theme_id':
                case 'initialSlide':
                case 'speed':
                case 'grabCursor':
                case 'loop':
                case 'autoSlide':
                case 'stopOnHover':
                case 'autoSlideDelay':
                    $sanitizedData[$key] = absint($value);
                    break;
            }
        }

        return $sanitizedData;
    }

    /**
     * @param $data array
     * @return array
     */
    private function sanitizeSlideParams($data)
    {
        $sanitizedData = array();
        foreach ($data as $slideId => $params){
            $id = absint($slideId);
            $sanitizedData[$id] = array();
            foreach ($params as $key=>$value) {
                switch ($key) {
                    case 'title':
                    case 'link_type':
                    case 'cta_text':
                    case 'media_type':
                        $sanitizedData[$id][$key] = sanitize_text_field($value);
                        break;
                    case 'description':
                        $sanitizedData[$id][$key] = wp_kses_post($value);
                        break;
                    case 'url':
                    case 'media_video_url':
                    case 'media_image_url':
                        $sanitizedData[$id][$key] = esc_url($value);
                        break;
                    case 'slider_id':
                    case 'media_image_id':
                    case 'media_post_id':
                        if(empty($value)){
                            $sanitizedData[$id][$key] = null;
                        } else {
                            $sanitizedData[$id][$key] = absint($value);
                        }
                        break;
                    case 'url_in_new_window':
                    case 'media_video_mute':
                    case 'sort_order':
                        $sanitizedData[$id][$key] = absint($value);
                        break;
                    default:
                        $sanitizedData[$id][$key] = $value;
                }
            }
        }

        return $sanitizedData;
    }

    public function renderPage()
    {
        if(isset($_GET['action']) && !empty($_GET['action'])) {
            $action = sanitize_text_field($_GET['action']);

            switch($action){
                case 'edit':
                    if(!isset($_GET['id']) || empty($_GET['id']) || (absint($_GET['id']) != $_GET['id'])) {
                        wp_die('Invalid Request');
                    }

                    global $wpdb;

                    $id = absint($_GET['id']);
                    $slidersTable = $wpdb->prefix.'corefortress_sliders';
                    $slidesTable = $wpdb->prefix.'corefortress_slides';
                    $slider = $wpdb->get_row($wpdb->prepare('SELECT * FROM `' . $slidersTable . '` WHERE id=%d', $id));
                    $slides = $wpdb->get_results($wpdb->prepare('SELECT * FROM `' . $slidesTable . '` WHERE slider_id=%d order by sort_order asc, id asc', $id));
                    $all_sliders = $wpdb->get_results("SELECT * FROM `".$slidersTable."` order by id desc");
                    $themes = $wpdb->get_results('select id,name from `'.$wpdb->prefix.'corefortress_slider_themes` order by id asc');
                    require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'edit-slider.php';
                    break;
            }
        } else {
            global $wpdb;
            if (isset($_GET['pageno'])) {
                $pageno = absint($_GET['pageno']);
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 20;
            $offset = ($pageno-1) * $no_of_records_per_page;
            $slidersTable = $wpdb->prefix.'corefortress_sliders';
            $slidesTable = $wpdb->prefix.'corefortress_slides';
            $result = $wpdb->get_col("SELECT COUNT(*) as s_count FROM `".$slidersTable."`");
            $total_rows = $result[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $sliders = $wpdb->get_results("SELECT sl.*, (select count(*) from `".$slidesTable."` where slider_id= sl.id ) as sl_count
FROM `".$slidersTable."` as sl 
order by sl.id desc 
LIMIT $offset, $no_of_records_per_page");
            require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'sliders.php';
        }

    }

}