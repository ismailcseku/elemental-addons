(function ($) {
    "use strict";

    const WGLMathUtils = {
        map: (x, a, b, c, d) => (x - a) * (d - c) / (b - a) + c,
        lerp: (a, b, n) => (1 - n) * a + n * b,
    };

    const tmGetWinSize = () => {
        return {
            width: window.innerWidth,
            height: window.innerHeight
        };
    };
    let tmWinSize = tmGetWinSize();
    window.addEventListener('resize', () => tmWinSize = tmGetWinSize());

    jQuery(window).on('elementor/frontend/init', function () {
        class TMMovingTextHandlerClass extends elementorModules.frontend.handlers.Base {
            getDefaultSettings() {
                return {
                    selectors: {
                        pathContainer: '.tm-moving-text',
                        svg: '.tm-moving-text > svg',
                        line: '.tm-moving-text > .simple_line',
                    }
                };
            }

            getDefaultElements() {
                var _this$getSettings = this.getSettings(),
                    selectors = _this$getSettings.selectors;
                var element = this.$element[0];
                return {
                    widgetWrapper: element,
                    pathContainer: element.querySelector(selectors.pathContainer),
                    svg: element.querySelector(selectors.svg),
                    line: element.querySelector(selectors.line),
                    textPath: element.querySelector(selectors.textPath)
                };
            }

            onInit() {
                this.elements = this.getDefaultElements(); // Generate unique IDs using the wrapper's `data-id`.

                this.pathId = "wgl-path-".concat(this.elements.widgetWrapper.dataset.id);
                this.textPathId = "tm-moving-text-".concat(this.elements.widgetWrapper.dataset.id);

                if (!this.elements.svg && !this.elements.line) {
                    return;
                }
                this.getPropertyPosition();
                this.initTextPath();

                if(this.elements.pathContainer.classList.contains("loop_animation")){
                    window.addEventListener('resize', () => {
                        this.getPropertyPosition();
                        this.appendAnimate();
                    });

                    if(this.elements.pathContainer.classList.contains("clone_text")){
                        window.addEventListener('resize', () => {
                            this.cloneText();
                        });
                    }

                    if(this.elements.line){
                        this.animate_line();
                        window.addEventListener('resize', this.debounce(() => {
                            this.createMarquee();
                        }), false);
                    }
                    if(
                        this.elements.pathContainer.classList.contains("stop_on_hover")
                        && this.elements.svg
                    ){
                        this.elements.svg.addEventListener('mouseenter', e => {
                            this.elements.svg.pauseAnimations();
                        });

                        this.elements.svg.addEventListener('touchstart', e => {
                            this.elements.svg.pauseAnimations();
                        });

                        this.elements.svg.addEventListener('touchend', e => {
                            this.elements.svg.unpauseAnimations();
                        });

                        this.elements.svg.addEventListener('mouseleave', e => {
                            this.elements.svg.unpauseAnimations();
                        });
                    }
                }

                if(this.elements.pathContainer.classList.contains("scroll_animation")){
                    this.svgRect = this.elements.svg ? this.elements.svg.getBoundingClientRect() : this.elements.line.getBoundingClientRect();
                    this.positionY = this.svgRect.top + window.pageYOffset;

                    window.addEventListener('resize', () => {
                        this.getPropertyPosition();
                        this.appendAnimate();
                        this.svgRect = this.elements.svg ? this.elements.svg.getBoundingClientRect() : this.elements.line.getBoundingClientRect();
                        this.positionY = this.svgRect.top + window.pageYOffset;
                    });

                    this.observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            this.isVisible = entry.intersectionRatio > 0;
                            if (!this.isVisible) {
                                this.update();
                            }
                        });
                    });

                    this.observer.observe(this.elements.svg ? this.elements.svg : this.elements.line);

                    requestAnimationFrame(() => this.render());
                }

                window.addEventListener('resize', () => {
                    this.textPosChange();
                });
            }

            createMarquee() {
                if ('animate' in this.marquee_el && typeof this.marquee_el.animate === 'function') {
                    if (typeof this.marquee !== 'undefined') this.marquee.cancel();
                    if (!this.elements.line.querySelector('.text--word')) return;
                    let vw = this.elements.line.querySelector('.text--word').clientWidth;
                    this.marquee = this.marquee_el.animate([
                        { transform: 'translateX(0)', offset: 0 },
                        { transform: 'translateX(-' + vw + 'px)', offset: 1 }
                    ],
                        {
                            duration: this.animation_speed,
                            easing: 'linear',
                            delay: 0,
                            iterations: Infinity,
                            fill: 'forwards'
                        });
                }
            }

            animate_line() {
                this.marquee = undefined;
                this.marquee_el = this.elements.line.querySelector('.simple_line--wrapper');

                if ('animate' in this.marquee_el && typeof this.marquee_el.animate === 'function') {
                    this.createMarquee();
                    if(this.elements.pathContainer.classList.contains("stop_on_hover")){
                        this.marquee_el.addEventListener('mouseenter', () => {this.pauseMarquee()});
                        this.marquee_el.addEventListener('mouseleave', () => {this.playMarquee()});
                    }
                }
            }

            playMarquee() {
                if (this.marquee.playState === 'paused') this.marquee.play();
            }

            pauseMarquee() {
                if (this.marquee.playState === 'running') this.marquee.pause();
            }

            debounce(func) {
                var scheduled, context, args;
                return function () {
                    context = this; args = [];
                    for (var i = 0; i < arguments.length; ++i) args[i] = arguments[i];
                    !!scheduled && window.cancelAnimationFrame(scheduled);
                    scheduled = window.requestAnimationFrame(function () {
                        func.apply(context, args);
                        scheduled = null;
                    });
                }
            }

            textPosChange() {
                document.querySelectorAll('tspan.text_divider').forEach(function(e){
                    if(e.closest('svg')){
                        e.setAttribute("dy", -1 * getComputedStyle(e.closest('svg')).getPropertyValue('--top-offset'));
                        e.setAttribute("dx", -1 * getComputedStyle(e.closest('svg')).getPropertyValue('--left-offset'));
                    }
                });

                document.querySelectorAll('tspan.divider').forEach(function(e){
                    if(e.closest('svg')){
                        e.setAttribute("dy", getComputedStyle(e.closest('svg')).getPropertyValue('--top-offset'));
                        e.setAttribute("dx", getComputedStyle(e.closest('svg')).getPropertyValue('--left-offset'));
                    }
                });
            }

            setOffset(offset, endPoint) {
                this.startOffset = {
                    value: parseInt(offset),
                    getDefaultStartPoint: offset || 0,
                    getDefaultEndPoint: endPoint || 0,
                    amt: 0.1
                };

                if (!this.elements.textPath) {
                    return;
                }

                this.elements.textPath.setAttribute('startOffset', this.elements.pathContainer.classList.contains("clone_text") ? 0 : offset + '');
            }

            appendAnimate() {
                if (!this.elements.textPath) {
                    return;
                }
                if(
                    this.elements.pathContainer.classList.contains("loop_animation") && !this.elements.pathContainer.classList.contains("clone_text")
                ){
                    if(this.elements.svg.querySelector('animate')){
                        this.elements.svg.querySelector('animate').remove();
                    }
                    if(this.elements.pathContainer.dataset.typeSvg !== 'circle'){
                        this.elements.textPath.insertAdjacentHTML('beforeend', '<animate attributeName="startOffset" from="'+this.startPoint +'" to ="'+ this.endPoint +'" begin="0s" dur="'+(this.animation_speed/1000)+'s" repeatCount="indefinite"/>');
                    }
                    if(this.elements.pathContainer.dataset.typeSvg === 'circle'){
                        this.elements.pathContainer.classList.add('rotate_circle');
                        this.elements.svg.style.animationDuration = this.animation_speed/1000 + 's';
                    }
                }
            }

            cloneText() {
                if (!this.elements.textPath && !this.elements.line) {
                    return;
                }

                let animation_speed = this.animation_speed;
                let to = this.endPoint;
                let from = this.startPoint;
                let backspace = this.elements.pathContainer.dataset.backspaceCount;

                if (this.elements.line) {
                    this.elements.line.querySelector('.simple_line--wrapper').innerHTML = '';
                }

                this.word.innerHTML = this.getDefautWord;
                this.width = Math.ceil(this.elements.textPath ? this.elements.textPath.getBBox().width : this.word.querySelector('.text--word').getBoundingClientRect().width);
                this.times = Math.ceil(window.innerWidth / this.width);

                if (this.elements.textPath) {
                    this.elements.textPath.parentNode.style.width = `${(this.times + 1) * this.width}px`;
                } else {
                    this.elements.line.querySelector('.simple_line--wrapper').style.width = `${(this.times + 1) * this.width}px`;
                }

                let countItem = 0;
                let i;

                if (this.times !== Infinity && this.times < 100) {
                    let times_item = this.elements.pathContainer.classList.contains("clone_text") && this.elements.pathContainer.classList.contains("scroll_animation") ? 2 * this.times : this.times;
                    for (i = 0; i < times_item; i++) {
                        let space = '';
                        for (let k = 0; k <= backspace; k++) {
                            space += '\u00A0';
                            countItem++;
                        }
                        if (this.elements.textPath) {
                            this.word.insertAdjacentHTML('beforeend', space);
                        } else {
                            this.word.querySelectorAll('.text--word')[i].insertAdjacentHTML('beforeend', space);
                        }

                        if (
                            this.elements.pathContainer.classList.contains("add_divider")
                        ) {
                            if (this.elements.textPath) {
                                this.word.insertAdjacentHTML('beforeend', '<tspan class="divider" dy="' + getComputedStyle(this.elements.svg).getPropertyValue('--top-offset') + '" dx="' + getComputedStyle(this.elements.svg).getPropertyValue('--left-offset') + '">' + this.divider() + '</tspan>');
                            } else {
                                this.word.querySelectorAll('.text--word')[i].insertAdjacentHTML('beforeend', '<span class="divider">' + this.divider() + '</span>');
                            }
                        }

                        this.word.insertAdjacentHTML('beforeend', this.getDefautWord);
                    }

                    if (
                        !this.elements.pathContainer.classList.contains("scroll_animation")
                    ) {
                        if (this.elements.textPath) {
                            if(this.elements.pathContainer.dataset.typeSvg !== 'circle'){
                                this.word.innerHTML += '<animate attributeName="startOffset" from="' + from + '" to ="' + to + '" begin="0s" dur="' + (animation_speed / 1000) + 's" repeatCount="indefinite"/>';
                            }
                            if(this.elements.pathContainer.dataset.typeSvg === 'circle'){
                                this.elements.pathContainer.classList.add('rotate_circle');
                                this.elements.svg.style.animationDuration = animation_speed / 1000 + 's';
                            }
                        }

                    }
                }

                this.textPosChange();
            }

            onElementChange(setting) {
                var _this$getElementSetti = this.getElementSettings(),
                    startPoint =  this.elements.svg ? getComputedStyle(this.elements.svg).getPropertyValue('--start-point') : getComputedStyle(this.elements.line).getPropertyValue('--start-point'),
                    endPoint = this.elements.svg ? getComputedStyle(this.elements.svg).getPropertyValue('--end-point') : getComputedStyle(this.elements.line).getPropertyValue('--end-point') ,
                    text = _this$getElementSetti.text;

                this.animation_speed = _this$getElementSetti.animation_speed;
                switch (setting) {
                    case 'start_point':
                    case 'end_point':
                    case 'start_point_mobile':
                    case 'start_point_mobile_extra':
                    case 'start_point_tablet':
                    case 'start_point_tablet_extra':
                    case 'start_point_laptop':
                    case 'start_point_desktop':
                    case 'start_point_widescreen':
                    case 'end_point_mobile':
                    case 'end_point_mobile_extra':
                    case 'end_point_tablet':
                    case 'end_point_tablet_extra':
                    case 'end_point_laptop':
                    case 'end_point_desktop':
                    case 'end_point_widescreen':
                        this.getPropertyPosition();
                        this.setOffset(startPoint ? startPoint : 0, endPoint ? endPoint : 0);
                        this.appendAnimate();
                        break;

                    case 'top_offset':
                    case 'left_offset':
                    case 'top_offset_mobile':
                    case 'top_offset_mobile_extra':
                    case 'top_offset_tablet':
                    case 'top_offset_tablet_extra':
                    case 'top_offset_laptop':
                    case 'top_offset_desktop':
                    case 'top_offset_widescreen':
                    case 'left_offset_mobile':
                    case 'left_offset_mobile_extra':
                    case 'left_offset_tablet':
                    case 'left_offset_tablet_extra':
                    case 'left_offset_laptop':
                    case 'left_offset_desktop':
                    case 'left_offset_widescreen':
                        this.textPosChange();
                        break;

                    case 'text':
                    case 'animation_speed':
                        this.getPropertyPosition();
                        this.setText(text);
                        this.appendAnimate();
                        if(this.elements.pathContainer.classList.contains("clone_text")){
                            this.cloneText();
                        }
                        if(this.elements.line){
                            this.animate_line();
                        }
                        break;

                    default:
                        break;
                }
            }

            attachIdToPath() {
                // Prioritize the custom `data` attribute over the `path` element, and fallback to the first `path`.
                if (!this.elements.svg) {
                    return;
                }

                var path = this.elements.svg.querySelector('[data-path-anchor]') || this.elements.svg.querySelector('path');
                if(!path){
                    return;
                }
                path.id = this.pathId;
            }
            getPropertyPosition(){
                this.startPoint = this.elements.svg ? getComputedStyle(this.elements.svg).getPropertyValue('--start-point') : getComputedStyle(this.elements.line).getPropertyValue('--start-point');
                this.endPoint = this.elements.svg ? getComputedStyle(this.elements.svg).getPropertyValue('--end-point') : getComputedStyle(this.elements.line).getPropertyValue('--end-point');
            }

            initTextPath() {
                var _this$getElementSetti2 = this.getElementSettings();
                this.animation_speed = _this$getElementSetti2.animation_speed;

                var text = this.elements.pathContainer.dataset.text;
                this.attachIdToPath(); // Generate the `textPath` element with its settings.

                if(this.elements.svg){
                    this.elements.svg.innerHTML += "\n\t\t\t<text>\n\t\t\t\t<textPath id=\"".concat(this.textPathId, "\" href=\"#").concat(this.pathId, "\"></textPath>\n\t\t\t</text>\n\t\t"); // Regenerate the elements object to have access to `this.elements.textPath`.
                    this.elements.textPath = this.elements.svg.querySelector("#".concat(this.textPathId));
                }else if(this.elements.line){
                    this.elements.line.innerHTML += "<div class=\"simple_line--wrapper\"></div>";
                }
                this.setOffset(this.startPoint ? this.startPoint : 0,  this.endPoint ?  this.endPoint : 0);
                this.setText(text);
            }

            setText(newText) {

                if(!newText){
                    return;
                }
                var _this$getElementSetti4;

                var _this$getElementSetti3 = (_this$getElementSetti4 = this.getElementSettings()) === null || _this$getElementSetti4 === void 0 ? void 0 : _this$getElementSetti4.link,
                    url = _this$getElementSetti3.url,
                    isExternal = _this$getElementSetti3.is_external,
                    nofollow = _this$getElementSetti3.nofollow;

                var target = isExternal ? '_blank' : '',
                    rel = nofollow ? 'nofollow' : ''; // Add link attributes.

                if(
                    this.elements.pathContainer.classList.contains("add_divider")
                ){
                    if(this.elements.svg){
                        newText = '<tspan class="text_divider" dy="'+(-1 * getComputedStyle(this.elements.svg).getPropertyValue('--top-offset'))+'" dx="'+(-1 * getComputedStyle(this.elements.svg).getPropertyValue('--left-offset'))+'"> '.concat((0, newText), '</tspan>');
                    }else{
                        newText = '<span class="text"> '.concat((0, newText), '</span>');
                    }
                }

                if (url) {
                    newText = "<a href=\"".concat((0, this.escapeHTML)(url), "\" rel=\"").concat(rel, "\" target=\"").concat(target, "\">").concat((0, newText), "</a>");
                } // Set the text.

                if(
                    this.elements.pathContainer.classList.contains("add_divider")
                    && !this.elements.pathContainer.classList.contains("clone_text")
                ){

                    if(this.elements.svg){
                        newText += '<tspan class="divider" dy="'+getComputedStyle(this.elements.svg).getPropertyValue('--top-offset')+'" dx="'+getComputedStyle(this.elements.svg).getPropertyValue('--left-offset')+'">'+ this.divider() +'</tspan>';
                    }else{
                        newText += '<span class="divider_line">'+ this.divider() +'</span>';
                    }
                }

                if(this.elements.svg){
                    this.elements.textPath.innerHTML = '';
                    this.elements.textPath.innerHTML = newText; // Remove the cloned element if exists.
                }else{
                    let newNode = document.createElement('span');
                    newNode.className = 'text--word';
                    newNode.innerHTML = newText;
                    this.elements.line.querySelector('.simple_line--wrapper').innerHTML = '';
                    this.elements.line.querySelector('.simple_line--wrapper').appendChild(newNode);
                }

                if(this.elements.pathContainer.classList.contains("clone_text")){
                    this.word = this.elements.svg ? this.elements.textPath : this.elements.line.querySelector('.simple_line--wrapper');
                    this.getDefautWord = this.word.innerHTML;
                    this.cloneText();
                }

                this.appendAnimate();

                if(this.elements.svg){
                    var existingClone = this.elements.svg.querySelector("#".concat(this.textPathId, "-clone"));

                    if (existingClone) {
                        existingClone.remove();
                    } // Reverse the text if needed.

                    if (this.shouldReverseText()) {
                        // Keep an invisible selectable copy of original element for better a11y.
                        var clone = this.elements.textPath.cloneNode();
                        clone.id += '-clone';
                        clone.classList.add('elementor-hidden');
                        clone.textContent = newText;
                        this.elements.textPath.parentNode.appendChild(clone);
                        this.reverseToRTL();
                    }
                }
            }

            isRTL() {
                var _this$getElementSetti5 = this.getElementSettings(),
                    direction = _this$getElementSetti5.text_path_direction;

                var isRTL = elementorFrontend.config.is_rtl;

                if (direction) {
                    isRTL = 'rtl' === direction;
                }

                return isRTL;
            }

            shouldReverseText() {
                return this.isRTL() && -1 === navigator.userAgent.indexOf('Firefox');
            }

            escapeHTML(str) {
                var specialChars = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
                };
                return str.replace(/[&<>'"]/g, function (tag) {
                return specialChars[tag] || tag;
                });
            }

            reverseToRTL() {
                // Make sure to use the inner `a` tag if exists.
                var parentElement = this.elements.textPath;
                parentElement = parentElement.querySelector('a') || parentElement; // Catch all RTL chars and reverse their order.

                var pattern = /([\u0591-\u07FF\u200F\u202B\u202E\uFB1D-\uFDFD\uFE70-\uFEFC\s$&+,:;=?@#|'<>.^*()%!-]+)/ig; // Reverse the text.

                parentElement.textContent = parentElement.textContent.replace(pattern, function (word) {
                    return word.split('').reverse().join('');
                }); // Add a11y attributes.

                parentElement.setAttribute('aria-hidden', true);
            }

            computeOffset() {
                const fromValue = parseInt(this.startOffset.getDefaultStartPoint);
                const toValue = parseInt(this.startOffset.getDefaultEndPoint);

                const val =  WGLMathUtils.map(this.positionY - window.pageYOffset, tmWinSize.height, -1 * this.svgRect.height,  fromValue, toValue);
                if(fromValue > toValue){
                    return Math.max(Math.min(val, fromValue), toValue);
                }else{
                    return Math.min(Math.max(val, fromValue), toValue);
                }
            }

            updateTextPathOffset() {
                if (!this.elements.textPath && !this.elements.line) {
                    return;
                }
                if(this.elements.pathContainer.dataset.typeSvg === 'circle'){
                    let rotate = 360 * this.startOffset.value / 100;
                    this.elements.svg.style.transform = 'rotate(' + rotate + 'deg)';
                }else if(this.elements.pathContainer.dataset.typeSvg === 'mascot_line_simple'){
                    this.elements.line.style.transform = 'translateX(' + this.startOffset.value + 'px)';
                }else{
                    this.elements.textPath.setAttribute('startOffset', this.startOffset.value + '%');
                }
            }

            divider() {
                let divider;

                switch (this.elements.pathContainer.dataset.dType) {
                    case 'star':
                        divider = '*';
                        break;

                    case 'line':
                        divider = '//';
                        break;
                    
                    case 'arrow':
                        divider = '<svg viewBox="0 0 31 31" xmlns="http://www.w3.org/2000/svg"><path d="M18.6742 30.3182L13.2701 30.2776L13.1406 13.0492L13.1316 11.8549L12.287 12.6994L5.30318 19.6833L1.44794 15.828L15.7504 1.52543L30.2803 16.0555L26.4931 19.8426L19.3983 12.7477L18.5355 11.8849L18.5447 13.105L18.6742 30.3182Z"/></svg>';
                        break;

                    case 'custom':
                        divider = this.elements.pathContainer.dataset.dCustom;
                        break;

                    default:
                        break;
                }

                return divider
            }

            update() {
                const currentOffset = this.computeOffset();
                this.startOffset.value = WGLMathUtils.lerp(this.startOffset.value, currentOffset, this.startOffset.amt);
                this.updateTextPathOffset();
            }

            render() {
                if ( this.isVisible ) {
                    this.update();
                }
                requestAnimationFrame(() => this.render());
            }
        }

        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(TMMovingTextHandlerClass, {
                $element,
            });
        };

        elementorFrontend.hooks.addAction('frontend/element_ready/tm-ele-moving-text.default', addHandler);
    });

})(jQuery);
