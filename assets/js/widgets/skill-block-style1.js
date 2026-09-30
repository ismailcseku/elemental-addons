(function($) {
    'use strict';


    var WidgetSkillBlock1Handler = function ($scope) {
     if($('.skill-block-style1 .inner-box').length) {
		$('.skill-block-style1 .inner-box').on('mouseenter', function() {
		$(this).addClass('active');
		$('.inner-box').removeClass('active');
		});
		$('.skill-block-style1 .inner-box').on('mouseleave', function() {
		$(this).addClass('active');
		});
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-skill-block.skin-style1",
            WidgetSkillBlock1Handler
        );
    });


})(jQuery);