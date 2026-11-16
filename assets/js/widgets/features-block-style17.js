(function($) {
    'use strict';


    var WidgetFeatureBlock3Handler = function ($scope) {
        $(".features-block-style17").on("mouseenter", function () {
            $(".features-block-style17").removeClass("active");
            $(this).addClass("active");
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-features-block.skin-style17",
            WidgetFeatureBlock3Handler
        );
    });


})(jQuery);