(function () {
    "use strict";
    var studio = {
        init: function () {
            this.cacheDom();
            this.bindEvents();
            this.initSlider();
            this.navOverlay();
            this.totopButton();
            this.enablePopupGallery();
        }
        , cacheDom: function () {
            this.toTop = $('.totop');
            this._body = $('body');
            this.studioHomepageSlider = $('.studio-slider');
            this.studioInstaCarouselSlider = $('.insta-carousel-slider');
            this.studioInstaSlider = $('.studio-insta-slider');
            this.studioMenuTrigger = $('.studio-hamburger-trigger');
            this.studioMainMenu = $('.studio-nav-overlay-main-nav');
            this.studioOverlayMenuHolder = $('.studio-nav-overlay');
            this.studioOverlayMenuClose = $('.studio-nav-overlay-close');
            this.studioMenuLinks = $('.studio-nav-overlay-main-nav li a');
            this.studioGalleryTabs = $('.studio-toolbar-item');
            this.studioGalleryItem = $('.studio-gallery-item');
        }
        , bindEvents: function () {
            var self = this;
            this.studioGalleryTabs.on('click', self.changeActiveTab);
            this.studioGalleryTabs.on('click', self.addGalleryFilter);
            $(window).on('load', self.enablePreloader);
        }
        , /* popup gallery */
        enablePopupGallery: function () {
            $('.studio-popup-gallery').each(function () {
                $(this).magnificPopup({
                    delegate: 'a'
                    , type: 'image'
                    , gallery: {
                        enabled: true
                    }
                });
            });
        }
        , /* preloader */
        enablePreloader: function () {
            var preloader = $('#studio-page-loading').delay(500);
            if (preloader.length > 0) {
                preloader.fadeOut("slow", function () {
                    preloader.remove();
                });
            }
        }
        , /* gallery tab */
        changeActiveTab: function () {
            $(this).closest('.studio-gallery-toolbar').find('.active').removeClass('active');
            $(this).addClass('active');
        }
        , /* gallery filter */
        addGalleryFilter: function () {
            var value = $(this).attr('data-filter');
            if (value === 'all') {
                studio.studioGalleryItem.show('3000');
            }
            else {
                studio.studioGalleryItem.not('.' + value).hide('3000');
                studio.studioGalleryItem.filter('.' + value).show('3000');
            }
        }
        , /* slider */
        initSlider: function () {
            var self = this;
            /* homepage slider */
            self.studioHomepageSlider.slick({
                infinite: true
                , arrows: false
                , autoplay: true
                , speed: 3000
                , slidesToShow: 3
                , slidesToScroll: 2
                , responsive: [
                    {
                        breakpoint: 768
                        , settings: {
                            slidesToShow: 1
                            , slidesToScroll: 1
                            , speed: 1000
                        }
			}
			]
            });
        }
        , /* navigation overlay*/
        navOverlay: function () {
            var self = this;
            if (self.studioMainMenu.length > 0) {
                var closeMenu = function () {
                    self.studioOverlayMenuHolder.removeClass('is-active');
                    self.studioOverlayMenuHolder.addClass('studio-nav-overlay-closed');
                    self.studioMenuTrigger.removeClass('is-active');
                    setTimeout(function () {
                        self._body.css('overflow', '');
                    }, 700);
                };
                var openMenu = function () {
                    self.studioOverlayMenuHolder.addClass('is-active');
                    self.studioOverlayMenuHolder.removeClass('studio-nav-overlay-closed');
                    self.studioMenuTrigger.addClass('is-active');
                    self._body.css('overflow', 'hidden');
                };
                var toggleOpen = function () {
                    if (self.studioOverlayMenuHolder.hasClass('is-active')) {
                        closeMenu();
                    }
                    else {
                        openMenu();
                    }
                };
                /* Open menu trigger */
                self.studioMenuTrigger.on('click', function (e) {
                    e.preventDefault();
                    toggleOpen();
                });
                /* Close Button */
                self.studioOverlayMenuClose.on('click', function (e) {
                    e.preventDefault();
                    toggleOpen();
                });
                /* Close menu if the menu links are clicked */
                self.studioMenuLinks.on('click', function (e) {
                    self.studioMainMenu.find('li .active').removeClass('active');
                    $(this).addClass('active');
                    toggleOpen();
                    // Get the link id
                    var $link = $(this)
                        , linkAttribute = $link.attr('href')
                        , sectionId = linkAttribute.substring(linkAttribute.indexOf('#'))
                        , $section = $(sectionId);
                    if ($section.length !== 0) {
                        e.preventDefault();
                    }
                    var positionToTop = $section.offset().top
                        , topOffset = $link.data('offset');
                    // Check if link has offset
                    if (topOffset) {
                        positionToTop = positionToTop + topOffset;
                    }
                    // Scroll to element
                    $('html, body').animate({
                        scrollTop: positionToTop
                    }, 'slow');
                });
            }
        }
        , /* ======= toTop ======= */
        totopButton: function () {
            var self = this;
            /* Show totop button*/
            $(window).scroll(function () {
                var toTopOffset = self.toTop.offset().top;
                var toTopHidden = 1000;
                if (toTopOffset > toTopHidden) {
                    self.toTop.addClass('totop-vissible');
                }
                else {
                    self.toTop.removeClass('totop-vissible');
                }
            });
            /* totop button animation */
            if (self.toTop && self.toTop.length > 0) {
                self.toTop.on('click', function (e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'slow');
                });
            }
        }
    };

    // Scroll
    var header = $(".start-style");
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 10) {
            header.removeClass('start-style').addClass("scroll-on");
        }
        else {
            header.removeClass("scroll-on").addClass('start-style');
        }
    });
    // Sections Background Image
    var pageSection = $(".bg-img, section");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });
    // Testimonials owlCarousel
    $('.testimonials .owl-carousel').owlCarousel({
        loop: true
        , margin: 30
        , mouseDrag: true
        , autoplay: false
        , dots: true
        , nav: false
        , navText: ["<i class='lnr ti-angle-left'></i>", "<i class='lnr ti-angle-right'></i>"]
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
            , }
            , 600: {
                items: 1
            }
            , 1000: {
                items: 1
            }
        }
    });

    
    // Animations
    var contentWayPoint = function () {
        var i = 0;
        $('.animate-box').waypoint(function (direction) {
            if (direction === 'down' && !$(this.element).hasClass('animated')) {
                i++;
                $(this.element).addClass('item-animate');
                setTimeout(function () {
                    $('body .animate-box.item-animate').each(function (k) {
                        var el = $(this);
                        setTimeout(function () {
                            var effect = el.data('animate-effect');
                            if (effect === 'fadeIn') {
                                el.addClass('fadeIn animated');
                            }
                            else if (effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft animated');
                            }
                            else if (effect === 'fadeInRight') {
                                el.addClass('fadeInRight animated');
                            }
                            else {
                                el.addClass('fadeInUp animated');
                            }
                            el.removeClass('item-animate');
                        }, k * 200, 'easeInOutExpo');
                    });
                }, 100);
            }
        }, {
            offset: '85%'
        });
    };
    $(function () {
        contentWayPoint();
    });

        


    $(document).ready(function() {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps, .popup-custom').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
      });
    studio.init();
})();