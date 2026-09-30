(function($) {
    'use strict';

    var $document = $(document);
    var $document_body = $(document.body);

    function getRandomValue(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }
    var WidgetFunfactAnimateNumberHandler = function ($scope) {
        var $animate_number = $('.animate-number');
        if( $animate_number.length > 0 ) {
          $animate_number.appear();
          var randomNum = getRandomValue(10, 400);
          $document_body.on('appear', '.animate-number', function() {
            var current_item = $(this);
            $animate_number.each(function() {
              setTimeout(function () {
                if (!current_item.hasClass('appeared')) {
                  current_item.animateNumbers(current_item.attr("data-value"), true, parseInt(current_item.attr("data-animation-duration"), 10)).addClass('appeared');
                }
              }, randomNum);
            });
          });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-funfact-counter', WidgetFunfactAnimateNumberHandler );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'default' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style1' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style2' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style3' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style4' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style5' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style6' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style7' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style8' );
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style9' );
    });


})(jQuery);