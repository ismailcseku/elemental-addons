(function ($) {
    'use strict';

    var $items = $(".service-block-style11");

    // Make 2nd block active by default (index starts from 0)
    $items.eq(1).addClass("active");

    $items.hover(function () {
        $items.removeClass("active");
        $(this).addClass("active");
    });

})(jQuery);
