(function($) {
    'use strict';

    var WidgetCountDownTimerHandler = function ($scope) {
      //Basic coupon site
      var $timer_smart_style = $('.countdown-timer-current-style .countdown-timer');
      if( $timer_smart_style.length > 0 ) {
        $timer_smart_style.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');


          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');
          var word_days = $this.data('word-days');

          var str =   '<div class="counter">' +  
                  '<span class="value">%D</span>' + 
                  '<span class="label">' + word_days + '</span>' +
                '</div>' + 
                '<div class="counter">' + 
                  '<span class="value">%H</span>' + 
                  '<span class="label">' + word_hr + '</span>' + 
                '</div>' + 
                '<div class="counter">' + 
                  '<span class="value">%M</span>' + 
                  '<span class="label">' + word_min + '</span>' + 
                '</div>' + 
                '<div class="counter">' + 
                  '<span class="value">%S</span>' + 
                  '<span class="label">' + word_sec + '</span>' + 
                '</div>';

          $this.countdown(future_date, function(event) {
            var $this = $(this).html(event.strftime(str));
          });
        });
      }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-countdown-timer-current.default",
            WidgetCountDownTimerHandler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-countdown-timer-current.skin-style1",
            WidgetCountDownTimerHandler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-countdown-timer-current.skin-style2",
            WidgetCountDownTimerHandler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-countdown-timer-current.skin-style3",
            WidgetCountDownTimerHandler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-countdown-timer-current.skin-style4",
            WidgetCountDownTimerHandler
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-countdown-timer-current.skin-style5",
            WidgetCountDownTimerHandler
        );
    });


})(jQuery);