(function($) {
    'use strict';


    var WidgetServiceBlock2Handler = function ($scope) {
        if ($('.service-block-style4 .inner-box').length) {

            // Set default active state on the second .inner-box
            var $secondBox = $('.service-block-style4 .inner-box').eq(0);
            $secondBox.addClass('active');
            $secondBox.find('.content-box').slideDown().addClass('active'); // smooth transition

            // Click functionality
            $('.service-block-style4 .inner-box').on('click', function () {
                $('.service-block-style4 .inner-box').removeClass('active');
                $('.service-block-style4 .content-box').slideUp().removeClass('active');

                $(this).addClass('active');
                $(this).find('.content-box').slideDown().addClass('active');
            });
        }




    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-style4",
            WidgetServiceBlock2Handler
        );
    });


})(jQuery);