<?php


namespace CoreFortress\Slider;


class AdminThemes
{

    public function renderPage()
    {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $action = sanitize_text_field($_GET['action']);

            switch ($action) {
                case 'edit':
                    if (!isset($_GET['id']) || empty($_GET['id']) || (absint($_GET['id']) != $_GET['id'])) {
                        wp_die('Invalid Request');
                    }

                    global $wpdb;

                    $id = absint($_GET['id']);
                    $themesTable = $wpdb->prefix . 'corefortress_slider_themes';
                    $theme = $wpdb->get_row($wpdb->prepare('SELECT * FROM `' . $themesTable . '` WHERE id=%d', $id));
                    $themeSettings = json_decode($theme->settings, true);
                    require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'edit-theme.php';
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
            $offset = ($pageno - 1) * $no_of_records_per_page;
            $themesTable = $wpdb->prefix . 'corefortress_slider_themes';
            $result = $wpdb->get_col("SELECT COUNT(*) as s_count FROM `" . $themesTable . "`");
            $total_rows = $result[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $themes = $wpdb->get_results("SELECT * FROM `" . $themesTable . "` order by id desc LIMIT $offset, $no_of_records_per_page");
            require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'themes.php';
        }
    }
}