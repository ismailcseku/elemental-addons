(function($) {
    'use strict';


    var WidgetServiceBlock2Handler = function ($scope) {
        var $items = $('.service-block-style6 .inner-box');
        // Set the second item active by default if it exists
        if ($items.length > 1) {
            $items.eq(1).addClass('active');
        } else {
            $items.first().addClass('active'); // Fallback if only one item exists
        }

        $items.click(function() {
            $items.removeClass('active'); // Remove active from all
            $(this).addClass('active'); // Add active to hovered item
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-style6",
            WidgetServiceBlock2Handler
        );
    });


})(jQuery);