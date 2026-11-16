 (function($) {
    'use strict';


    var WidgetFeatureBlock3Handler = function ($scope) {
      const items = document.querySelectorAll('.features-block-style24 .inner-block');
      //Make the first item active on load
      if (items.length > 0) {
        items[0].classList.add('active');
      }

      items.forEach(item => {
        item.addEventListener('mouseenter', () => {
          items.forEach(i => i.classList.remove('active'));
          item.classList.add('active');
        });
      });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-features-block.skin-style24",
            WidgetFeatureBlock3Handler
        );
    });


})(jQuery);

