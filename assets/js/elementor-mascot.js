(function ($) {
  'use strict';

  function safeThemeMascotInit() {
    if (typeof THEMEMASCOT === 'undefined') {
      return;
    }
    if (THEMEMASCOT.documentOnReady && typeof THEMEMASCOT.documentOnReady.init === 'function') {
      THEMEMASCOT.documentOnReady.init();
    }
    if (THEMEMASCOT.windowOnLoad && typeof THEMEMASCOT.windowOnLoad.init === 'function') {
      THEMEMASCOT.windowOnLoad.init();
    }
  }

  function MascotCoreElementorInitScript() {
    $(window).on('elementor/frontend/init', function () {
      if (typeof elementorFrontend === 'undefined' || !elementorFrontend.hooks) {
        return;
      }
      elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
        safeThemeMascotInit();
      });
    });
  }

  $(window).on('load', function () {
    if (typeof elementorFrontend !== 'undefined' && elementorFrontend.isEditMode && elementorFrontend.isEditMode()) {
      MascotCoreElementorInitScript();
    }
  });
})(jQuery);
