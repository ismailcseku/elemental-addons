(function ($) {
  "use strict";

  var $document_body = $(document.body);

  function tmProgressBarCounter(pBar, pPercent) {
    var percent = parseFloat(pPercent);
    if (pBar.length) {
      pBar.each(function () {
        var current_item = $(this);
        current_item.css("opacity", "1");
        if (typeof current_item.countTo === "function") {
          current_item.countTo({
            from: 0,
            to: percent,
            speed: 2000,
            refreshInterval: 50,
          });
        } else {
          // Fallback if countTo is not available
          current_item.text(Math.round(percent));
        }
      });
    }
  }

  function isRTL() {
    // Check if RTL using multiple methods
    if (typeof THEMEMASCOT !== "undefined" && THEMEMASCOT.isRTL && typeof THEMEMASCOT.isRTL.check === "function") {
      return THEMEMASCOT.isRTL.check();
    }
    // Fallback to document direction
    return $("html").attr("dir") === "rtl" || $("body").hasClass("rtl");
  }

  function initProgressBar(current_item) {
    if (current_item.hasClass("appeared")) {
      return;
    }

    var percentage = current_item.data("percent");
    if (!percentage) {
      return;
    }

    var bar_height = current_item.data("bar-height");
    var percent = current_item.find(".percent");
    var bar_holder = current_item.find(".progress-holder");
    var bar = current_item.find(".progress-content");

    if (current_item.hasClass("progress-bar-default")) {
      // For default style, the value is inside .progress-content
      tmProgressBarCounter(bar.find("span.value"), percentage);
    } else {
      // For other styles, the value is inside .percent
      if (percent.length) {
        tmProgressBarCounter(percent.find("span.value"), percentage);
      }
    }

    bar.css("width", "0%").animate({ width: percentage + "%" }, 2000);

    if (current_item.hasClass("progress-bar-floating-percent") && percent.length) {
      if (isRTL()) {
        percent.css("right", "0%").animate({ right: percentage + "%" }, 2000);
      } else {
        percent.css("left", "0%").animate({ left: percentage + "%" }, 2000);
      }
    }

    if (bar_height && bar_height !== "") {
      bar_holder.css("height", bar_height);
      bar.css("height", bar_height);
    }

    var barcolor = current_item.data("barcolor");
    if (barcolor) {
      bar.css("background-color", barcolor);
    }

    current_item.addClass("appeared");
  }

  var WidgetProgressBarHandler = function ($scope) {
    // Ensure $scope is defined and is a jQuery object
    if (!$scope) {
      $scope = $(document);
    } else if (!$scope.find || typeof $scope.find !== "function") {
      // If $scope exists but is not a jQuery object, wrap it
      $scope = $($scope);
    }
    // Search within the widget scope, not globally
    var $progress_bar = $scope.find(".tm-sc-progress-bar");

    if ($progress_bar.length > 0) {
      $progress_bar.each(function () {
        var current_item = $(this);

        // Use Intersection Observer if available, otherwise use scroll event
        if ("IntersectionObserver" in window) {
          var observer = new IntersectionObserver(
            function (entries) {
              entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                  initProgressBar($(entry.target));
                  observer.unobserve(entry.target);
                }
              });
            },
            {
              threshold: 0.1,
            }
          );
          observer.observe(current_item[0]);
        } else {
          // Fallback: check if element is in viewport on scroll
          function checkVisibility() {
            var elementTop = current_item.offset().top;
            var elementBottom = elementTop + current_item.outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
              initProgressBar(current_item);
              $(window).off("scroll", checkVisibility);
            }
          }

          // Check immediately if already visible
          checkVisibility();
          $(window).on("scroll", checkVisibility);
        }
      });
    }
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
    // Register handler for all design style variants
    elementorFrontend.hooks.addAction("frontend/element_ready/tm-ele-progress-bar.default", WidgetProgressBarHandler);
    elementorFrontend.hooks.addAction("frontend/element_ready/tm-ele-progress-bar.floating-percent", WidgetProgressBarHandler);
    elementorFrontend.hooks.addAction("frontend/element_ready/tm-ele-progress-bar.fixed-right-percent", WidgetProgressBarHandler);
    // Also register a generic handler in case Elementor uses a different format
    if (typeof elementorFrontend.elementsHandler !== "undefined") {
      elementorFrontend.elementsHandler.attachHandler("tm-ele-progress-bar", WidgetProgressBarHandler);
    }
  });
})(jQuery);
