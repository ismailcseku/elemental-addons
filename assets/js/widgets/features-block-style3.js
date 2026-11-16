(function($) {
  'use strict';

  var WidgetFeaturesBlockHandler = function ($scope) {
    if ($('.features-block-style3').length) {
      // Add active class to the first item by default on page load
      $('.features-block-style3').eq(0).addClass('active');


      $('.features-block-style3').on('mouseenter', function () {
        // Add active class to the hovered item
        $(this).addClass('active');
        // Remove active class from other items
        $('.features-block-style3').not(this).removeClass('active');
      });

      $('.features-block-style3').on('mouseleave', function () {
        // Ensure the hovered item keeps the active class
        $(this).addClass('active');
      });
    }
  };


  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.elementsHandler.attachHandler( 'tm-ele-features-block', WidgetFeaturesBlockHandler, 'skin-style3' );
  });
})(jQuery);