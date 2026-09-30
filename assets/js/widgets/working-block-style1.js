(function ($) {
    "use strict";

    var WidgetWorkingBlockHandler = function ($scope) {
        var $swiper_wrapper = $scope.find(".tm-swiper-container");
        if ($swiper_wrapper.length === 0) return;

        $swiper_wrapper.each(function () {
            var this_item = $(this);
            var inner     = this_item.find(".swiper-container-inner")[0];

            if (!inner) return;

            // Destroy any Swiper instance already created by the global init
            if (inner.swiper) {
                inner.swiper.destroy(true, true);
            }

            var autoplay_var = this_item.attr("data-autoplay") ? this_item.data("autoplay") : true;
            if (autoplay_var === true) {
                autoplay_var = {
                    delay:                  this_item.attr("data-delay")                  ? this_item.data("delay")                  : 3000,
                    reverseDirection:       this_item.attr("data-reversedir")             ? this_item.data("reversedir")             : false,
                    disableOnInteraction:   this_item.attr("data-disableoninteraction")   ? this_item.data("disableoninteraction")   : false,
                    pauseOnMouseEnter:      this_item.attr("data-pauseonmouseenter")      ? this_item.data("pauseonmouseenter")      : true,
                    stopOnLastSlide:        false,
                    waitForTransition:      true,
                };
            }

            new Swiper(inner, {
                effect:         this_item.attr("data-effect")         ? this_item.attr("data-effect")         : "slide",
                allowTouchMove: this_item.attr("data-allowtouchmove") ? this_item.data("allowtouchmove")      : true,
                slidesPerView:  this_item.attr("data-items")          ? this_item.attr("data-items")          : 4,
                spaceBetween:   this_item.attr("data-space")          ? this_item.data("space")               : 15,
                loop:           this_item.attr("data-loop")           ? this_item.data("loop")                : false,
                centeredSlides: this_item.attr("data-centered")       ? this_item.data("centered")            : false,
                speed:          this_item.attr("data-speed")          ? this_item.data("speed")               : 300,
                freeMode:       this_item.attr("data-freemod")        ? this_item.data("freemod")             : false,
                autoplay:       autoplay_var,

                navigation: {
                    nextEl: this_item.find(".tm-swiper-button-next")[0],
                    prevEl: this_item.find(".tm-swiper-button-prev")[0],
                },
                pagination: {
                    el:        this_item.find(".swiper-pagination")[0],
                    type:      this_item.attr("data-pagination-type") ? this_item.attr("data-pagination-type") : "bullets",
                    clickable: true,
                },

                breakpoints: {
                    0: {
                        slidesPerView: this_item.attr("data-xs-items") ? parseInt(this_item.attr("data-xs-items")) : 1,
                    },
                    576: {
                        slidesPerView: this_item.attr("data-sm-items") ? parseInt(this_item.attr("data-sm-items")) : 1,
                    },
                    768: {
                        slidesPerView: this_item.attr("data-md-items") ? parseInt(this_item.attr("data-md-items")) : 2,
                    },
                    992: {
                        slidesPerView: this_item.attr("data-lg-items") ? parseInt(this_item.attr("data-lg-items")) : 3,
                    },
                    1200: {
                        slidesPerView: 3,
                    },
                    1400: {
                        slidesPerView: 3,
                    },
                    1441: {
                        slidesPerView: 4,
                    },
                },
            });
        });
    };

    // elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-working-block.skin-style1",
            WidgetWorkingBlockHandler
        );
    });

})(jQuery);
