(function($) {
    'use strict';

    var elementorBlogSlider = {};

    elementorBlogSlider.MascotCoreElementorInitScript = MascotCoreElementorInitScript;


    elementorBlogSlider.MascotCoreElementorOnWindowLoad = MascotCoreElementorOnWindowLoad;

    $(window).load(MascotCoreElementorOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function MascotCoreElementorOnWindowLoad() {

        var isEditMode = Boolean(elementorFrontend.isEditMode());
        if (isEditMode) {
            MascotCoreElementorInitScript();
        }
    }

    function MascotCoreElementorInitScript(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/init', function() {
            // Do something that is based on the elementorFrontend object.
            } );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-ele-animated-layers.default', function() {
            } );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
            } );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ) {
                THEMEMASCOT.documentOnReady.init();
                THEMEMASCOT.windowOnLoad.init();
            } );
        });
    }


})(jQuery);