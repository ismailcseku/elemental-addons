(function ($) {
    'use strict';
    var $before_after_slider = $('.twentytwenty-container');
    if ( $.isFunction($.fn.twentytwenty) ) {
        if( $before_after_slider.length > 0 ) {
        $before_after_slider.each(function() {
            var $this = $(this);
            var data_offset_pct = ( $this.data("offset-percent") === undefined ) ? 0.5: $this.data("offset-percent");
            var data_orientation = ( $this.data("orientation") === undefined ) ? 'horizontal': $this.data("orientation");
            var data_before_label = ( $this.data("before-label") === undefined ) ? 'Before': $this.data("before-label");
            var data_after_label = ( $this.data("after-label") === undefined ) ? 'After': $this.data("after-label");
            var data_no_overlay = ( $this.data("no-overlay") === undefined ) ? true: $this.data("no-overlay");
            $this.twentytwenty({
                default_offset_pct: data_offset_pct, // How much of the before image is visible when the page loads
                orientation: data_orientation, // Orientation of the before and after images ('horizontal' or 'vertical')
                before_label: data_before_label, // Set a custom before label
                after_label: data_after_label, // Set a custom after label
                no_overlay: data_no_overlay //Do not show the overlay with before and after
            });
        });
        }
    }

})(jQuery);