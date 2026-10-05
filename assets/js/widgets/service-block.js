(function ($) {
  'use strict';

  var WidgetServiceBlock1Handler = function ($scope) {
    var $innerBlocks = $scope.find('.service-block-style1 .inner-block');
    if (!$innerBlocks.length) {
      return;
    }

    $scope.off('click.tmServiceBlock1', '.service-block-style1 .inner-block .title-box');
    $scope.on('click.tmServiceBlock1', '.service-block-style1 .inner-block .title-box', function (event) {
      if ($(event.target).closest('a').length) {
        return;
      }

      var $clickedInner = $(this).closest('.inner-block');
      var wasActive = $clickedInner.hasClass('active');

      $innerBlocks.removeClass('active');

      if (!wasActive) {
        $clickedInner.addClass('active');
      }
    });

    // First item open by default.
    $innerBlocks.removeClass('active');
    $innerBlocks.first().addClass('active');
  };

  function registerHandler() {
    if (typeof elementorFrontend === 'undefined' || !elementorFrontend.hooks) {
      return false;
    }
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/tm-ele-service-block.skin-style1',
      WidgetServiceBlock1Handler
    );
    return true;
  }

  if (!registerHandler()) {
    $(window).on('elementor/frontend/init', registerHandler);
  }
})(jQuery);
