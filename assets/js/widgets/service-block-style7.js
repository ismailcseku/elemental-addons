(function ($) {
  "use strict";

  var relayoutIsotope = function ($scope) {
    var $inner = $scope.find(".isotope-layout-inner");
    if ($inner.length && $inner.data("isotope") && typeof $inner.isotope === "function") {
      $inner.isotope("layout");
    }
  };

  var WidgetServiceBlock1Handler = function ($scope) {
    var $innerBlocks = $scope.find(".service-block-style7 .inner-block");
    if (!$innerBlocks.length) {
      return;
    }

    $scope.off("click.tmServiceBlock1", ".service-block-style7 .inner-block .title-box");
    $scope.on(
      "click.tmServiceBlock1",
      ".service-block-style7 .inner-block .title-box",
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

        relayoutIsotope($scope);
        setTimeout(function () {
          relayoutIsotope($scope);
        }, 520);
      }
    );

    $innerBlocks.removeClass("active");
    $innerBlocks.first().addClass("active");
    relayoutIsotope($scope);
    setTimeout(function () {
      relayoutIsotope($scope);
    }, 520);
  };

  var bind = function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/tm-ele-service-block.skin-style7",
      WidgetServiceBlock1Handler
    );
  };

  if (typeof elementorFrontend !== "undefined" && elementorFrontend.hooks) {
    bind();
  } else {
    $(window).on("elementor/frontend/init", bind);
  }
})(jQuery);
