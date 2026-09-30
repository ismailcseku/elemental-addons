(function($) {
    'use strict';


    var WidgetAwardBlock2Handler = function ($scope) {
        	// Hover reveal start
	const hoverItems = document.querySelectorAll(".rr-hover-reveal-item2");

        hoverItems.forEach((item, i) => {
            let hoverImage = item.children[1]; // assuming 2nd child is image
            let isHovering = false;

            item.addEventListener("mouseenter", () => {
                isHovering = true;
                hoverImage.style.opacity = 1;
                animate();
            });

            item.addEventListener("mouseleave", () => {
                isHovering = false;
                hoverImage.style.opacity = 0;
            });

            let mouseX = 0, mouseY = 0;
            let currentX = 0, currentY = 0;

            item.addEventListener("mousemove", (e) => {
                const rect = item.getBoundingClientRect();
                mouseX = e.clientX - rect.left;
                mouseY = e.clientY - rect.top;
            });

            function animate() {
                if (!isHovering) return;
                currentX += (mouseX - currentX) * 0.1;
                currentY += (mouseY - currentY) * 0.1;
                hoverImage.style.transform = `translate(${currentX}px, ${currentY}px)`;
                requestAnimationFrame(animate);
            }
        });
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-award-block.skin-style2",
            WidgetAwardBlock2Handler
        );
    });


})(jQuery);