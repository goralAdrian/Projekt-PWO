<?php
function corefortressSlideContent($slide, $themeSettings) {
    $slideHasContent = !empty($slide->title) || !empty($slide->description) || ($slide->link_type === 'cta' && !empty($slide->cta_text));
    if(true === $themeSettings['background_overlay']): ?>
        <div class="corefortress-slide-overlay"></div>
    <?php endif; ?>
    <?php if ($slideHasContent): ?>
        <div class="corefortress-slide-content">
            <?php if(!empty($slide->title)):?>
                <div class="corefortress-slide-title"><?php echo wp_kses_post($slide->title); ?></div>
            <?php endif;
            if(!empty($slide->description)):?>
                <div class="corefortress-slide-description"><?php echo wp_kses_post($slide->description); ?></div>
            <?php endif;
            if($slide->link_type === 'cta' && !empty($slide->cta_text)):?>
                <div class="corefortress-slide-cta-wrap">
                    <a class="corefortress-slide-cta" href="<?php echo esc_url($slide->url) ?>" <?php if($slide->url_in_new_window == 1) { echo 'target="_blank"'; } ?>><?php echo esc_html($slide->cta_text); ?></a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif;
    if($slide->link_type==='slide'): ?>
        <a class="corefortress-slide-link" href="<?php echo esc_url($slide->url) ?>" <?php if($slide->url_in_new_window == 1) { echo 'target="_blank"'; } ?> ></a>
    <?php endif;
}