(function($) {
    'use strict';

    function activate_block($item) {
        $item.hover(function() {
            if ($(window).width() > 1024) {
                $(this).siblings('.pricing-block-style2').removeClass('active'), $(this).addClass('active');
            }
        })
    }

    var WidgetPricingBlock2Handler = function ($scope) {
        var $item =  $('.pricing-block-basic-wrapper .pricing-block-style2');
        activate_block($item);

        $(window).resize(function(){
            activate_block($item);
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-pricing-block.skin-style2",
            WidgetPricingBlock2Handler
        );
    });


})(jQuery);