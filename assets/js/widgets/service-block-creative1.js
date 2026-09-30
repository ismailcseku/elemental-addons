(function($) {
    'use strict';

    var WidgetServiceBlockCreative1Handler = function ($scope) {
        if ($('.service-creative-tab').length) {
            $('.service-creative-tab').each(function() {
                var $this_tabs = jQuery(this);
                $this_tabs.find('.service-item').on('mouseenter', function () {
                    var tab_id = $(this).attr('data-tab');
                    $this_tabs.find('.service-item').removeClass('current');
                    $(this).addClass('current');
                    $this_tabs.find('.each-image ').removeClass('current');
                    $("#" + tab_id).addClass('current');
                    if ($(this).hasClass('current')) {
                        return false;
                    }
                });
            });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-creative1",
            WidgetServiceBlockCreative1Handler
        );
    });


})(jQuery);