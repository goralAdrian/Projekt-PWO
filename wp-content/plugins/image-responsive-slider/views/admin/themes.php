<?php
/**
 * @var $themes
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<div class="wrap orefortress-admin">
    <?php require COREFORTRESS_SLIDER_PATH . 'views'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'pro-notice.php'; ?>
    <h1 class="wp-heading-inline">Themes</h1>
    <a href="#" onclick="alert('This Feature is available in Premium Version.'); return false;"
       class="page-title-action">Add New<span class="corefortress-pro-icon">PRO</span></a>


    <?php require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'nav-themes.php'; ?>
    <table class="widefat fixed striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($themes) > 0) {

            foreach ($themes as $slider) { ?>
                <tr>
                    <td>
                        <?php echo $slider->id; ?>
                    </td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=corefortress_slider_themes&action=edit&id=' . $slider->id); ?>"><b><?php echo $slider->name; ?></b></a>
                    </td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=corefortress_slider_themes&action=edit&id=' . $slider->id); ?>"
                           class="button button-primary">Edit<span class="corefortress-pro-icon">PRO</span></a>
                        <form style="display:inline-block;"
                              action="<?php echo admin_url('admin.php?page=corefortress_slider_themes&action=delete'); ?>"
                              method="post"
                              onsubmit="return confirm('Do you really want to remove the theme with id <?php echo $slider->id; ?>?');">
                            <?php wp_nonce_field('corefortress_slider_theme_delete'); ?>
                            <input type="hidden" name="id" value="<?php echo $slider->id; ?>" />
                            <input disabled="disabled" type="submit" name="submit" value="Remove" class="button button-secondary"/>
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="4">No themes</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'nav-themes.php'; ?>

</div>
