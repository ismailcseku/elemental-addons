(function ($) {
  "use strict";

  var WidgetHeroSliderHandler = function ($scope) {
    var $swiper_container = $(".tm-horizontal-hero-slider");
    if ($swiper_container.length > 0) {
      $swiper_container.each(function () {
        var this_item = $(this);
        var target_thumb_slider = $swiper_container.find(".tm-hero-slider-thumb");
        var thumb_slider = null;
        if (target_thumb_slider.length) {
          thumb_slider = new Swiper(target_thumb_slider[0], {
            slidesPerView: this_item.attr("data-items") ? this_item.attr("data-items") : 4,
            spaceBetween: this_item.attr("data-space") ? this_item.data("space") : 15,
            loop: this_item.attr("data-loop") ? this_item.data("loop") : false,
            centeredSlides: this_item.attr("data-centered") ? this_item.data("centered") : false,

            speed: this_item.attr("data-speed") ? this_item.data("speed") : 1000,
            freeMode: this_item.attr("data-freemod") ? this_item.data("freemod") : false,
            autoplay: {
              delay: this_item.attr("data-delay") ? this_item.data("delay") : 5000,
              reverseDirection: this_item.attr("data-reversedir") ? this_item.data("reversedir") : false,
            },

            navigation: {
              nextEl: this_item.find(".tm-swiper-button-next")[0],
              prevEl: this_item.find(".tm-swiper-button-prev")[0],
            },
            pagination: {
              el: this_item.find(".swiper-pagination")[0],
              type: this_item.attr("data-pagination-type") ? this_item.attr("data-pagination-type") : "progressbar",
              clickable: true,
              renderCustom: function (swiper, current, total) {
                return current + " of " + total;
              },
            },
            breakpoints: {
              0: {
                slidesPerView: this_item.attr("data-xs-items") ? this_item.attr("data-xs-items") : 1,
              },
              576: {
                slidesPerView: this_item.attr("data-sm-items") ? this_item.attr("data-sm-items") : 1,
              },
              768: {
                slidesPerView: this_item.attr("data-md-items") ? this_item.attr("data-md-items") : 2,
              },
              992: {
                slidesPerView: this_item.attr("data-lg-items") ? this_item.attr("data-lg-items") : 3,
              },
              1200: {
                slidesPerView: this_item.attr("data-items") ? this_item.attr("data-items") : 4,
              },
              1400: {
                slidesPerView: this_item.attr("data-xxl-items") ? this_item.attr("data-xxl-items") : 4,
              },
            },
          });
        }

        var swiper = new Swiper(this_item.find(".swiper-container-inner")[0], {
          loop: this_item.attr("data-loop") ? this_item.data("loop") : false,
          speed: this_item.attr("data-speed") ? this_item.data("speed") : 300,
          //effect: settings && settings["effect"],

          autoplay: {
            delay: this_item.attr("data-delay") ? this_item.data("delay") : 3000,
            reverseDirection: this_item.attr("data-reversedir") ? this_item.data("reversedir") : false,
          },

          thumbs: {
            swiper: thumb_slider,
          },

          navigation: {
            nextEl: this_item.find(".tm-swiper-button-next")[0],
            prevEl: this_item.find(".tm-swiper-button-prev")[0],
          },
          pagination: {
            el: this_item.find(".swiper-pagination")[0],
            type: this_item.attr("data-pagination-type") ? this_item.attr("data-pagination-type") : "progressbar",
            clickable: true,
            renderCustom: function (swiper, current, total) {
              return current + " of " + total;
            },
          },
        });
      });
    }
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/tm-ele-hero-slider.default", WidgetHeroSliderHandler);
  });
})(jQuery);
