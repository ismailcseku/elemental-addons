(function($) {
  'use strict';

  var TM_Interactive_Tabs_Title = function ($scope) {
    if ($('.tm-interactive-tabs').length) {
      $('.tm-interactive-tabs').each(function() {
        var $this_tabs = jQuery(this);
        var target_parent = $($this_tabs.attr('data-tab-content-id'));
        $this_tabs.find('.tab-buttons .tab-btn').each(function() {
          var $this = jQuery(this);
          if ($this.hasClass('active-btn')) {
            var target = $($this.attr('data-tab'));
            $(target_parent).find(target).fadeIn(500).addClass('active-tab');
          }
        });
        $this_tabs.find('.tab-buttons .tab-btn').on('click', function (e) {
          e.preventDefault();
          var $this = jQuery(this);
          var target = $($this.attr('data-tab'));
          if ($(target_parent).find(target).is(':visible')) {
            return false;
          } else {
            $this.parents('.e-parent').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
            $this.addClass('active-btn');
            $this.parents('.e-parent').find('.tm-interactive-tabs-content').find('.tab').fadeOut(0);
            $this.parents('.e-parent').find('.tm-interactive-tabs-content').find('.tab').removeClass('active-tab');
            $(target_parent).find(target).fadeIn(500).addClass('active-tab');
          }
        });
      });
    }
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-interactive-tabs-title.default",
          TM_Interactive_Tabs_Title
      );
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-interactive-tabs-title.skin-style1",
          TM_Interactive_Tabs_Title
      );
  });
})(jQuery);