<?php
/**
 * @var $slider Object
 * @var $all_sliders Object[]
 * @var $slides Object[]
 * @var $themes Object[]
 */

?>





<ul class="corefortress-slider-tabs">
    <?php foreach ($all_sliders as $sl) {
        if ($sl->id !== $slider->id) {
            ?>
            <li>
                <a href="<?php echo admin_url('admin.php?page=corefortress_slider_sliders&action=edit&id=' . $sl->id); ?>"
                   title="#<?php echo $sl->id; ?>"><?php echo $sl->name; ?></a></li>
        <?php } else { ?>
            <li class="corefortress-cur-sl-tab"><span title="#<?php echo $sl->id; ?>"><?php echo $sl->name; ?></span>
            </li>
        <?php }
    }
    ?>
</ul>
<div class="wrap corefortress-admin">
    <?php require COREFORTRESS_SLIDER_PATH . 'views'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'pro-notice.php'; ?>
    <h1 class="wp-heading-inline">Edit Slider</h1>
    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=corefortress_slider_sliders&action=create'), 'corefortress_slider_create'); ?>"
       class="page-title-action">Add New</a>

    <form action="<?php echo admin_url('admin.php?page=corefortress_slider_sliders&action=update') ?>" method="post">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                    <div id="titlediv">
                        <div id="titlewrap">
                            <input title="Slider Name" type="text" name="slider_params[name]" size="30"
                                   value="<?php echo $slider->name; ?>" id="title" class="slider_name_input"
                                   spellcheck="true" autocomplete="off">
                        </div>
                    </div>

                    <div class="corefortress-slider-add-slide-wrap">
                        <div class="corefortress-slider-add-slide-section">
                            <h2>Add Slide</h2>
                            <ul>
                                <li>
                                    <a href="#" class="corefortress-add-image-slide">
                                        <img src="<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/image.svg'; ?>"
                                             alt="Image Slide"/>
                                        <span>Image</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Insert Youtube or Vimeo Video Url" class="corefortress-add-video-slide" onclick="alert('This feature is available in Premium Version.'); return false;">
                                        <img src="<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/video.svg'; ?>"
                                             alt="Video Slide"/>
                                        <span>Video</span><span class="corefortress-pro-icon">PRO</span>
                                    </a>
                                </li>
                                <li>
                                    <a <a href="#" title="Add WP Posts as Slides" onclick="alert('This feature is available in Premium Version.'); return false;" class="corefortress-add-post-slide" >
                                        <img src="<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/post.svg'; ?>"
                                             alt="Post Slide"/>
                                        <span>Post</span><span class="corefortress-pro-icon">PRO</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="corefortress-slider-shortcode-section corefortress-shortcode-wrap">
                            <h2>Shortcode</h2>
                            <input type="text" title="shortcode" readonly="readonly" class="corefortress-shortcode" id="corefortress-shortcode" value="[corefortress_slider id='<?php echo $slider->id; ?>']"/>
                            <div class="corefortress-tooltip">
                                <button class="corefortress-shortcode-copy">
                                    <span class="corefortress-tooltiptext corefortress-shortcode-tooltip">Copy to clipboard</span>
                                    <img src="<?php echo COREFORTRESS_SLIDER_URL.'assets/img/copy.svg'; ?>" alt="copy">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="corefortress-slides-wrap">
                        <?php
                        if (!empty($slides)):

                            foreach ($slides as $slide):
                                switch($slide->media_type) {
                                    case 'image':
                                        require COREFORTRESS_SLIDER_PATH . 'views' .DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'edit-image-slide.php';
                                        break;
                                    case 'video':
                                        require COREFORTRESS_SLIDER_PATH . 'views' .DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'edit-video-slide.php';
                                        break;
                                    case 'post':
                                        require COREFORTRESS_SLIDER_PATH . 'views' .DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'edit-post-slide.php';
                                        break;
                                }
                            endforeach;
                        endif; ?>
                    </div>


                </div>
                <div id="postbox-container-1" class="postbox-container">
                    <div id="submitdiv" class="postbox ">
                        <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Publish</span><span
                                    class="toggle-indicator" aria-hidden="true"></span></button>
                        <h2 class="hndle ui-sortable-handle"><span>Publish</span></h2>
                        <div class="inside">
                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Theme</span>
                                    <select name="slider_params[theme_id]">
                                        <?php foreach ($themes as $theme): ?>
                                            <option <?php if($slider->theme_id === $theme->id) { echo 'selected="selected"'; } ?> value="<?php echo $theme->id; ?>"><?php echo $theme->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Direction</span>
                                    <select name="slider_params[direction]">
                                        <option value="horizontal" <?php if ($slider->direction === 'horizontal') {
                                            echo 'selected="selected"';
                                        } ?> >Horizontal
                                        </option>
                                        <option value="vertical" <?php if ($slider->direction === 'vertical') {
                                            echo 'selected="selected"';
                                        } ?> >Vertical
                                        </option>
                                    </select>
                                </label>
                            </div>
                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Initial Slide Index</span>
                                    <input name="slider_params[initialSlide]" class="corefortress-slider-field-num"
                                           type="number" size="3" min="0" value="<?php echo $slider->initialSlide; ?>">
                                </label>
                            </div>
                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Transition Time</span>
                                    <input name="slider_params[speed]" class="corefortress-slider-field-num"
                                           type="number" min="0" value="<?php echo $slider->speed; ?>">&nbsp;ms
                                </label>
                            </div>
                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Effect</span>
                                    <select name="slider_params[effect]">
                                        <option value="slide" <?php if ($slider->effect === 'slide') {
                                            echo 'selected="selected"';
                                        } ?> >Slide
                                        </option>
                                        <option value="fade" <?php if ($slider->effect === 'fade') {
                                            echo 'selected="selected"';
                                        } ?> >Fade
                                        </option>
                                        <option value="cube" <?php if ($slider->effect === 'cube') {
                                            echo 'selected="selected"';
                                        } ?> >cube
                                        </option>
                                        <option value="coverflow" <?php if ($slider->effect === 'coverflow') {
                                            echo 'selected="selected"';
                                        } ?> >Coverflow
                                        </option>
                                        <option value="flip" <?php if ($slider->effect === 'flip') {
                                            echo 'selected="selected"';
                                        } ?> >Flip
                                        </option>
                                    </select>
                                </label>
                            </div>


                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Use Grab Cursor</span>
                                    <input type="hidden" name="slider_params[grabCursor]" value="0"/>
                                    <input type="checkbox" name="slider_params[grabCursor]"
                                           value="1" <?php if ($slider->grabCursor == 1) {
                                        echo 'checked="checked"';
                                    } ?> />
                                </label>
                            </div>

                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Auto Slide</span>
                                    <input type="hidden" name="slider_params[autoSlide]" value="0"/>
                                    <input type="checkbox" name="slider_params[autoSlide]"
                                           value="1" <?php if ($slider->autoSlide == 1) {
                                        echo 'checked="checked"';
                                    } ?> />
                                </label>
                            </div>

                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Delay</span>
                                    <input type="number" min="1000" name="slider_params[autoSlideDelay]" value="<?php echo $slider->autoSlideDelay; ?>" />
                                </label>
                            </div>

                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Stop On Hover</span>
                                    <input type="hidden" name="slider_params[stopOnHover]" value="0"/>
                                    <input type="checkbox" name="slider_params[stopOnHover]"
                                           value="1" <?php if ($slider->stopOnHover == 1) {
                                        echo 'checked="checked"';
                                    } ?> />
                                </label>
                            </div>

                            <div class="corefortress-slider-publish-field">
                                <label><span class="corefortress-slider-pub-label">Loop</span>
                                    <input type="hidden" name="slider_params[loop]" value="0"/>
                                    <input type="checkbox" name="slider_params[loop]"
                                           value="1" <?php if ($slider->loop == 1) {
                                        echo 'checked="checked"';
                                    } ?> />
                                </label>
                            </div>
                            <div class="submitbox" id="submitpost">

                                <div id="major-publishing-actions">

                                    <div id="publishing-action">
                                        <span class="spinner"></span>
                                        <input name="add_slides" id="add_slides" type="hidden" value=""/>
                                        <input name="remove_slide" id="remove_slide" type="hidden" value=""/>
                                        <input name="id" type="hidden" id="slider_id"
                                               value="<?php echo $slider->id; ?>">
                                        <?php wp_nonce_field('corefortress_slider_update'); ?>
                                        <input name="save" type="submit" class="button button-primary button-large"
                                               id="publish" value="Update">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


</div>
