(function($) {
  'use strict';

  function show_secondary_price(pricing_plan){
    pricing_plan.addClass('show-secondary-price');
    var pricing_btn = pricing_plan.find('.btn');
    var secondary_btn_url = pricing_btn.data("secondary-link");
    pricing_btn.attr("href", secondary_btn_url);
  }
  function hide_secondary_price(pricing_plan){
    pricing_plan.removeClass('show-secondary-price');
    var pricing_btn = pricing_plan.find('.btn');
    var normal_btn_url = pricing_btn.data("normal-link");
    pricing_btn.attr("href", normal_btn_url);
  }

  //smart btn
  var TM_Pricing_Switcher_Smart = function ($scope) {
    var pricing_smart_switcher = $('.tm-pricing-plan-switcher');
    if( pricing_smart_switcher.length > 0 ) {
      pricing_smart_switcher.find("[data-pricing-trigger]").on("click", function (e) {
        var $self = $(e.target);
        $self.toggleClass("secondary-active");
        var pricing_plan = $self.parents(".e-con-inner").find(".tm-sc-pricing-plan");

        if( $self.hasClass( 'secondary-active' ) ) {
          show_secondary_price(pricing_plan);
        } else {
          hide_secondary_price(pricing_plan);
        }
      });
    }
  };

  //round, flat btn
  var TM_Pricing_Switcher_Btn = function ($scope) {
    var pricing_btn_switcher = $('.tm-pricing-plan-switcher-button');
    if( pricing_btn_switcher.length > 0 ) {
      pricing_btn_switcher.find("[data-pricing-trigger]").on("click", function (e) {
        var target_id = $(this).data('show');
        var $self = $(e.target);
        pricing_btn_switcher.find("[data-pricing-trigger]").removeClass("active");
        $(this).addClass("active");
        var pricing_plan = $self.parents(".e-con-inner").find(".tm-sc-pricing-plan");

        if( target_id == "year" ) {
          show_secondary_price(pricing_plan);
        } else {
          hide_secondary_price(pricing_plan);
        }
      });
    }
  };


  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-pricing-plan-switcher.default",
          TM_Pricing_Switcher_Smart
      );
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-pricing-plan-switcher.skin-style1",
          TM_Pricing_Switcher_Smart
      );
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-pricing-plan-switcher.skin-style2",
          TM_Pricing_Switcher_Btn
      );
  });
})(jQuery);