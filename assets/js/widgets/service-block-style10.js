(function ($) {
  "use strict";

  var relayoutIsotope = function ($scope) {
    var $inner = $scope.find(".isotope-layout-inner");
    if ($inner.length && $inner.data("isotope") && typeof $inner.isotope === "function") {
      $inner.isotope("layout");
    }
  };

  var WidgetServiceBlock1Handler = function ($scope) {
    var $innerBlocks = $scope.find(".service-block-style10 .inner-block");
    if (!$innerBlocks.length) {
      return;
    }

    // Accordion lives inside this widget only (multiple instances / Elementor preview).
    $scope.off("click.tmServiceBlock1", ".service-block-style10 .inner-block .title-box");
    $scope.on(
      "click.tmServiceBlock1",
      ".service-block-style10 .inner-block .title-box",
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

        // Isotope grid height must refresh after accordion open/close.
        relayoutIsotope($scope);
        setTimeout(function () {
          relayoutIsotope($scope);
        }, 520);
      }
    );

    // First item open by default; opening/closing is driven by `.inner-block.active` (see service-block-style10.css).
    $innerBlocks.removeClass("active");
    $innerBlocks.first().addClass("active");
    relayoutIsotope($scope);
    setTimeout(function () {
      relayoutIsotope($scope);
    }, 520);
  };

  var bind = function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/tm-ele-service-block.skin-style10",
      WidgetServiceBlock1Handler
    );
  };

  if (typeof elementorFrontend !== "undefined" && elementorFrontend.hooks) {
    bind();
  } else {
    $(window).on("elementor/frontend/init", bind);
  }
})(jQuery);
