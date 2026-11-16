(function ($) {
  "use strict";
  var WidgetFeaturesBlockBgImg = function ($scope) {
    var $features_block_style6 = $(".features-block-style11");
    if ($features_block_style6.length > 0) {
      $features_block_style6.each(function (index) {
        var current_item = $(this);

        //by default set bg image with the first item
        if (index == 0) {
          let newBackground = current_item.data("bg");
          if (newBackground) {
            current_item
              .parents(".tm-sc-features")
              .attr("data-background", newBackground)
              .css("background-image", "url(" + newBackground + ")");
          }
        }

        //on mouse over change image
        current_item.on("mouseover", function () {
          let newBackground = current_item.data("bg");
          if (newBackground) {
            current_item
              .parents(".tm-sc-features")
              .attr("data-background", newBackground)
              .css("background-image", "url(" + newBackground + ")");
          }
        });
      });
    }
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.elementsHandler.attachHandler(
      "tm-ele-features-block",
      WidgetFeaturesBlockBgImg,
      "skin-style11",
    );
  });
})(jQuery);

(function ($) {
  "use strict";

  var WidgetFeaturesBlock3Handler = function ($scope) {
    var $items = $(".features-block-style11 .inner-block");

    if ($items.length) {
      // Set the 2nd item active by default
      $items.eq(1).addClass("active");

      // Hover or click to activate
      $items.on("mouseenter click", function () {
        $items.removeClass("active");
        $(this).addClass("active");
      });
    }
  };

  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/tm-ele-features-block.skin-style11",
      WidgetFeaturesBlock3Handler,
    );
  });
})(jQuery);
