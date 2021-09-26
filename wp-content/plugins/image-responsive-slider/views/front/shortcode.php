<?php
/**
 * @var $slider Object
 * @var $slides Object[]
 * @var $theme array
 * @var $themeSettings array
 */
$randId = uniqid();


?>
<div class="corefortress-slider-wrap" id="corefortress_slider_wrap_<?php echo $randId ?>">
    <div class="corefortress-slider-container swiper-container" id="corefortress_slider_<?php echo $randId ?>"
         data-lazy="<?php if ($themeSettings['lazy_loading'] == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
         data-direction="<?php echo $slider->direction; ?>"
         data-initial="<?php echo $slider->initialSlide; ?>"
         data-speed="<?php echo $slider->speed; ?>"
         data-effect="<?php echo $slider->effect; ?>"
         data-autoslidedelay="<?php echo $slider->autoSlideDelay; ?>"
         data-thumbsheight="<?php echo $themeSettings['thumbs_height']; ?>"
         data-thumbsperview="<?php echo $themeSettings['thumbs_per_view']; ?>"
         data-haspagination="<?php if ($themeSettings['use_pagination'] == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
         data-paginationtype="<?php echo $themeSettings['pagination_type']; ?>"
         data-navigationarrows="<?php if ($themeSettings['navigation_arrows'] == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
         data-grabcursor="<?php if ($slider->grabCursor == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
         data-autoslide="<?php if ($slider->autoSlide == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
         data-stoponhover="<?php if ($slider->stopOnHover == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
         data-loop="<?php if ($slider->loop == 1) {
             echo 'true';
         } else {
             echo 'false';
         } ?>"
    >
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide):
                $slideUniqId = uniqid();
                ?>

                <?php switch ($slide->media_type) {
                case 'image': ?>
                    <div class="swiper-slide" data-media-type="<?php echo $slide->media_type; ?>"
                         data-id="<?php echo $slideUniqId; ?>">
                        <img class="corefortress-slide-img-bg"
                             src="<?php echo wp_get_attachment_url($slide->media_image_id); ?>"
                             alt="<?php echo $slider->name; ?>"/>
                        <?php corefortressSlideContent($slide, $themeSettings); ?>
                    </div>
                    <?php break;
                case 'video':
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $slide->media_video_url, $match)) {
                        $youtube_id = $match[1];
                        $new_slide_data['media_image_url'] = 'http://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';
                        ?>
                        <div class="swiper-slide" data-id="<?php echo $slideUniqId; ?>" data-video-id="<?php echo $youtube_id; ?>" data-mute="<?php if($slide->media_video_mute == 1) { echo 'true'; } else { echo 'false'; } ?>" data-media-type="youtube">
                            <div class="corefortress-slider-yt-player"></div>
                            <div class="corefortress-slider-yt-overlay"></div>
                            <?php corefortressSlideContent($slide, $themeSettings); ?>
                        </div>
                        <?php
                    } elseif (strpos($slide->media_video_url, 'vimeo') !== false) {
                        $vimeoid = explode("/", $slide->media_video_url);
                        $vimeoid = end($vimeoid);
                        ?>
                        <div class="swiper-slide" data-id="<?php echo $slideUniqId; ?>" data-mute="<?php if($slide->media_video_mute == 1) { echo 'true'; } else { echo 'false'; } ?>" data-media-type="vimeo">

                            <iframe class="corefortress-slider-vimeo-player?background=true" width="100%" height="100%"
                                    data-vimeo-background="true" data-vimeo-conrols="false"
                                    src="https://player.vimeo.com/video/<?php echo $vimeoid; ?>" frameborder="0"
                                    webkitallowfullscreen mozallowfullscreen allowfullscreen
                                    allow="autoplay; scripts"></iframe>
                            <div class="corefortress-slider-vimeo-overlay"></div>
                            <?php corefortressSlideContent($slide, $themeSettings); ?>
                        </div>
                        <?php
                    } else {
                        continue 2;
                    }
                    break;
                case 'post': ?>
                    <div class="swiper-slide" data-id="<?php echo $slideUniqId; ?>" data-media-type="post">
                        <img class="corefortress-slide-img-bg" src="<?php if (!empty($slide->media_image_url)) {
                            echo esc_url($slide->media_image_url);
                        } else {
                            echo wp_get_attachment_url($slide->media_image_id);
                        } ?>" alt="<?php echo $slide->title; ?>"/>
                        <?php corefortressSlideContent($slide, $themeSettings); ?>
                    </div>
                    <?php break;
            } ?>
            <?php endforeach; ?>
        </div>
        <?php if($themeSettings['navigation_arrows'] == 1): ?>
        <div class="corefortress-swiper-button-next"></div>
        <div class="corefortress-swiper-button-prev"></div>
        <?php endif; ?>

        <?php if($themeSettings['use_pagination'] == 1): ?>
            <div class="corefortress-swiper-pagination"></div>
        <?php endif; ?>
    </div>

    <?php if($themeSettings['use_thumbnails'] == 1): ?>
        <div class="swiper-container corefortress-gallery-thumbs" id="corefortress_slider_thumbs_<?php echo $randId ?>">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide):
                    $thumbImgUrl = '';
                    switch($slide->media_type){
                        case 'image':
                            $thumbImgUrl = wp_get_attachment_url($slide->media_image_id);
                            break;
                        case 'video':
                            if(!empty($slide->media_image_id)){
                                $thumbImgUrl = wp_get_attachment_url($slide->media_image_id);
                            } else {
                                $thumbImgUrl = esc_url($slide->media_image_url);
                            }
                            break;
                        case 'post':
                            if (!empty($slide->media_image_url)) {
                                $thumbImgUrl = esc_url($slide->media_image_url);
                            } else {
                                $thumbImgUrl = wp_get_attachment_url($slide->media_image_id);
                            }
                            break;
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="corefortress-thumb-bg" style="background-image:url('<?php echo $thumbImgUrl ?>')"></div>
                        <img src="<?php echo $thumbImgUrl; ?>" alt="<?php echo esc_attr($slide->title); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>



<style>
    #corefortress_slider_wrap_<?php echo $randId ?> {
        position: static;
        max-width: none !important;
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['background']), ($themeSettings['background_opacity'] === 0 ? 0 : $themeSettings['background_opacity']/100)); ?>;
        border: <?php echo absint($themeSettings['border_size']); ?>px <?php echo esc_attr($themeSettings['border_style']); ?> <?php echo $themeSettings['border_color'] ?>;
    <?php if ($themeSettings['use_fixed_width']): ?> width: <?php echo absint($themeSettings['fixed_width']); ?>px !important;
    <?php else: ?> width: <?php echo absint($themeSettings['percent_width']); ?>% !important;
    <?php endif; ?>
    margin: <?php echo $themeSettings['margin_top']; ?>px <?php echo $themeSettings['margin_right']; ?>px <?php echo $themeSettings['margin_bottom']; ?>px <?php echo $themeSettings['margin_left']; ?>px;
    }

    <?php if($themeSettings['use_thumbnails'] == 1){
        if($themeSettings['thumbs_position'] == 'top') : ?>
    #corefortress_slider_wrap_<?php echo $randId ?> {
        display: flex;
        flex-direction: column-reverse;
        align-items: flex-start;
        justify-content: flex-start;
    }
        <?php endif;
    } ?>

    #corefortress_slider_<?php echo $randId ?> {
        position: relative;
        width: 100%;
    <?php if($themeSettings['use_fixed_height']):?> height: <?php echo $themeSettings['fixed_height']; ?>px;
    <?php else: ?> min-height: 300px;
    <?php endif; ?>
    }

    #corefortress_slider_<?php echo $randId ?> .swiper-slide {
        <?php if($slider->effect !== 'coverflow'): ?>
        width: 100%;
        <?php else: ?>
        width: 300px;
        height: 300px;
        <?php endif; ?>
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-slide-overlay {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['background_overlay_color']), ($themeSettings['background_overlay_opacity'] === 0 ? 0 : $themeSettings['background_overlay_opacity']/100)); ?>;
        z-index: 1;
    }

    .corefortress-slide-content {
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin: <?php echo $themeSettings['content_margin_top'] ?>px <?php echo $themeSettings['content_margin_right'] ?>px <?php echo $themeSettings['content_margin_bottom'] ?>px <?php echo $themeSettings['content_margin_left'] ?>px;
        position: absolute;
        text-align: <?php echo $themeSettings['content_pos_horizontal']; ?>;
    <?php switch($themeSettings['content_pos_horizontal']){
         case 'left': ?> align-items: flex-start;
        left: 0;
    <?php break;
    case 'center': ?> align-items: center;
        left: 50%;
        transform: translateX(-50%);
    <?php break;
    case 'right': ?> align-items: flex-end;
        right: 0;
    <?php break; } ?><?php switch($themeSettings['content_pos_vertical']){
        case "top": ?> top: 0;
    <?php break;
 case "center": ?> top: 50%;
        transform: translateY(-50%)<?php if($themeSettings['content_pos_horizontal'] == 'center') { echo 'translateX(-50%)'; } ?>;
    <?php break;
    case "bottom": ?> bottom: 0;
    <?php break;
} ?> width: <?php echo $themeSettings['content_width_percent']; ?>%;
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['content_background_color']), ($themeSettings['content_background_opacity'] === 0 ? $themeSettings['content_background_opacity']: $themeSettings['content_background_opacity']/100)); ?>;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-slide-title {
        font-size: <?php echo $themeSettings['title_font_size']; ?>px;
        color: <?php echo $themeSettings['title_font_color']; ?>;
        margin: <?php echo $themeSettings['title_margin_top'] ?>px <?php echo $themeSettings['title_margin_right'] ?>px <?php echo $themeSettings['title_margin_bottom'] ?>px <?php echo $themeSettings['title_margin_left'] ?>px;
        border: <?php echo $themeSettings['title_border_size'] ?>px <?php echo $themeSettings['title_border_style'] ?> <?php echo $themeSettings['title_border_color'] ?>;
        border-radius: <?php echo $themeSettings['title_border_radius']; ?>px;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-slide-description {
        font-size: <?php echo $themeSettings['description_font_size']; ?>px;
        color: <?php echo $themeSettings['description_font_color']; ?>;
        margin: <?php echo $themeSettings['description_margin_top'] ?>px <?php echo $themeSettings['description_margin_right'] ?>px <?php echo $themeSettings['description_margin_bottom'] ?>px <?php echo $themeSettings['description_margin_left'] ?>px;
        border: <?php echo $themeSettings['description_border_size'] ?>px <?php echo $themeSettings['description_border_style'] ?> <?php echo $themeSettings['description_border_color'] ?>;
        border-radius: <?php echo $themeSettings['description_border_radius']; ?>px;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-slide-cta-wrap {
        z-index: 3;
        margin: <?php echo $themeSettings['cta_button_margin_top'] ?>px <?php echo $themeSettings['cta_button_margin_right'] ?>px <?php echo $themeSettings['cta_button_margin_bottom'] ?>px <?php echo $themeSettings['cta_button_margin_left'] ?>px;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-slide-cta {
        display: inline-block;
        text-decoration: none;
        font-size: <?php echo $themeSettings['cta_button_font_size']; ?>px;
        height: <?php echo $themeSettings['cta_button_height']; ?>px;
        line-height: <?php echo $themeSettings['cta_button_height']; ?>px;
        padding: 0 <?php echo $themeSettings['cta_button_padding_horizontal']; ?>px;
        color: <?php echo $themeSettings['cta_button_font_color']; ?>;
        background-color: <?php echo $themeSettings['cta_button_background_color']; ?>;
        border: none;
        border-radius: <?php echo $themeSettings['cta_button_border_radius']; ?>px;
        white-space: nowrap;
        box-shadow: none;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-slide-link {
        z-index: 3;
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: transparent;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-button-next,
    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-button-prev {
        position: absolute;
        top: 50%;
        width: 40px;
        height: 40px;
        transform: translateY(-50%);
        z-index: 10;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: 40px 40px;
        background-repeat: no-repeat;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-button-prev {
        left: 10px;
        right: auto;
        background-image: url(<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/arrows/' . $themeSettings['navigation_arrows_style'] . 'left.svg'; ?>)
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-button-next {
        right: 10px;
        left: auto;
        background-image: url(<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/arrows/' . $themeSettings['navigation_arrows_style'] . 'right.svg'; ?>)
    }

    #corefortress_slider_thumbs_<?php echo $randId ?> {
        height: <?php echo $themeSettings['thumbs_height'] ?>px;
        box-sizing: border-box;
        padding: 10px 0;
        width: 100%;
    }
    #corefortress_slider_thumbs_<?php echo $randId ?> .swiper-slide {
        height: 100%;
        opacity: 0.4;
        cursor:pointer;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    .corefortress-thumb-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        filter: blur(30px);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        z-index:0;
    }

    #corefortress_slider_thumbs_<?php echo $randId ?> .swiper-slide img {
        max-width: 100%;
        max-height: 100%;
        z-index: 1;
    }
     .swiper-slide-thumb-active {
        opacity: 1;
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination {
        position: absolute;
        text-align: center;
        transition: .3s opacity;
        transform: translate3d(0,0,0);
        z-index: 10;
        <?php if($themeSettings['pagination_pos'] === 'top'):
         if($themeSettings['pagination_type'] === 'dots'){ ?>
            top: 10px;
            bottom: auto;
        <?php } else { ?>
            top:0;
            bottom: auto;
        <?php } ?>
        <?php else:
        if ($themeSettings['pagination_type'] !== 'dots') { ?>
            bottom: 0;
        <?php } ?>

        <?php endif; ?>
    }



    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination .swiper-pagination-bullet {
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['pagination_background_color']), ($themeSettings['pagination_background_opacity'] === 0 ? $themeSettings['pagination_background_opacity']: $themeSettings['pagination_background_opacity']/100)); ?>
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active {
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['pagination_active_background']), ($themeSettings['pagination_active_background_opacity'] === 0 ? $themeSettings['pagination_active_background_opacity']: $themeSettings['pagination_active_background_opacity']/100)); ?>
    }

    <?php if($themeSettings['pagination_type'] === 'fraction'): ?>
    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination {
        color: <?php echo $themeSettings['pagination_background_color']; ?>;
        opacity: <?php echo ($themeSettings['pagination_background_opacity'] === 0 ? $themeSettings['pagination_background_opacity']: $themeSettings['pagination_background_opacity']/100); ?>
    }

    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination .swiper-pagination-current {
        color: <?php echo $themeSettings['pagination_active_background']; ?>;
        opacity: <?php echo ($themeSettings['pagination_active_background_opacity'] === 0 ? $themeSettings['pagination_active_background_opacity']: $themeSettings['pagination_active_background_opacity']/100); ?>
    }
    <?php elseif($themeSettings['pagination_type'] === 'progressbar'): ?>
    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination {
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['pagination_background_color']), ($themeSettings['pagination_background_opacity'] === 0 ? $themeSettings['pagination_background_opacity']: $themeSettings['pagination_background_opacity']/100)); ?>
    }
    #corefortress_slider_<?php echo $randId ?> .corefortress-swiper-pagination .swiper-pagination-progressbar-fill {
        background-color: <?php echo $GLOBALS['corefortress_slider']->hex2rgba(esc_attr($themeSettings['pagination_active_background']), ($themeSettings['pagination_active_background_opacity'] === 0 ? $themeSettings['pagination_active_background_opacity']: $themeSettings['pagination_active_background_opacity']/100)); ?>
    }
    <?php endif; ?>

</style>