(function ($) {
  "use strict";

  if ($(".service-block-style2").length) {
    var $service_block = $(".service-block-style2 .inner-block");
    $($service_block).on("mouseenter", function (e) {
      $(this).find(".content .service-details").stop().slideDown(300);
      return false;
    });
    $($service_block).on("mouseleave", function (e) {
      $(this).find(".content .service-details").stop().slideUp(300);
      return false;
    });
  }
})(jQuery);
