(function ($) {
  "use strict";

if ($(".service-block-style16 .inner-block").length) {
    var $service_block = $(".service-block-style16 .inner-block");
    $($service_block).on("mouseenter", function (e) {
      $(this).find(".content-box .text").stop().slideDown(300);
      return false;
    });
    $($service_block).on("mouseleave", function (e) {
      $(this).find(".content-box .text").stop().slideUp(300);
      return false;
    });
  }

})(jQuery);
