(function ($) {
  "use strict";

  function triggerFor($panel) {
    var id = $panel.attr("id");
    return $panel.closest(".tm-accordion").find('[data-bs-target="#' + id + '"]');
  }

  function setState($panel, open) {
    triggerFor($panel)
      .toggleClass("collapsed", !open)
      .attr("aria-expanded", open ? "true" : "false");
    $panel.closest(".card").toggleClass("active", open);
  }

  function finish($panel, open) {
    $panel.removeClass("collapsing").addClass("collapse").css("height", "");
    $panel.toggleClass("show", open);
    $panel.removeData("tmAnimating");
  }

  function animate($panel, open) {
    if ($panel.data("tmAnimating")) {
      return;
    }
    if (open && $panel.hasClass("show")) {
      return;
    }
    if (!open && !$panel.hasClass("show") && !$panel.hasClass("collapsing")) {
      return;
    }

    setState($panel, open);
    $panel.data("tmAnimating", 1);

    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      finish($panel, open);
      return;
    }

    if (open) {
      $panel.removeClass("collapse show").addClass("collapsing").css("height", "0px");
      var end = $panel[0].scrollHeight;
      $panel[0].offsetHeight;
      $panel.css("height", end + "px");
    } else {
      $panel.css("height", $panel[0].getBoundingClientRect().height + "px");
      $panel[0].offsetHeight;
      $panel.removeClass("collapse show").addClass("collapsing").css("height", "0px");
    }

    var done = function (event) {
      var native = event.originalEvent || event;
      if (native.target !== $panel[0] || native.propertyName !== "height") {
        return;
      }
      $panel.off("transitionend", done);
      finish($panel, open);
    };

    $panel.on("transitionend", done);
  }

  $(document).on("click", '.tm-accordion [data-bs-toggle="collapse"]', function (event) {
    event.preventDefault();

    var target = $(this).attr("data-bs-target");
    if (!target) {
      return;
    }

    var $panel = $(target);
    if (!$panel.length || $panel.data("tmAnimating")) {
      return;
    }

    var willOpen = !$panel.hasClass("show");
    var parent = $panel.attr("data-bs-parent");

    if (willOpen && parent) {
      $(parent)
        .find(".collapse.show, .collapsing")
        .each(function () {
          if (this !== $panel[0]) {
            animate($(this), false);
          }
        });
    }

    animate($panel, willOpen);
  });
})(jQuery);
