(function($) {
    'use strict';

    function getRandomValue(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    function animateWhenVisible($el) {
        if (!$el.length || $el.hasClass('appeared')) {
            return;
        }

        var run = function() {
            if ($el.hasClass('appeared')) {
                return;
            }
            var value = $el.attr('data-value');
            var duration = parseInt($el.attr('data-animation-duration'), 10) || 2000;
            var delay = getRandomValue(10, 400);

            setTimeout(function() {
                if ($el.hasClass('appeared')) {
                    return;
                }
                if (typeof $el.animateNumbers === 'function') {
                    $el.animateNumbers(value, true, duration).addClass('appeared');
                } else {
                    $el.text(value).addClass('appeared');
                }
            }, delay);
        };

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        run();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            observer.observe($el[0]);
            return;
        }

        // Fallback: jquery.appear when IntersectionObserver is unavailable.
        if (typeof $.fn.appear === 'function') {
            $el.appear();
            $el.on('appear', run);
            return;
        }

        run();
    }

    var WidgetFunfactAnimateNumberHandler = function($scope) {
        var $animate_number = $scope.find('.animate-number');
        if (!$animate_number.length) {
            $animate_number = $('.animate-number');
        }
        $animate_number.each(function() {
            animateWhenVisible($(this));
        });
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.elementsHandler.attachHandler('tm-ele-funfact-counter', WidgetFunfactAnimateNumberHandler);
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'default');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style1');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style2');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style3');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style4');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style5');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style6');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style7');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style8');
        elementorFrontend.elementsHandler.attachHandler('tm-ele-counter-block', WidgetFunfactAnimateNumberHandler, 'skin-style9');
    });
})(jQuery);
