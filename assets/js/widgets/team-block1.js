(function($) {
  'use strict';

  var WidgetFeaturesBlockHandler = function ($scope) {
    if ($('.team-current-theme1').length) {
      // Add active class to the first item by default on page load
      $('.team-current-theme1').eq(1).addClass('active');


      $('.team-current-theme1').on('mouseenter', function () {
        // Add active class to the hovered item
        $(this).addClass('active');
        // Remove active class from other items
        $('.team-current-theme1').not(this).removeClass('active');
      });

      $('.team-current-theme1').on('mouseleave', function () {
        // Ensure the hovered item keeps the active class
        $(this).addClass('active');
      });
    }
  };


  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.elementsHandler.attachHandler( 'tm-ele-team-block', WidgetFeaturesBlockHandler, 'skin-style1' );
  });
})(jQuery);