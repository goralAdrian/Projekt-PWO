<?php
/**
 * @var $slide Object
 * @var $slider Object
 */
?>
<div class="corefortress-slide-wrap" data-slide-id="<?php echo $slide->id; ?>">
    <input type="hidden" name="slides[<?php echo $slide->id ?>][media_type]" value="image" />
    <input type="hidden" class="corefortress-slide-sort-order" name="slides[<?php echo $slide->id ?>][sort_order]" value="<?php echo $slide->sort_order; ?>" />
    <span class="corefortress-slide-close-editor">X</span>
    <div class="corefortress-slide-img">
        <div class="corefortress-slide-img-wrap">
            <img src="<?php echo wp_get_attachment_url($slide->media_image_id); ?>" class="corefortress-slide-img-content" alt="<?php echo $slide->id ?>" />
            <span class="corefortress-slide-img-open-editor"></span>
        </div>
        <input type="hidden" name="slides[<?php echo $slide->id ?>][media_image_id]" class="corefortress-slide-media-image-id" value="<?php echo $slide->media_image_id; ?>" />
        <span class="corefortress-slide-meta corefortress-image-slide-meta">Image</span>
    </div>
    <div class="corefortress-slide-img-info">
        <div class="corefortress-slide-img-info-field">
            <a href="#" class="corefortress-slide-change-image button button-primary">Change Image</a>
            <a href="#" style="float:right;" class="corefortress-slide-remove-image button button-secondary">Remove Slide</a>
        </div>
        <div class="corefortress-slide-img-info-field">
            <label><span class="corefortress-slide-field-label">Title</span>
                <input class="corefortress-slide-field-full-width" type="text" name="slides[<?php echo $slide->id ?>][title]" value="<?php echo esc_attr($slide->title) ?>" />
            </label>
        </div>
        <div class="corefortress-slide-img-info-field">
            <label><span class="corefortress-slide-field-label">Description</span>
                <textarea name="slides[<?php echo $slide->id ?>][description]"><?php echo esc_attr($slide->description) ?></textarea>
            </label>
        </div>
        <div class="corefortress-slide-img-info-field">
            <label><span class="corefortress-slide-field-label">Link Type</span>
                <select class="corefortress-link-type" name="slides[<?php echo $slide->id ?>][link_type]">
                    <option value="slide" <?php if($slide->link_type === 'slide') { echo 'selected="selected"'; } ?> >Slide</option>
                    <option value="cta" <?php if($slide->link_type === 'cta') { echo 'selected="selected"'; } ?> >CTA Button</option>
                </select>
            </label>
        </div>
        <div class="corefortress-slide-img-info-field corefortress-slide-img-multi" >
            <label class="corefortress-cta-btn-field <?php if($slide->link_type !== 'cta'){ echo 'corefortress-hidden'; } ?>"><span class="corefortress-slide-field-label">CTA Button Text</span>
                <input type="text" name="slides[<?php echo $slide->id ?>][cta_text]" value="<?php echo $slide->cta_text; ?>" />
            </label>
            <label><span class="corefortress-slide-field-label">URL</span>
                <input type="text" name="slides[<?php echo $slide->id ?>][url]" value="<?php echo $slide->url; ?>" />
            </label>
            <label class="corefortress-slide-img-url-option">
                <span class="corefortress-slide-field-label">Open In New Window</span>
                <input type="hidden" name="slides[<?php echo $slide->id ?>][url_in_new_window]" value="0"/>
                <input type="checkbox" name="slides[<?php echo $slide->id ?>][url_in_new_window]"
                       value="1" <?php if ($slide->url_in_new_window == 1) {
                    echo 'checked="checked"';
                } ?> />
            </label>
        </div>

    </div>
</div>
