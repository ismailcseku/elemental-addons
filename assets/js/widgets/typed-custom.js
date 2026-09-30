(function ($) {
    'use strict';

      var $typed_text_carousel = $('.tm-typed-text-animation');
      if ( $typed_text_carousel.length > 0 ) {
        $typed_text_carousel.each(function() {
          var str = '';
          var $this = $(this);
          var id = $this.attr('id');

          var typed = new Typed('#'+id, {
            contentType: 'html',
            strings: $this.data('typed-strings'),

            loop: $this.data('loop') == 1,
            showCursor: $this.data('cursor') == 1,
            cursorChar: $this.data('cursor-char') != undefined ? $this.data('cursor-char') : '|',
            typeSpeed: $this.data('speed') > 0 ? (11 - Math.max(1, Math.min(10, $this.data('speed')))) * 10 : 50,
            backDelay: $this.data('delay') > 0 ? Math.max(0, Math.min(10, $this.data('delay'))) * 1000 : 1000
          });

          
        });
      }

})(jQuery);