(function ($) {
  "use strict";
  //gsap pin spacer added - only run on frontend, not in editor
  if (typeof elementorFrontend !== "undefined" && elementorFrontend.isEditMode()) {
    return;
  }

  // Check if GSAP and ScrollTrigger are available
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    return;
  }

  var width = $(window).width();
  if (width > 1024) {
    $(function () {
      var $item = $(".gsap-pin-yes").children();
      let cards = gsap.utils.toArray($item);

      let stickDistance = 0;

      let firstCardST = ScrollTrigger.create({
        trigger: cards[0],
        start: "center center",
      });

      let lastCardST = ScrollTrigger.create({
        trigger: cards[cards.length - 1],
        start: "bottom bottom",
      });

      cards.forEach((card, index) => {
        var scale = 1 - (cards.length - index) * 0.025;
        let scaleDown = gsap.to(card, { scale: scale, "transform-origin": '"50% ' + (lastCardST.start + stickDistance) + '"' });

        ScrollTrigger.create({
          trigger: card,
          start: "center center",
          end: () => lastCardST.start + stickDistance,
          pin: true,
          pinSpacing: false,
          ease: "none",
          animation: scaleDown,
          toggleActions: "restart none none reverse",
        });
      });
    });
  }
})(jQuery);
