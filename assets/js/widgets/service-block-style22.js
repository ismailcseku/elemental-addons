(function($) {
    'use strict';


    var WidgetServiceBlock2Handler = function ($scope) {
        if ($('.service-block-style22').length) {
            var $service_block = $('.service-block-style22 .inner-box');
            $($service_block).on('mouseenter', function (e) {
                $(this).find('.content-box .inner').stop().slideDown(400);
                return false;
            });
            $($service_block).on('mouseleave', function (e) {
                $(this).find('.content-box .inner').stop().slideUp(400);
                return false;
            });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-style22",
            WidgetServiceBlock2Handler
        );
    });


})(jQuery);