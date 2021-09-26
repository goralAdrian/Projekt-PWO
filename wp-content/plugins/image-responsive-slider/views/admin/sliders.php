<?php
/**
 * @var $sliders
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<div class="wrap orefortress-admin">
    <?php require COREFORTRESS_SLIDER_PATH . 'views'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'pro-notice.php'; ?>
    <h1 class="wp-heading-inline">Sliders</h1>
    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=corefortress_slider_sliders&action=create'), 'corefortress_slider_create'); ?>"
       class="page-title-action">Add New</a>


    <?php require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'nav-sliders.php'; ?>
    <table class="corefortress_admin_table widefat fixed striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Shortcode</th>
            <th>Slides Count</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($sliders) > 0) {

            foreach ($sliders as $slider) { ?>
                <tr>
                    <td>
                        <?php echo $slider->id; ?>
                    </td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=corefortress_slider_sliders&action=edit&id=' . $slider->id); ?>"><b><?php echo $slider->name; ?></b></a>
                    </td>
                    <td class="corefortress-shortcode-wrap">
                        <input type="text" title="shortcode" readonly="readonly" class="corefortress-shortcode" value="[corefortress_slider id='<?php echo $slider->id; ?>']"/>
                        <div class="corefortress-tooltip">
                            <button class="corefortress-shortcode-copy">
                                <span class="corefortress-tooltiptext corefortress-shortcode-tooltip">Copy to clipboard</span>
                                <img src="<?php echo COREFORTRESS_SLIDER_URL.'assets/img/copy-dark.svg'; ?>" alt="copy">
                            </button>
                        </div>
                    </td>
                    <td><?php echo $slider->sl_count; ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=corefortress_slider_sliders&action=edit&id=' . $slider->id); ?>"
                           class="button button-primary">Edit</a>
                        <form style="display:inline-block;"
                              action="<?php echo admin_url('admin.php?page=corefortress_slider_sliders&action=delete'); ?>"
                              method="post"
                              onsubmit="return confirm('Do you really want to remove the slider with id <?php echo $slider->id; ?>?');">
                            <?php wp_nonce_field('corefortress_slider_delete'); ?>
                            <input type="hidden" name="id" value="<?php echo $slider->id; ?>" />
                            <input type="submit" name="submit" value="Remove" class="button button-secondary"/>
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="4">No Sliders</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php require COREFORTRESS_SLIDER_PATH . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'nav-sliders.php'; ?>

</div>
