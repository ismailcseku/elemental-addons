(function ($) {
	"use strict";

	function syncCard($card) {
		var source = $card.find("[data-source-select]").val();
		var $globalWrap = $card.find("[data-global-wrap]");
		var $customWrap = $card.find("[data-custom-wrap]");
		var $swatch = $card.find("[data-swatch]");
		var color = "";

		if (source === "global") {
			$globalWrap.prop("hidden", false);
			$customWrap.prop("hidden", true);
			var $opt = $card.find("[data-global-select] option:selected");
			color = $opt.data("color") || "";
			var id = $opt.val() || "…";
			$card.find(".elemental-base-colors__global-hint code").text("--e-global-color-" + id);
		} else {
			$globalWrap.prop("hidden", true);
			$customWrap.prop("hidden", false);
			color = $card.find("[data-hex-input]").val() || "";
		}

		if (color) {
			$swatch.css("background", color);
		}
	}

	$(function () {
		$(".elemental-base-color-field").wpColorPicker({
			change: function () {
				var $card = $(this).closest(".elemental-base-colors__card");
				setTimeout(function () {
					syncCard($card);
				}, 10);
			},
			clear: function () {
				syncCard($(this).closest(".elemental-base-colors__card"));
			},
		});

		$(".elemental-base-colors__card").each(function () {
			syncCard($(this));
		});

		$(document).on("change", "[data-source-select], [data-global-select]", function () {
			syncCard($(this).closest(".elemental-base-colors__card"));
		});
	});
})(jQuery);
