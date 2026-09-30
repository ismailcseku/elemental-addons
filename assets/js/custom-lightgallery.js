(function($) {
	"use strict";
	var THEMEMASCOT_LIGHT_GALLERY = {};

	/* ---------------------------------------------------------------------- */
	/* -------------------------- Declare Variables ------------------------- */
	/* ---------------------------------------------------------------------- */
	var $document = $(document);
	var $document_body = $(document.body);
	var $window = $(window);
	var $html = $('html');
	var $body = $('body');
	var $wrapper = $('#wrapper');
	var $header = $('#header');
	var $header_nav = $('#header .header-nav');
	var $header_navbar_scrolltofixed = $('body.tm-enable-navbar-scrolltofixed');
	var $footer = $('#footer');
	var $sections = $('.vc_row.vc-row-tm-parent-section');
	var windowHeight = $window.height();

	THEMEMASCOT_LIGHT_GALLERY.initialize = {

		init: function() {
			THEMEMASCOT_LIGHT_GALLERY.initialize.TM_lightgallery_lightbox();
			THEMEMASCOT_LIGHT_GALLERY.initialize.TM_lightgallery_lightbox_reset();
		},


		/* ---------------------------------------------------------------------- */
		/* ----------------------------- lightbox popup ------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_lightgallery_lightbox: function() {
			//lightgallery lightbox
			var $lightgallery_lightbox = $(".lightgallery-lightbox");
			if( $lightgallery_lightbox.length > 0 ) {
				$lightgallery_lightbox.lightGallery({
					// Please read about gallery options here: http://sachinchoolur.github.io/lightGallery/docs/api.html
					// lightgallery core 
					selector: '.lightgallery-trigger',
					mode: 'lg-fade', // Type of transition between images ('lg-fade' or 'lg-slide').
					height: '100%', // Height of the gallery (ex: '100%' or '300px').
					width: '100%', // Width of the gallery (ex: '100%' or '300px').
					iframeMaxWidth: '100%', // Set maximum width for iframe.
					loop: true, // If false, will disable the ability to loop back to the beginning of the gallery when on the last element.
					speed: 600, // Transition duration (in ms).
					closable: true, // Allows clicks on dimmer to close gallery.
					escKey: true, // Whether the LightGallery could be closed by pressing the "Esc" key.
					keyPress: true, // Enable keyboard navigation.
					hideBarsDelay: 5000, // Delay for hiding gallery controls (in ms).
					controls: true, // If false, prev/next buttons will not be displayed.
					mousewheel: true, // Chane slide on mousewheel.
					download: false, // Enable download button. By default download url will be taken from data-src/href attribute but it supports only for modern browsers. If you want you can provide another url for download via data-download-url.
					counter: true, // Whether to show total number of images and index number of currently displayed image.
					swipeThreshold: 50, // By setting the swipeThreshold (in px) you can set how far the user must swipe for the next/prev image.
					enableDrag: true, // Enables desktop mouse drag support.
					enableTouch: true, // Enables touch support.

					// thumbnial plugin
					thumbnail: true, // Enable thumbnails for the gallery.
					showThumbByDefault: true, // Show/hide thumbnails by default.
					thumbMargin: 5, // Spacing between each thumbnails.
					toogleThumb: true, // Whether to display thumbnail toggle button.
					enableThumbSwipe: true, // Enables thumbnail touch/swipe support for touch devices.
					exThumbImage: 'data-exthumbimage', // If you want to use external image for thumbnail, add the path of that image inside "data-" attribute and set value of this option to the name of your custom attribute.

					// autoplay plugin
					autoplay: false, // Enable gallery autoplay.
					autoplayControls: true, // Show/hide autoplay controls.
					pause: 6000, // The time (in ms) between each auto transition.
					progressBar: true, // Enable autoplay progress bar.
					fourceAutoplay: false, // If false autoplay will be stopped after first user action

					// fullScreen plugin
					fullScreen: true, // Enable/Disable fullscreen mode.

					// zoom plugin
					zoom: true, // Enable/Disable zoom option.
					scale: 0.5, // Value of zoom should be incremented/decremented.
					enableZoomAfter: 50, // Some css styles will be added to the images if zoom is enabled. So it might conflict if you add some custom styles to the images such as the initial transition while opening the gallery. So you can delay adding zoom related styles to the images by changing the value of enableZoomAfter.

					// video options
					videoMaxWidth: '1000px', // Set limit for video maximal width.

					// Youtube video options
					loadYoutubeThumbnail: true, // You can automatically load thumbnails for youtube videos from youtube by setting loadYoutubeThumbnail true.
					youtubeThumbSize: 'default', // You can specify the thumbnail size by setting respective number: 0, 1, 2, 3, 'hqdefault', 'mqdefault', 'default', 'sddefault', 'maxresdefault'.
					youtubePlayerParams: { // Change youtube player parameters: https://developers.google.com/youtube/player_parameters
						modestbranding: 0,
						showinfo: 1,
						controls: 1
					},

					// Vimeo video options
					loadVimeoThumbnail: true, // You can automatically load thumbnails for vimeo videos from vimeo by setting loadYoutubeThumbnail true.
					vimeoThumbSize: 'thumbnail_medium', // Thumbnail size for vimeo videos: 'thumbnail_large' or 'thumbnail_medium' or 'thumbnail_small'.
					vimeoPlayerParams: { // Change vimeo player parameters: https://developer.vimeo.com/player/embedding#universal-parameters 
						byline : 1,
						portrait : 1,
						title: 1,
						color : 'CCCCCC',
						autopause: 1
					}

				});
			}
		},
		TM_lightgallery_lightbox_reset: function() {
			//lightgallery lightbox reset after ajaxload button
			var $loadmore_btn_lightgallery_lightbox = $(".tm-loadmore-btn-trigger-lightgallery");
			if( $loadmore_btn_lightgallery_lightbox.length > 0 ) {
				$loadmore_btn_lightgallery_lightbox.on('click', function(e) {
					$(".lightgallery-lightbox").data("lightGallery").destroy(true);
					THEMEMASCOT_LIGHT_GALLERY.initialize.TM_lightgallery_lightbox();	
				});
			}
		},

	};


	/* ---------------------------------------------------------------------- */
	/* ---------- document ready, window load, scroll and resize ------------ */
	/* ---------------------------------------------------------------------- */
	//document ready
	THEMEMASCOT_LIGHT_GALLERY.documentOnReady = {
		init: function() {
			THEMEMASCOT_LIGHT_GALLERY.initialize.init();
		}
	};
	

	/* ---------------------------------------------------------------------- */
	/* ---------------------------- Call Functions -------------------------- */
	/* ---------------------------------------------------------------------- */
	$document.ready(
		THEMEMASCOT_LIGHT_GALLERY.documentOnReady.init
	);


})(jQuery);