(function($) {
    'use strict';

    var WidgetCounterBlockHandler = function ($scope) {
        // Item Active
        $('.elementor-section').on('mouseover', '.counter-block-two', function () {
            $('.counter-block-two.item-active').removeClass('item-active');
            $(this).addClass('item-active');
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-counter-block.skin-style2",
            WidgetCounterBlockHandler
        );
    });


})(jQuery);