(function($) {
    'use strict';

    var WidgetSectionTitleTextRevealHandler = function ($scope) {
        setTimeout(function () {
            var textheading = $scope.find(".title.tm-text-reveal");

            if(textheading.length == 0) return;

            gsap.registerPlugin(SplitText);

            textheading.each(function(index, el) {
                el.split = new SplitText(el, {
                    type: "lines,words,chars",
                    linesClass: "split-line"
                });

                if( $(el).hasClass('tm-text-reveal') ){
                    var initialOpacity = $(el).data('reveal-opacity');
                    if( initialOpacity === undefined || initialOpacity === null ) {
                        initialOpacity = 0.3;
                    }
                    var initialX = $(el).data('reveal-x');
                    if( initialX === undefined || initialX === null ) {
                        initialX = -15;
                    }
                    gsap.set(el.split.chars, {
                        opacity: initialOpacity,
                        x: initialX,
                    });
                }

                el.anim = gsap.to(el.split.chars, {
                    scrollTrigger: {
                        trigger: el,
                        start: "top 80%",
                        end: "top 60%",
                        markers: false,
                        scrub: 1,
                    },
                    x: "0",
                    y: "0",
                    opacity: 1,
                    duration: .7,
                    stagger: 0.2,
                });
            });
        }, 200);
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-section-title.default",
            WidgetSectionTitleTextRevealHandler
        );
    });
})(jQuery);

