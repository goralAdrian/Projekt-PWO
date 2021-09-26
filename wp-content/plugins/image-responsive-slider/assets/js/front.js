var youtubeTag = document.createElement('script');
var firstScriptTag

youtubeTag.src = "https://www.youtube.com/iframe_api";
firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(youtubeTag, firstScriptTag);

var vimeoTag = document.createElement('script');
vimeoTag.src = 'https://player.vimeo.com/api/player.js';
firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(vimeoTag, firstScriptTag);

var youtubeApiReady = false;

function onYouTubeIframeAPIReady() {
    youtubeApiReady = true;
}

jQuery(document).on('ready', function () {
    var sliders = jQuery('.corefortress-slider-wrap');


    if (sliders.length) {
        var swipers = {};
        var youtubePlayers = {};
        var vimeoPlayers = {};
        var autoslideTimers = {};

        function initYTPlayer(sliderId, slideId, elId, videoId, index, mute) {
            if (youtubeApiReady) {
                youtubePlayers[slideId] = new YT.Player(elId, {
                    videoId: videoId,
                    height: '390',
                    width: '640',
                    playerVars: {
                        'fs': 0,
                        'modestbranding': 0,
                        'rel': 0,
                        'showinfo': 0,
                        'playsinline': 1,
                        'enablejsapi': 1,
                    },
                    events: {
                        'onReady': function (event) {
                            if (mute) {
                                event.target.mute();
                            }

                            if (index === swipers[sliderId].activeIndex) {
                                setTimeout(function () {
                                    event.target.playVideo();
                                }, 1000);
                            }
                        },
                        //'onStateChange': onPlayerStateChange
                    }
                });
            } else {
                let youtubeInterval = setInterval(function () {
                    if (youtubeApiReady) {
                        clearInterval(youtubeInterval);
                        youtubePlayers[slideId] = new YT.Player(elId, {
                            videoId: videoId,
                            playerVars: {
                                'controls': 0,
                                'disablekb': 1,
                                'fs': 0,
                                'modestbranding': 1,
                                'rel': 0,
                                'showinfo': 0,
                                'playsinline': 1,
                            },
                            events: {
                                'onReady': function (event) {
                                    if (mute) {
                                        event.target.mute();
                                    }
                                    if (index === swipers[sliderId].activeIndex) {
                                        event.target.playVideo();
                                    }
                                },
                                //'onStateChange': onPlayerStateChange
                            }
                        });
                    }

                }, 100);
            }

        }

        function initVimeoPlayer(sliderId, slideId, index, mute) {
            if (typeof Vimeo != 'undefined') {
                vimeoPlayers[slideId] = new Vimeo.Player('#' + slideId.find('iframe'));
                vimeoPlayers[slideId].ready().then(function () {
                    if (index === swipers[sliderId].activeIndex) {
                        vimeoPlayers[slideId].play();
                    }
                    if (mute) {
                        vimeoPlayers[slideId].setVolume(0);
                    }
                })
            } else {
                let vimeoInterval = setInterval(function () {
                    if (typeof Vimeo != 'undefined') {
                        clearInterval(vimeoInterval);
                        vimeoPlayers[slideId] = new Vimeo.Player(jQuery('#' + slideId).find('iframe'));
                        vimeoPlayers[slideId].ready().then(function () {
                            if (index === swipers[sliderId].activeIndex) {
                                vimeoPlayers[slideId].play();

                            }
                            if (mute) {
                                vimeoPlayers[slideId].setVolume(0);
                            }
                        })
                    }

                }, 100);
            }
        }


        function initSlide(sliderId, slide, index) {
            let jQSlide = jQuery(slide);
            let slideType = jQSlide.data('media-type');
            let videoId = jQSlide.data('video-id');
            let slideId = jQSlide.data('id');
            slideId = index + '_' + slideId;
            jQSlide.attr('id', slideId);
            var mute = jQSlide.data('mute');
            switch (slideType) {
                case 'youtube':
                    let ytElId = slideId + '_yt';
                    jQSlide.find('.corefortress-slider-yt-player').attr('id', ytElId);
                    initYTPlayer(sliderId, slideId, ytElId, videoId, index, mute);
                    break;
                case 'vimeo':
                    initVimeoPlayer(sliderId, slideId, index, mute);
                    break;
            }
        }

        sliders.each(function (i, el) {
            let wrap = jQuery(el);
            let sliderElem = wrap.find('.corefortress-slider-container');
            let thumbsElem = wrap.find('.corefortress-gallery-thumbs');
            let wrapId = wrap.attr('id');
            var id = sliderElem.attr('id');
            let lazy = sliderElem.data('lazy');
            let direction = sliderElem.data('direction');
            let initialSlide = +sliderElem.data('initial');
            let speed = +sliderElem.data('speed');
            let effect = sliderElem.data('effect');
            let grabCursor = sliderElem.data('grabcursor');
            let loop = sliderElem.data('loop');
            let autoslide = sliderElem.data('autoslide');
            let stoponhover = sliderElem.data('stoponhover');
            let autoslidedelay = +sliderElem.data('autoslidedelay');
            let navigationarrows = +sliderElem.data('navigationarrows');
            let thumbsperview = +sliderElem.data('thumbsperview');
            let hasPagination = sliderElem.data('haspagination');
            let paginationType = sliderElem.data('paginationtype');


            let sliderOptions = {
                lazy: lazy,
                direction: direction,
                initialSlide: initialSlide,
                speed: speed,
                effect: effect,
                slidesPerView: 1,
                loop: loop,
                grabCursor: grabCursor,
                on: {
                    init: function () {
                        for (var j = 0; j < this.slides.length; j++) {
                            initSlide(id, this.slides[j], j);
                        }
                    },
                    slideChange: function () {
                        if (isNaN(this.previousIndex) || isNaN(this.activeIndex))
                            return;
                        var prevSlide = jQuery(this.slides[this.previousIndex])
                        var prevSlideType = prevSlide.data('media-type');
                        var prevSlideId = prevSlide.attr('id');

                        if (prevSlideType === 'youtube') {
                            youtubePlayers[prevSlideId].stopVideo();
                        } else if (prevSlideType === 'vimeo') {
                            vimeoPlayers[prevSlideId].pause();
                            vimeoPlayers[prevSlideId].setCurrentTime(0);
                        }

                        var activeSlide = jQuery(this.slides[this.activeIndex])
                        var activeSlideType = activeSlide.data('media-type');
                        var activeSlideId = activeSlide.attr('id');


                        if (activeSlideType === 'youtube') {
                            youtubePlayers[activeSlideId].playVideo();
                        } else if (activeSlideType === 'vimeo') {
                            vimeoPlayers[activeSlideId].play();
                        }
                    }
                },

            };

            if (navigationarrows) {
                sliderOptions.navigation = {
                    nextEl: '#' + id + ' .corefortress-swiper-button-next',
                    prevEl: '#' + id + ' .corefortress-swiper-button-prev',
                };
            }

            if (thumbsElem.length) {
                var galleryThumbs = new Swiper('#' + wrapId + ' .corefortress-gallery-thumbs', {
                    spaceBetween: 10,
                    slidesPerView: thumbsperview,
                    loop: loop,
                    freeMode: true,
                    //loopedSlides: 5, //looped slides should be the same
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                });

                sliderOptions.thumbs = {
                    swiper: galleryThumbs,
                };
            }

            if(hasPagination){
                sliderOptions.pagination = {
                    el : "#"+wrapId+" .corefortress-swiper-pagination",
                    clickable: true
                };

                if(paginationType === 'fraction'){
                    sliderOptions.pagination.type='fraction';
                } else if(paginationType === 'progressbar') {
                    sliderOptions.pagination.type='progressbar';
                }
            }

            if (autoslide) {
                autoslideTimers[id] = setInterval(function () {
                    console.log(jQuery("#"+wrapId+":hover"));
                    if(jQuery("#"+wrapId+":hover").length === 0) {
                        swipers[id].slideNext();
                    } else {
                        clearInterval(autoslideTimers[id]);
                    }
                }, autoslidedelay);

            }

            if (autoslide && stoponhover) {
                wrap.hover(function () {
                    var id = jQuery(this).find('.corefortress-slider-container').attr('id');
                    clearInterval(autoslideTimers[id]);
                }, function () {
                    var id = jQuery(this).find('.corefortress-slider-container').attr('id');
                    autoslideTimers[id] = setInterval(function () {
                        if(jQuery("#"+wrapId+":hover").length === 0) {
                            swipers[id].slideNext();
                        } else {
                            clearInterval(autoslideTimers[id]);
                        }

                    }, autoslidedelay);
                })
            }

            if (effect === 'fade') {
                sliderOptions.fadeEffect = {
                    crossFade: true
                };
            }else if (effect === 'flip') {
                sliderOptions.flipEffect = {
                    rotate: 30,
                        slideShadows: false,
                };
            } else if (effect === 'cube') {
                sliderOptions.cubeEffect = {
                    shadow: true,
                    slideShadows: true,
                    shadowOffset: 20,
                    shadowScale: 0.94,
                };
            }else if (effect === 'coverflow') {
                sliderOptions.coverflowEffect = {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                };
                sliderOptions.centeredSlides = true;
                sliderOptions.slidesPerView = 'auto';
            }

            console.log(sliderOptions);

            swipers[id] = new Swiper('#' + id, sliderOptions);

            if (autoslide) {
                swipers[id].on('slideChangeTransitionStart', function () {
                    setTimeout(() => {
                        swipers[id].animating = false;
                    }, 0);
                });
            }

            sliderElem.on('click', 'a.corefortress-slide-cta, .corefortress-slide-link', function (e) {
                var sliderId = jQuery(this).closest('.corefortress-slider-container').attr('id');
                var slideId = +jQuery(this).closest('.swiper-slide').data('swiper-slide-index');
                if (swipers[sliderId].activeIndex !== slideId) {
                    return false;
                }
            })
        });
    }


});