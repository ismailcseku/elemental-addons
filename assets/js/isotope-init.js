/**
 * Elemental Addons - Isotope grid / masonry initialisation.
 */
(function ($) {
	'use strict';

	var isRTL = function () {
		return $('html').attr('dir') === 'rtl' || $('body').hasClass('rtl');
	};

	var resizeMasonryTiles = function ($layout) {
		if (!$layout.hasClass('masonry-tiles')) {
			return;
		}

		var size = $layout.find('.isotope-item-sizer').width();
		var padding = parseInt($layout.find('.isotope-item:not(.isotope-item-sizer)').css('padding-left'), 10) || 0;
		var $default = $layout.find('.tm-masonry-default');
		var $largeHeight = $layout.find('.tm-masonry-large-height');
		var $largeWide = $layout.find('.tm-masonry-large-wide');
		var $largeWidthHeight = $layout.find('.tm-masonry-large-width-height');

		if ($(window).width() > 680) {
			$default.css('height', size - 2 * padding);
			$largeHeight.css('height', Math.round(2 * size) - 2 * padding);
			$largeWidthHeight.css('height', Math.round(2 * size) - 2 * padding);
			$largeWide.css('height', size - 2 * padding);
		} else {
			$default.css('height', size);
			$largeHeight.css('height', size);
			$largeWidthHeight.css('height', size);
			$largeWide.css('height', Math.round(size / 2));
		}
	};

	var getOptions = function ($layout) {
		var options = {
			originLeft: !isRTL(),
			itemSelector: '.isotope-item',
			layoutMode: 'fitRows',
			filter: '*'
		};

		if ($layout.hasClass('masonry')) {
			options.layoutMode = 'masonry';
			if ($layout.find('.isotope-item-sizer').length) {
				options.masonry = { columnWidth: '.isotope-item-sizer' };
			}
		}

		return options;
	};

	var initLayout = function (element) {
		var $layout = $(element);
		var $inner = $layout.children('.isotope-layout-inner');

		if (!$inner.length || typeof $.fn.isotope !== 'function') {
			return;
		}

		if ($layout.find('.isotope-item:not(.isotope-item-sizer)').length === 1) {
			$layout.addClass('isotope-layout-single-item');
		}

		$layout.addClass('isotope-rendered');

		var run = function () {
			resizeMasonryTiles($layout);
			if ($inner.data('isotope')) {
				$inner.isotope('layout');
			} else {
				$inner.isotope(getOptions($layout));
			}
		};

		run();

		if (typeof window.imagesLoaded === 'function') {
			window.imagesLoaded($inner[0], run);
		}
	};

	var initScope = function ($scope) {
		var $layouts = $scope.is('.isotope-layout') ? $scope : $scope.find('.isotope-layout');
		$layouts.each(function () {
			initLayout(this);
		});
	};

	var resizeTimer;
	$(window).on('resize', function () {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function () {
			$('.isotope-layout.isotope-rendered').each(function () {
				var $layout = $(this);
				var $inner = $layout.children('.isotope-layout-inner');
				resizeMasonryTiles($layout);
				if ($inner.data('isotope')) {
					$inner.isotope('layout');
				}
			});
		}, 200);
	});

	$(window).on('elementor/frontend/init', function () {
		if (!window.elementorFrontend || !window.elementorFrontend.hooks) {
			return;
		}
		window.elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
			initScope($scope);
		});
	});

	$(function () {
		initScope($(document.body));
	});

	$(window).on('load', function () {
		initScope($(document.body));
	});
})(jQuery);
