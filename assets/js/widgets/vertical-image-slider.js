(function($) {
	'use strict';

	/**
	 * Initialize Vertical Image Slider
	 */
	function initVerticalImageSlider($scope, $) {
		var $slider = $scope.find('.tm-sc-vertical-image-slider');

		if ($slider.length === 0) {
			return;
		}

		$slider.each(function() {
			var $this = $(this);
			var $swiperContainer = $this.find('.swiper');

			// Destroy existing Swiper instance if it exists
			var existingSwiper = $this.data('swiper-instance');
			if (existingSwiper && typeof existingSwiper.destroy === 'function') {
				existingSwiper.destroy(true, true);
			}

			// Get data attributes
			var direction = $this.data('direction') || 'vertical';
			var speed = parseInt($this.data('speed')) || 3000;
			var slidesPerView = $this.data('slides-per-view') || 2.5;
			var slidesPerViewTablet = $this.data('slides-per-view-tablet');
			var slidesPerViewMobile = $this.data('slides-per-view-mobile');
			var spaceBetween = parseInt($this.data('space-between')) || 20;
			var loop = $this.data('loop') === true || $this.data('loop') === 'true';
			var mousewheel = $this.data('mousewheel') === true || $this.data('mousewheel') === 'true' || $this.data('mousewheel') === 'yes';
			var allowDrag = $this.data('allow-drag');
			// Check if allowDrag is enabled (defaults to true if not set or empty)
			var allowDragEnabled = allowDrag === true || allowDrag === 'true' || allowDrag === 'yes' || allowDrag === undefined || allowDrag === '';
			var freeMode = $this.data('free-mode') === true || $this.data('free-mode') === 'true';
			var reverseDirection = $this.data('reverse-direction') === true || $this.data('reverse-direction') === 'true';
			var autoplay = $this.data('autoplay') === true || $this.data('autoplay') === 'true';
			var autoplayDelay = parseInt($this.data('autoplay-delay')) || 0;

			// Helper function to parse slides per view
			function parseSlidesPerView(value) {
				if (!value || value === '' || value === 'auto') {
					return 'auto';
				}
				return parseFloat(value);
			}

			// Parse slides per view values
			var desktopSlidesPerView = parseSlidesPerView(slidesPerView);
			var tabletSlidesPerView = slidesPerViewTablet && slidesPerViewTablet !== '' ? parseSlidesPerView(slidesPerViewTablet) : null;
			var mobileSlidesPerView = slidesPerViewMobile && slidesPerViewMobile !== '' ? parseSlidesPerView(slidesPerViewMobile) : null;

			// Determine base slidesPerView (for mobile/0-767px)
			// Use mobile if set, otherwise use desktop as fallback
			var baseSlidesPerView = mobileSlidesPerView !== null ? mobileSlidesPerView : desktopSlidesPerView;

			// Build Swiper configuration
			// Base config applies to mobile (0-767px) by default
			var swiperConfig = {
				direction: direction,
				speed: speed,
				slidesPerView: baseSlidesPerView,
				spaceBetween: spaceBetween,
				loop: loop,
				grabCursor: allowDragEnabled,
				allowTouchMove: allowDragEnabled,
				simulateTouch: allowDragEnabled,
			};

			// Add responsive breakpoints
			// Elementor breakpoints: Mobile (max 767px), Tablet (768-1024px), Desktop (1025px+)
			// Swiper uses min-width breakpoints, so breakpoints override from their min-width upward
			var breakpoints = {};

			// Tablet breakpoint (768px+) - overrides mobile/base
			if (tabletSlidesPerView !== null) {
				breakpoints[768] = {
					slidesPerView: tabletSlidesPerView
				};
			}

			// Desktop breakpoint (1025px+) - overrides tablet
			// Always set if tablet or mobile is different from desktop, or if tablet is set
			if (tabletSlidesPerView !== null || mobileSlidesPerView !== null) {
				// Only add desktop breakpoint if it's different from what would be used at 768px
				var valueAt768 = tabletSlidesPerView !== null ? tabletSlidesPerView : baseSlidesPerView;
				if (desktopSlidesPerView !== valueAt768) {
					breakpoints[1025] = {
						slidesPerView: desktopSlidesPerView
					};
				}
			}

			// Add breakpoints to config if any are defined
			if (Object.keys(breakpoints).length > 0) {
				swiperConfig.breakpoints = breakpoints;
			}

			// Add mousewheel control
			swiperConfig.mousewheel = {
				enabled: mousewheel,
				releaseOnEdges: mousewheel,
				sensitivity: 1,
			};

			// Add free mode
			if (freeMode) {
				swiperConfig.freeMode = {
					enabled: true,
					sticky: false,
					momentum: true,
					momentumRatio: 1,
					momentumVelocityRatio: 1,
				};
			}

			// Add autoplay with reverse direction support
			if (autoplay) {
				swiperConfig.autoplay = {
					delay: autoplayDelay,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
					reverseDirection: reverseDirection,
				};
			}

			// Initialize Swiper
			if (typeof Swiper !== 'undefined') {
				var swiper = new Swiper($swiperContainer[0], swiperConfig);

				// Store swiper instance on the element for potential updates
				$this.data('swiper-instance', swiper);

				// Ensure Swiper updates on window resize
				var resizeTimer;
				$(window).on('resize', function() {
					clearTimeout(resizeTimer);
					resizeTimer = setTimeout(function() {
						if (swiper && typeof swiper.update === 'function') {
							swiper.update();
						}
					}, 250);
				});
			}
		});
	}

	// Initialize on Elementor Frontend
	$(window).on('elementor/frontend/init', function() {
		if (typeof elementorFrontend !== 'undefined') {
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-ele-vertical-image-slider.default', initVerticalImageSlider);
		}
	});

	// Initialize on Document Ready (for non-Elementor pages)
	$(document).ready(function() {
		if ($('.tm-sc-vertical-image-slider').length > 0) {
			$('.tm-sc-vertical-image-slider').each(function() {
				initVerticalImageSlider($(this), $);
			});
		}
	});

})(jQuery);

