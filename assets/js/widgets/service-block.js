(function ($) {
  "use strict";

  var WidgetServiceBlock1Handler = function ($scope) {
    var $innerBlocks = $scope.find(".service-block-style1 .inner-block");
    if (!$innerBlocks.length) {
      return;
    }

    // Accordion lives inside this widget only (multiple instances / Elementor preview).
    $scope.off("click.tmServiceBlock1", ".service-block-style1 .inner-block .title-box");
    $scope.on(
      "click.tmServiceBlock1",
      ".service-block-style1 .inner-block .title-box",
      function (event) {
        if ($(event.target).closest("a").length) {
          return;
        }

        var $clickedInner = $(this).closest(".inner-block");
        var wasActive = $clickedInner.hasClass("active");

        $innerBlocks.removeClass("active");

        if (!wasActive) {
          $clickedInner.addClass("active");
        }
      }
    );

    // First item open by default; opening/closing is driven by `.inner-block.active` (see service-block-style1.css).
    $innerBlocks.removeClass("active");
    $innerBlocks.first().addClass("active");
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/tm-ele-service-block.skin-style1",
      WidgetServiceBlock1Handler,
    );
  });
})(jQuery);
