(function($) {
    'use strict';

    var $document_body = $(document.body);
    function getRandomValue(min, max) {
      return Math.floor(Math.random() * (max - min) + min);
    }
    var WidgetPieChartHandler = function ($scope) {
      var piechart = '.tm-sc-pie-chart .pie-chart';
      var $piechart = $(piechart);
      if( $piechart.length > 0 ) {
        $piechart.appear();
        var randomNum = getRandomValue(10, 400);
        $document_body.on('appear', piechart, function() {
          var current_item = $(this);
          setTimeout(function () {
            if (!current_item.hasClass('appeared')) {
              current_item.easyPieChart({
                onStep: function(from, to, percent) {
                  $(this.el).find('.percent').text(Math.round(percent));
                }
              });
              current_item.addClass('appeared');
            }
          }, randomNum);
        });
      }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-pie-chart.default",
            WidgetPieChartHandler
        );
    });


})(jQuery);