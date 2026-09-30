(function ($) {
  "use strict";

  var WidgetTestimonialThumbCarouselHandler = function ($scope) {
    var $swiper_container = $('.tm-testimonial-single-carousel');
    if( $swiper_container.length > 0 ) {
      $swiper_container.each(function () {
        var this_item = $(this);
        var slider = new Swiper (this_item.find('.swiper-content-container-inner')[0], {
          slidesPerView: 1,
          centeredSlides: true,
          loop: true,
          loopedSlides: 6,
          navigation: {
            nextEl: this_item.find('.tm-swiper-button-next')[0],
            prevEl: this_item.find('.tm-swiper-button-prev')[0],
          },
          pagination: {
            el: this_item.find('.swiper-pagination')[0],
            type: ((this_item.attr('data-pagination-type')) ? this_item.attr('data-pagination-type') : 'progressbar'),
            clickable: true,
            renderCustom: function (swiper, current, total) {
              return current + ' of ' + total;
            }
          },
        });
        var thumbs = new Swiper (this_item.find('.testimonial-thumbs')[0], {
          slidesPerView: 'auto',
          spaceBetween: 0,
          centeredSlides: true,
          loop: true,
          slideToClickedSlide: true,
        });
        slider.controller.control = thumbs;
        thumbs.controller.control = slider;
      });
    }
  }

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/tm-ele-testimonial-block.skin-single", WidgetTestimonialThumbCarouselHandler);
  });
  $(window).on("elementor/editor/before_enqueue_scripts", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/widget", function ($scope) {
      WidgetTestimonialThumbCarouselHandler;
    });
  });
})(jQuery);
