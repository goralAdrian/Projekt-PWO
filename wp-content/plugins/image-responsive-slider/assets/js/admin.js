const coreftSliderIsLodash = () => {
    let coreftSliderIsLodash = false;

    // If _ is defined and the function _.forEach exists then we know underscore OR lodash are in place
    if ( 'undefined' != typeof( _ ) && 'function' == typeof( _.forEach ) ) {

        // A small sample of some of the functions that exist in lodash but not underscore
        const funcs = [ 'get', 'set', 'at', 'cloneDeep' ];

        // Simplest if assume exists to start
        coreftSliderIsLodash  = true;

        funcs.forEach( function ( func ) {
            // If just one of the functions do not exist, then not lodash
            coreftSliderIsLodash = ( 'function' != typeof( _[ func ] ) ) ? false : coreftSliderIsLodash;
        } );
    }

    if ( coreftSliderIsLodash ) {
        // We know that lodash is loaded in the _ variable
        return true;
    } else {
        // We know that lodash is NOT loaded
        return false;
    }
};


jQuery(document).on('ready', function () {
    var coreftSliderLodashCounter = 0
    var coreftSliderLodashInterval = setInterval(function(){
        if ( coreftSliderIsLodash() ) {
            _.noConflict();
            clearInterval(coreftSliderLodashInterval);
        } else if(coreftSliderLodashCounter > 20) {
            clearInterval(coreftSliderLodashInterval);
        }
        coreftSliderLodashCounter++;
    }, 1000);

    let proNoticeBtn = jQuery('.corefortress-pro-dismiss');

    if (proNoticeBtn.length) {
       proNoticeBtn.on('click', function(){
           jQuery('.corefortress-pro-notice').fadeOut(150);
           jQuery.ajax(corefortressAdminL10nn.ajaxUrl, {
               method: "POST",
               data: {action: 'corefortress_dismiss_pro_notice'},
               dataType: 'json'
           }).done(function (res) {

           });
       });
    }

    let themeForm = jQuery('#corefortress-theme-form');

    if(themeForm.length){
        themeForm.on('submit', function(e){
            e.preventDefault();
            alert('Editing Themes is available in paid version only');
            return false;
        });
    }

    var themeSections = jQuery('.corefortress-theme-editor-wrap');

    if (themeSections.length) {
        window.themeEditorMasonry = themeSections.masonry({
            gutter: 15,
            itemSelector: '.corefortress-theme-editor-section',
        });
    }

    jQuery('.corefortress_add_post_slide_submit').on('click', function () {
        var add_slides_json = [];
        jQuery('.corefortress_add_post_slide_list li.corefortress-active').each(function (i, el) {
            add_slides_json.push({
                media_type: 'post',
                media_post_id: jQuery(el).data('post-id')
            });
        });
        jQuery('#add_slides').val(JSON.stringify(add_slides_json));
        jQuery('#publish').click();
    });

    var postSlideSearchXHR = null;
    jQuery('.corefortress_add_post_slide_search').on('keyup', function () {
        if (postSlideSearchXHR != null) postSlideSearchXHR.abort();

        var val = jQuery(this).val();

        if (!jQuery('.corefortress_add_post_slide_search_results').is(':visible')) {
            jQuery('.corefortress_add_post_slide_search_results').show();
        }

        let loadSvgAnimated = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block; shape-rendering:' +
            'auto;" width="45px" height="45px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">' +
            '<circle cx="50" cy="50" r="32" stroke-width="8" stroke="#10d0a0" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round" transform="rotate(306.261 50 50)">' +
            '<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>' +
            '</circle></svg>';

        if (!jQuery('.corefortress_add_post_slide_search_loading').length) {
            jQuery('.corefortress_add_post_slide_search_results').append('<div class="corefortress_add_post_slide_search_loading">' + loadSvgAnimated + '</div>');
        }

        if (jQuery('.corefortress_add_post_slide_search_results_empty').length) {
            jQuery('.corefortress_add_post_slide_search_results_empty').remove();
        }

        jQuery('.corefortress_add_post_slide_search_results .corefortress_add_post_slide_list li:not(.corefortress-active)').remove();


        postSlideSearchXHR = jQuery.ajax(corefortressAdminL10nn.ajaxUrl, {
            method: "POST",
            data: {s: val, action: 'corefortress_post_search_ajax'},
            dataType: 'json'
        }).done(function (res) {
            jQuery('.corefortress_add_post_slide_search_loading').remove();
            postSlideSearchXHR = null;
            if (res.success && res.data && res.data.length) {
                res.data.forEach(function (post) {
                    jQuery('.corefortress_add_post_slide_search_results .corefortress_add_post_slide_list').append('<li data-post-id="' + post.ID + '">' + post.post_title + '</li>');
                });
            } else {
                jQuery('.corefortress_add_post_slide_search_results').append('<p class="corefortress_add_post_slide_search_results_empty">Search results are empty</p>');
            }
        });
    })

    jQuery('.corefortress_add_post_slide_list').on('click', 'li', function () {
        jQuery(this).toggleClass('corefortress-active');
    });

    jQuery('.corefortress_add_video_slide_submit').on('click', function () {
        var add_slides_json = [];

        jQuery('.corefortress_new_video_url').each(function (i, urlInput) {
            add_slides_json.push({
                media_type: 'video',
                media_video_url: jQuery(urlInput).val()
            });
        });

        jQuery('#add_slides').val(JSON.stringify(add_slides_json));
        jQuery('#publish').click();
    });

    jQuery('.corefortress_add_more_video_slide').on('click', function () {
        jQuery('.corefortress_add_video_slide_urls_wrap').append('<input type="url" name="corefortress_new_video_url[]" class="corefortress-full-width corefortress_new_video_url" title="Video Url" placeholder="https://..." />');
    });

    jQuery('.corefortress-shortcode-copy').on('click', function (e) {
        e.preventDefault();
        var copyText = jQuery(this).closest('.corefortress-shortcode-wrap').find('input')[0];
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");

        var tooltip = jQuery(this).closest('.corefortress-shortcode-wrap').find('.corefortress-shortcode-tooltip')[0];
        tooltip.innerHTML = "Copied";
        return false;
    });

    jQuery('.corefortress-shortcode-copy').on('mouseout', function () {
        var tooltip = jQuery(this).closest('.corefortress-shortcode-wrap').find('.corefortress-shortcode-tooltip')[0];
        tooltip.innerHTML = "Copy to clipboard";
    });

    jQuery('.corefortress-link-type').on('change', function () {
        if (jQuery(this).val() === 'cta') {
            jQuery('.corefortress-cta-btn-field').removeClass('corefortress-hidden');
        } else if (!jQuery('.corefortress-cta-btn-field').hasClass('corefortress-hidden')) {
            jQuery('.corefortress-cta-btn-field').addClass('corefortress-hidden')
        }
    });

    jQuery('.corefortress-slide-remove-image').on('click', function (e) {
        e.preventDefault();
        if (confirm('Are you sure?')) {
            var id = jQuery(this).closest('.corefortress-slide-wrap').data('slide-id');
            jQuery('#remove_slide').val(id);
            jQuery('#publish').click();
        }
    });

    let slidesWrap = jQuery('.corefortress-slides-wrap');

    if (slidesWrap.length) {
        slidesWrap.sortable({
            stop: function () {
                var slides = jQuery('.corefortress-slide-wrap');
                slides.each(function (i, slideWrap) {
                    jQuery(slideWrap).find('.corefortress-slide-sort-order').val(i);
                });
            }
        });
    }

    jQuery('.corefortress-slide-img-open-editor').on('click', function (e) {
        let wrap = jQuery(this).closest('.corefortress-slide-wrap');
        if (!wrap.hasClass('corefortress-slide-editing')) {
            wrap.addClass('corefortress-slide-editing');
        }
    });

    jQuery('.corefortress-slide-close-editor').on('click', function () {
        jQuery(this).closest('.corefortress-slide-wrap').removeClass('corefortress-slide-editing');
    });

    var rangeSliders = jQuery('.corefortress-field-slider');

    if (rangeSliders.length) {
        rangeSliders.on('input', function () {
            jQuery(this).parent().find('span.corefortress-field-slider-val').text(jQuery(this).val());
        });
    }


    var colorpickers = jQuery('.corefortress-color-field');

    if (colorpickers.length) {
        colorpickers.wpColorPicker();
    }

    var sliderNameInput = jQuery('.slider_name_input');
    if (sliderNameInput.length) {
        sliderNameInput.on('keyup', function () {
            var val = jQuery(this).val();
            jQuery('.corefortress-cur-sl-tab span').text(val);
        });
    }

    var sliderChangeImage = jQuery('.corefortress-slide-change-image');

    if (sliderChangeImage.length) {
        var changeImageMediaLibrary = window.wp.media({
            frame: 'select',
            title: 'Select Image',
            multiple: false,
            library: {
                order: 'DESC',
                orderby: 'date',
                type: 'image',
                search: null,
                uploadedTo: null,
                slide_id: null
            },
            button: {
                text: 'Done'
            }
        });
        changeImageMediaLibrary.on('select', function () {
            var selectedImage = changeImageMediaLibrary.state().get('selection').first();
            if (!selectedImage) {
                return;
            }

            var wrap = jQuery('.corefortress-slide-wrap[data-slide-id="' + changeImageMediaLibrary.slide_id + '"]');
            wrap.find('.corefortress-slide-img-content').attr('src', selectedImage.attributes.url);
            wrap.find('.corefortress-slide-media-image-id').val(selectedImage.attributes.id);
            var videoDefaultImageBtn = wrap.find('.corefortress-slide-set-default-image');

            if (videoDefaultImageBtn.length) {
                videoDefaultImageBtn.show();
            }
        });
        sliderChangeImage.on('click', function (e) {
            e.preventDefault();
            changeImageMediaLibrary.open();
            changeImageMediaLibrary.slide_id = jQuery(this).closest('.corefortress-slide-wrap').data('slide-id');
            return false;
        });
    }

    jQuery('.corefortress-slide-set-default-image').on('click', function (e) {
        e.preventDefault();
        var wrap = jQuery(this).closest('.corefortress-slide-wrap');
        wrap.find('.corefortress-slide-img-content').attr('src', wrap.find('.corefortress-slide-media-image-url').val());
        wrap.find('.corefortress-slide-media-image-id').val('');
        jQuery(this).hide();
        return false;
    });

    var sliderAddImage = jQuery('.corefortress-add-image-slide');

    if (sliderAddImage.length) {
        var imageMediaLibrary = window.wp.media({
            frame: 'select',
            title: 'Select Image(s)',
            multiple: true,
            library: {
                order: 'DESC',
                orderby: 'date',
                type: 'image',
                search: null,
                uploadedTo: null
            },
            button: {
                text: 'Done'
            }
        });
        imageMediaLibrary.on('select', function () {
            var selectedImages = imageMediaLibrary.state().get('selection');
            if (!selectedImages.length) {
                return;
            }

            var add_slides_json = [];

            selectedImages.forEach(function (image) {
                add_slides_json.push({
                    media_type: 'image',
                    media_image_id: image.attributes.id
                });
            });

            jQuery('#add_slides').val(JSON.stringify(add_slides_json));
            jQuery('#publish').click();
        });
        sliderAddImage.on('click', function (e) {
            e.preventDefault();
            imageMediaLibrary.open();
            return false;
        });
    }
});