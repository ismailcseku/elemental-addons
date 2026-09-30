(function($) {
    'use strict';


    var WidgetVerticalBGImageListHandler = function ($scope) {
        //Start execute javascript for background list
        jQuery(".vertical-bg-img-list").each(function() {
            var $this = jQuery(this);
            $this.children('.each-vertical-column').hover(function () {
            $this.find('.each-vertical-column').removeClass('hover');
            $this.find('.bg-img').removeClass('hover');
            jQuery(this).addClass('hover').next('.bg-img').addClass('hover');
            jQuery(this)
                .mouseleave(function () {
                    jQuery(this).removeClass('hover');
                });
            });
        });

        jQuery(".vertical-bg-img-list .each-vertical-column").each(function() {
            var $this = jQuery(this);
            //on hover title transition
            var content_top = $(this).find('.content-top'),
                content_bottom = $(this).find('.content-bottom');
            if (windowWidth > 1024){
                var content_bottom_height = content_bottom.outerHeight(!0);
                content_top.css({ transform: "translateY(" + content_bottom_height + "px)" }),
                $(this)
                    .mouseenter(function () {
                        content_top.css({ transform: "translateY(0px)" });
                    })
                    .mouseleave(function () {
                        content_top.css({ transform: "translateY(" + content_bottom_height + "px)" });
                    });
            }
            else{
                content_top.css("transform","");
                $(this).unbind('mouseenter mouseleave');
            }
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-vertical-bg-img-list.default",
            WidgetVerticalBGImageListHandler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-vertical-bg-img-list.skin-style2",
            WidgetVerticalBGImageListHandler
        );
    });


})(jQuery);