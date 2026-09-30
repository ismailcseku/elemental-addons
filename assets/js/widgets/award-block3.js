(function($) {
    'use strict';


    var WidgetAwardBlock3Handler = function ($scope) {
        var $items = $('.award-block-current-item-style3 .inner-box');

            // Set the second item active by default if it exists
            if ($items.length > 1) {
                $items.eq(1).addClass('active');
            } else {
                $items.first().addClass('active'); // Fallback if only one item exists
            }

            $items.hover(function() {
                $items.removeClass('active'); // Remove active from all
                $(this).addClass('active'); // Add active to hovered item
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-award-block.skin-style3",
            WidgetAwardBlock3Handler
        );
    });


})(jQuery);