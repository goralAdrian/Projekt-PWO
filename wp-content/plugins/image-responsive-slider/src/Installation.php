<?php


namespace CoreFortress\Slider;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Installation
{

    public static function install()
    {
        //check if already installed
        if (COREFORTRESS_SLIDER_VERSION == get_option('corefortress_slider_version')) {
            return;
        }

        global $wpdb;

        $themesTable = $wpdb->prefix.'corefortress_slider_themes';
        $query = 'CREATE TABLE IF NOT EXISTS `' . $themesTable . '` ( 
`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(200) NOT NULL, 
`settings` LONGTEXT NULL,
`created_at` DATETIME NOT NULL,
`updated_at` DATETIME NOT NULL,
PRIMARY KEY (`id`)
);';
        $wpdb->query($query);

        $existingThemes = $wpdb->get_results('select id from ' . $themesTable);

        if(empty($existingThemes)){
            $themes = new Themes();
            $hero = json_encode($themes->getFullWidHeroThemeSettings());
            $showcase = json_encode($themes->getProductShowcaseThemeSettings());
            $minimalist = json_encode($themes->getMinimalistThemeSettings());
            $now = date("Y-m-d H:i:s");
            $wpdb->insert($themesTable, array(
                'name' => 'Full Width Hero',
                'settings' => $hero,
                'created_at' => $now,
                'updated_at' => $now,
            ));
            $wpdb->insert($themesTable, array(
                'name' => 'Product Showcase',
                'settings' => $showcase,
                'created_at' => $now,
                'updated_at' => $now,
            ));
            $wpdb->insert($themesTable, array(
                'name' => 'Minimalist',
                'settings' => $minimalist,
                'created_at' => $now,
                'updated_at' => $now,
            ));
        }



        $slidersTable = $wpdb->prefix.'corefortress_sliders';

        $query = 'CREATE TABLE IF NOT EXISTS `' . $slidersTable . '` ( 
`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, 
`theme_id` BIGINT(20) UNSIGNED NOT NULL, 
`name` TEXT NULL, 
`initialSlide` INT(20) NOT NULL DEFAULT \'0\',
`direction` VARCHAR(100) NOT NULL DEFAULT \'horizontal\',
`speed` INT(20) NOT NULL DEFAULT \'300\',
`effect` VARCHAR(100) NOT NULL DEFAULT \'slide\',
`autoSlide` TINYINT(1) NOT NULL DEFAULT \'1\',
`autoSlideDelay` INT(20) NOT NULL DEFAULT \'5000\',
`stopOnHover` TINYINT(1) NOT NULL DEFAULT \'1\',
`grabCursor` TINYINT(1) NOT NULL DEFAULT \'1\',
`loop` TINYINT(1) NOT NULL DEFAULT \'1\',
PRIMARY KEY (`id`),
FOREIGN KEY (theme_id) REFERENCES '.$themesTable.'(id) ON DELETE RESTRICT
);';

        $wpdb->query($query);


        $slidesTable = $wpdb->prefix.'corefortress_slides';
        $query = 'CREATE TABLE IF NOT EXISTS `' . $slidesTable . '` ( 
`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, 
`slider_id` BIGINT(20) UNSIGNED NOT NULL, 
`title` TEXT NULL, 
`description` TEXT NULL,
`link_type` VARCHAR(100) NOT NULL DEFAULT \'slide\',
`cta_text` TEXT NULL, 
`url` TEXT NULL,
`url_in_new_window` TINYINT(1) NOT NULL DEFAULT \'0\',
`media_type` VARCHAR(100) NOT NULL DEFAULT \'image\',
`media_image_id` BIGINT(20) UNSIGNED NULL,
`media_image_url` TEXT NULL,
`media_video_url` TEXT NULL,
`media_post_id` BIGINT(20) UNSIGNED NULL,
`media_video_mute` TINYINT(1) NOT NULL DEFAULT \'0\',
`sort_order` INT(10) NOT NULL DEFAULT \'0\', 
PRIMARY KEY (`id`),
FOREIGN KEY (slider_id) REFERENCES '.$slidersTable.'(id) ON DELETE CASCADE,
FOREIGN KEY (media_image_id) REFERENCES '.$wpdb->posts.'(ID) ON DELETE CASCADE,
FOREIGN KEY (media_post_id  ) REFERENCES '.$wpdb->posts.'(ID) ON DELETE CASCADE
);';

        $wpdb->query($query);

        update_option('corefortress_slider_version', COREFORTRESS_SLIDER_VERSION);
    }

}