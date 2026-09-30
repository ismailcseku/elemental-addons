(function($) {
    'use strict';

    const $imageCols = $('.image-column .inner-colmun');
    const $detailsItems = $('.service-creative-style1 .service-creative-detials');

    // Set the first image and detail active by default
    $imageCols.removeClass('active').first().addClass('active');
    $detailsItems.removeClass('active').first().addClass('active');

    // Function to activate both image and detail based on index
    function activateByIndex(index) {
        $imageCols.removeClass('active');
        $detailsItems.removeClass('active');

        $imageCols.eq(index).addClass('active');
        $detailsItems.eq(index).addClass('active');
    }

    // Hover + Click event for both .service-creative-detials and its <a> tags
    $detailsItems.each(function(index) {
        $(this).on('mouseenter click', function(e) {
          activateByIndex(index);
        });

        // Also attach to <a> inside
        $(this).find('a').on('mouseenter click', function(e) {
          activateByIndex(index);
        });
    });


})(jQuery);