/**
 * Elemental Addons — Swiper carousel init (Hello Elementor / no Evolta theme).
 * Ported from Evolta THEMEMASCOT.initialize.TM_SwiperSlider.
 */
(function ($) {
  'use strict';

  var arrowBridgeBound = false;

  function bindExternalArrowBridge() {
    if (arrowBridgeBound) {
      return;
    }
    arrowBridgeBound = true;
    $(document.body)
      .on('click.elementalSwiper', '.tm-swiper-carousel-arrow-wrap .tm-swiper-arrow-prev', function () {
        $(this).parents('.e-parent, .elementor-section, .elementor-element').first()
          .find('.tm-swiper-button-wrap .tm-swiper-button-prev').trigger('click');
      })
      .on('click.elementalSwiper', '.tm-swiper-carousel-arrow-wrap .tm-swiper-arrow-next', function () {
        $(this).parents('.e-parent, .elementor-section, .elementor-element').first()
          .find('.tm-swiper-button-wrap .tm-swiper-button-next').trigger('click');
      });
  }

  function parseBoolAttr($el, name, fallback) {
    if (!$el.attr(name)) {
      return fallback;
    }
    var val = $el.data(name.replace(/^data-/, ''));
    if (typeof val === 'boolean') {
      return val;
    }
    if (val === 'true' || val === 1 || val === '1') {
      return true;
    }
    if (val === 'false' || val === 0 || val === '0') {
      return false;
    }
    return fallback;
  }

  function initSwiperContainer($scope) {
    if (typeof Swiper === 'undefined') {
      return;
    }

    bindExternalArrowBridge();

    var $root = $scope && $scope.length ? $scope : $(document);
    var $containers = $root.hasClass('tm-swiper-container')
      ? $root
      : $root.find('.tm-swiper-container');

    $containers.each(function () {
      var this_item = $(this);
      var $inner = this_item.find('.swiper-container-inner').first();
      if (!$inner.length) {
        return;
      }

      // Avoid double init (Elementor editor + frontend).
      if ($inner[0].swiper) {
        return;
      }

      var coverfloweffectData = this_item.attr('data-coverfloweffect')
        ? String(this_item.data('coverfloweffect')).split(',')
        : ['50', '0', '100', '1', '1', 'true'];

      var autoplay_var = parseBoolAttr(this_item, 'data-autoplay', true);
      if (autoplay_var === true) {
        autoplay_var = {
          delay: this_item.attr('data-delay') ? Number(this_item.data('delay')) : 3000,
          reverseDirection: parseBoolAttr(this_item, 'data-reversedir', false),
          disableOnInteraction: parseBoolAttr(this_item, 'data-disableoninteraction', false),
          pauseOnMouseEnter: parseBoolAttr(this_item, 'data-pauseonmouseenter', true),
          stopOnLastSlide: false,
          waitForTransition: true,
        };
      }

      // eslint-disable-next-line no-new
      new Swiper($inner[0], {
        effect: this_item.attr('data-effect') ? this_item.attr('data-effect') : 'slide',
        allowTouchMove: parseBoolAttr(this_item, 'data-allowtouchmove', true),
        slidesPerView: this_item.attr('data-items') ? Number(this_item.attr('data-items')) : 4,
        spaceBetween: this_item.attr('data-space') ? Number(this_item.data('space')) : 15,
        loop: parseBoolAttr(this_item, 'data-loop', false),
        centeredSlides: parseBoolAttr(this_item, 'data-centered', false),
        speed: this_item.attr('data-speed') ? Number(this_item.data('speed')) : 300,
        freeMode: parseBoolAttr(this_item, 'data-freemod', false),
        autoplay: autoplay_var,
        coverflowEffect: {
          rotate: Number(coverfloweffectData[0] || 50),
          stretch: Number(coverfloweffectData[1] || 0),
          depth: Number(coverfloweffectData[2] || 100),
          modifier: Number(coverfloweffectData[3] || 1),
          scale: Number(coverfloweffectData[4] || 1),
          slideShadows: String(coverfloweffectData[5] || 'true') !== 'false',
        },
        navigation: {
          nextEl: this_item.find('.tm-swiper-button-next')[0],
          prevEl: this_item.find('.tm-swiper-button-prev')[0],
        },
        pagination: {
          el: this_item.find('.swiper-pagination')[0],
          type: this_item.attr('data-pagination-type') ? this_item.attr('data-pagination-type') : 'bullets',
          clickable: true,
        },
        breakpoints: {
          0: {
            slidesPerView: this_item.attr('data-xs-items') ? Number(this_item.attr('data-xs-items')) : 1,
          },
          576: {
            slidesPerView: this_item.attr('data-sm-items') ? Number(this_item.attr('data-sm-items')) : 1,
          },
          768: {
            slidesPerView: this_item.attr('data-md-items') ? Number(this_item.attr('data-md-items')) : 2,
          },
          992: {
            slidesPerView: this_item.attr('data-lg-items') ? Number(this_item.attr('data-lg-items')) : 3,
          },
          1200: {
            slidesPerView: this_item.attr('data-items') ? Number(this_item.attr('data-items')) : 4,
          },
          1400: {
            slidesPerView: this_item.attr('data-xxl-items') ? Number(this_item.attr('data-xxl-items')) : 4,
          },
        },
      });
    });
  }

  function onFrontendInit() {
    initSwiperContainer($(document));

    if (typeof elementorFrontend === 'undefined' || !elementorFrontend.hooks) {
      return;
    }

    elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
      initSwiperContainer($scope);
    });
  }

  $(window).on('elementor/frontend/init', onFrontendInit);

  // Front-end pages: Elementor may already have fired init before this script loads.
  $(function () {
    if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
      initSwiperContainer($(document));
    } else {
      // Pure front render without waiting forever.
      setTimeout(function () {
        initSwiperContainer($(document));
      }, 50);
    }
  });
})(jQuery);
