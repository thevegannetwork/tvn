/*!
 * imagesLoaded PACKAGED v4.1.2
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}("undefined"!=typeof window?window:this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||{};return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter")):t.imagesLoaded=e(t,t.EvEmitter)}("undefined"!=typeof window?window:this,function(t,e){function i(t,e){for(var i in e)t[i]=e[i];return t}function n(t){var e=[];if(Array.isArray(t))e=t;else if("number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e}function o(t,e,r){return this instanceof o?("string"==typeof t&&(t=document.querySelectorAll(t)),this.elements=n(t),this.options=i({},this.options),"function"==typeof e?r=e:i(this.options,e),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(t,e,r)}function r(t){this.img=t}function s(t,e){this.url=t,this.element=e,this.img=new Image}var h=t.jQuery,a=t.console;o.prototype=Object.create(e.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),this.options.background===!0&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&d[e]){for(var i=t.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(e.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,t),n=i.exec(e.backgroundImage)}},o.prototype.addImage=function(t){var e=new r(t);this.images.push(e)},o.prototype.addBackground=function(t,e){var i=new s(t,e);this.images.push(i)},o.prototype.check=function(){function t(t,i,n){setTimeout(function(){e.progress(t,i,n)})}var e=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(e){e.once("progress",t),e.check()}):void this.complete()},o.prototype.progress=function(t,e,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,t,e)},o.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},r.prototype=Object.create(e.prototype),r.prototype.check=function(){var t=this.getIsImageComplete();return t?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var t=this.getIsImageComplete();t&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},o.makeJQueryPlugin=function(e){e=e||t.jQuery,e&&(h=e,h.fn.imagesLoaded=function(t,e){var i=new o(this,t,e);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

(function($){
    "use strict"; // Start of use strict


    /* Inview Js */
    $.fn.inView=function(t){var o={};o.top=$(window).scrollTop(),o.bottom=o.top+$(window).height();var p={};switch(p.top=this.offset().top,p.bottom=p.top+this.outerHeight(),t){case"bottomOnly":return p.bottom<=o.bottom&&p.bottom>=o.top;case"topOnly":return p.top<=o.bottom&&p.top>=o.top;case"both":return p.top>=o.top&&p.bottom<=o.bottom;default:return p.top>=o.top&&p.bottom<=o.bottom}};

    /* ---------------------------------------------
     Scripts initialization
     --------------------------------------------- */

    $(window).load(function(){

        calc_vc_container_size();

        // Page loader
        $(".page-loader .loader").delay(0).fadeOut();
        $(".page-loader").delay(200).fadeOut("slow");

        init_scroll_navigate();

        $(window).trigger("scroll");
        $(window).trigger("resize");

    });

    $(document).ready(function(){

        $(window).trigger("resize");

        // init_classic_menu();
		init_fullscreen_menu();
		init_side_panel();
        init_lightbox();
        init_parallax();
        init_shortcodes();
        init_tooltips();
        init_counters();
        init_team();
        initPageSliders();
        initWorkFilter();
        init_map();
        init_wow();
        init_masonry();
        init_video_bg();
        stickySidebar();
        enableMatchHeight();
    });

    $(window).resize(function(){

        calc_vc_container_size();
        init_classic_menu_resize();
        js_height_init();
        fullwidthElementInit();
        fullHeightElementInit();
		init_side_panel_resize();
        stickySidebar();
        split_height_init();
    });


    /* --------------------------------------------
     Platform detect
     --------------------------------------------- */
    var mobileTest;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        mobileTest = true;
        $("html").addClass("mobile");
    }
    else {
        mobileTest = false;
        $("html").addClass("no-mobile");
    }

    var mozillaTest;
    if (/mozilla/.test(navigator.userAgent)) {
        mozillaTest = true;
    }
    else {
        mozillaTest = false;
    }
    var safariTest;
    if (/safari/.test(navigator.userAgent)) {
        safariTest = true;
    }
    else {
        safariTest = false;
    }

    // Detect touch devices
    if (!("ontouchstart" in document.documentElement)) {
        document.documentElement.className += " no-touch";
    }

    /* ---------------------------------------------
     Sections helpers
     --------------------------------------------- */

    // Sections backgrounds

    var pageSection = $(".home-section, .content-section, .small-section, .split-section, .page-section");
    pageSection.each(function(indx){

        if ($(this).attr("data-background")){
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });

    // Function for block height 100%
    function height_line(height_object, height_donor){
        height_donor.imagesLoaded(function(){
            height_object.height(height_donor.height());
            height_object.css({
                "line-height": height_donor.height() + "px"
            });
        });
    }

    // Function equal height
    !function(a){
        a.fn.equalHeights = function(){
            var b = 0, c = a(this);
            return c.each(function(){
                var c = a(this).innerHeight();
                c > b && (b = c)
            }), c.css("height", b)
        }, a("[data-equal]").each(function(){
            var b = a(this), c = b.data("equal");
            b.find(c).equalHeights()
        })
    }(jQuery);


    // Progress bars
    var progressBar = $(".progress-bar");
    $(window).on("scroll", function() {

       progressBar.each(function(indx){

         var $this = $(this);

         if ($this.inView("topOnly") == true) {
            $this.css("width", $this.attr("aria-valuenow") + "%");
         };

       });
    });

    var pageSection = $(".home-section, .content-section, .small-section, .split-section");
    pageSection.each(function(indx){

        if ($(this).attr("data-background")){
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });


    /*------------------------------------------
    Fullwidth Elements
    ------------------------------------------*/
    function fullwidthElementInit(){
        var container = jQuery('.container:first-child'),
            containerPaddingLeft = parseInt(container.css('padding-left')),
            fullwidthElement = jQuery('.content-section.full-width').not('.with-col');

        if( ! fullwidthElement.length ) {
            return
        };

        fullwidthElement.css({
            marginLeft: (container.offset().left + containerPaddingLeft) * -1,
            marginRight: (container.offset().left + containerPaddingLeft) * -1
        });
        if ( ( $('#top.side-panel-is-left').length || $('#top.side-panel-is-right').length ) && ( $(window).width() >= 1199 )  ) {
            fullwidthElement.css({
                marginLeft: (container.offset().left + containerPaddingLeft - 270) * -1,
                marginRight: (container.offset().left + containerPaddingLeft - 270) * -1
            });
            if( fullwidthElement.outerWidth() == container.outerWidth() ){
                fullwidthElement.css({
                    marginLeft: (container.offset().left + containerPaddingLeft - 270) * -1,
                    marginRight: (container.width() + containerPaddingLeft - $('#top').width())
                });
                jQuery('.content-section.full-width.with-col').css({
                    marginLeft: (container.offset().left + containerPaddingLeft - 270) * -1,
                    marginRight: (container.width() + containerPaddingLeft - $('#top').width())
                });
            }
        };
    };
    fullwidthElementInit();

    function fullHeightElementInit() {
        var el = jQuery('.fullHeight'),
            finalHeight = jQuery(window).outerHeight();

        if ( ! el.length ) {
            return;
        }

        if ( jQuery('.main-nav:not(.stick-fixed)').length ) {
            finalHeight = jQuery(window).outerHeight() - jQuery('.main-nav').outerHeight();
        }

        el.each(function() {
            var $this = jQuery(this);

            $this.height(finalHeight)
        });
    };
    fullHeightElementInit();



    /* ---------------------------------------------
     Nav panel classic
     --------------------------------------------- */

    var mobile_nav = $(".mobile-nav");
    var desktop_nav = $(".desktop-nav");

    function init_classic_menu_resize(){

			var mnHasSub = $(".mn-has-sub"),
				mnMultiCol = $('.mn-sub.mn-has-multi'),
				mnThisLi;

        // Mobile menu max height
        if ($('.main-nav').hasClass('mobile-on') ) {
            $(".inner-nav.desktop-nav").height('');
        }
        $(".mobile-on .desktop-nav > ul").css("max-height", $(window).height() - $(".main-nav").height() - 20 + "px");

        // Mobile menu style toggle
        if ($(window).width() <= 1024) {
            $(".main-nav").addClass("mobile-on");

						if (mnMultiCol.length) {
	            mnMultiCol.each(function() {
								var $this = $(this);

								$this.hide()
									.css({
										'left': '',
										'right': ''
									})

								if ( $this.children('.columns-container').length ) {

									$this.children('.columns-container').children('li').unwrap()

								}
							})
						}

        }
        else if ($(window).width() > 1024) {
          $(".main-nav").removeClass("mobile-on");
          // desktop_nav.show();

	        if (mnMultiCol.length) {
	            mnMultiCol.each(function() {
	                var $this = $(this),
									 liItems = $this.children('li');

									$this.show();

	                if ( $this.offset().left < 0 ) {

										$this.css({
											'left': $this.parent().offset().left * -1,
											'right': 0
										}).addClass('overflowed').children('li').wrapAll('<div class="columns-container"></div>')

	                } else {

										$this.css({
											// 'left': 'auto',
											// 'right': -15
											'left': '',
											'right': ''
										}).removeClass('overflowed');

									}
	            });
	        };
        }

        // if ( $('.main-nav').hasClass('mobile-on') == true ) {
        //     $('.inner-nav.desktop-nav').removeAttr('style');
        // };
    }

    // vc container

    function calc_vc_container_size() {

      var _w = jQuery(window).width();

      $('.page').each(function() {
        // get the width

        var _width = $(this).width();

        var _diff = (_w - _width) / 2 + 15;

        var mainSectionW = $('.main-section').width(),
            containerW = $('.container').first().width();

        $('.content-section.with-col').css({
          marginLeft: '-' + _diff + 'px',
          paddingLeft: _diff + 'px',
          marginRight: '-' + _diff + 'px',
          paddingRight: _diff + 'px'
        });
        if ( ( $('#top.side-panel-is-left').length || $('#top.side-panel-is-right').length ) && ( $(window).width() >= 1199 )  ) {

            if( mainSectionW < containerW ){
                $('.content-section.with-col').css({
                  marginLeft: '-' + _diff + 'px',
                  paddingLeft: _diff + 'px',
                  marginRight: (containerW - mainSectionW) / 2 + 15 + 'px',
                  paddingRight: (containerW - mainSectionW) / 2 + 15 + 'px'
                });
                $('.content-section.with-col').find('.content-section.with-col').css({
                  marginLeft: '-' + _diff + 'px',
                  paddingLeft: _diff + 'px',
                  marginRight: '-' + _diff + 'px',
                  paddingRight: _diff + 'px'
                });
            }
        }
      });

    }

    function init_classic_menu(){


        // Navbar sticky

        $(".js-stick").sticky({
            topSpacing: 0
        });

        if (! $('.main-nav').hasClass('mobile-on') ) {
            $(".inner-nav.desktop-nav").height($(".main-nav").outerHeight());
        }
        height_line($(".inner-nav ul > li > a"), $(".nav-logo-wrap"));
        // height_line(mobile_nav, $(".nav-logo-wrap"));

        mobile_nav.imagesLoaded(function(){
            // mobile_nav.css({
            //     "width": $(".nav-logo-wrap").height() + "px"
            // });
        });

        if ( $('.main-nav.mn-centered') || $('.main-nav.mn-align-left') ){
            height_line($(".inner-nav ul > li > a"), $(".main-nav"));
            // height_line(mobile_nav, $(".main-nav"));

            mobile_nav.imagesLoaded(function(){
                // mobile_nav.css({
                //     "width": $(".main-nav").height() + "px"
                // });
            });
        };
        // Transpaner menu

        if ($(".main-nav").hasClass("transparent")){
           $(".main-nav").addClass("js-transparent");
        }

        $(window).scroll(function(){

                if ($(window).scrollTop() > 10 && ( $('.main-nav').hasClass('stick-fixed') || $('.main-nav').hasClass('js-stick') ) ) {
                    $(".js-transparent").removeClass("transparent").addClass('is-sticked');
                    $(".main-nav, .nav-logo-wrap .logo, .mobile-nav").addClass("small-height");
                    if ($('.sticky-wrapper').length) {
                        $('.sticky-wrapper').addClass('small-height');
                    };
                }
                else {
                    $(".js-transparent").addClass("transparent").removeClass('is-sticked');
                    $(".main-nav, .nav-logo-wrap .logo, .mobile-nav").removeClass("small-height");
                    if ($('.sticky-wrapper').length) {
                        $('.sticky-wrapper').removeClass('small-height');
                    };
                }

                if ($('.logo.small-height').height() > $('.main-nav.small-height').height() && $(window).scrollTop() > 10) {
                    $('.logo.small-height').height( $('.main-nav.small-height').height() )
                };

        });

        // Mobile menu toggle

        mobile_nav.click(function(){

            if (desktop_nav.hasClass("js-opened")) {
                desktop_nav.slideUp("slow", "easeOutExpo").removeClass("js-opened");
                $(this).removeClass("active");
            }
            else {
                desktop_nav.slideDown("slow", "easeOutQuart").addClass("js-opened");
                $(this).addClass("active");
            }

        });

        desktop_nav.find("a:not(.mn-has-sub)").click(function(){
            if (mobile_nav.hasClass("active")) {
                desktop_nav.slideUp("slow", "easeOutExpo").removeClass("js-opened");
                mobile_nav.removeClass("active");
            }
        });


        // Sub menu


        var mnHasSub = $(".mn-has-sub"),
            mnMultiCol = $('.mn-sub.mn-has-multi'),
            mnThisLi;

        if (mnMultiCol.length) {
            mnMultiCol.each(function() {
                var $this = $(this);
                if (($this.width() + $this.offset().left) >= $(window).width()) {
                    $this.addClass('drop-to-left')
                }
            });
        };

        $(".mobile-on .mn-has-sub").find(".fm-angle-icon").removeClass("fa-angle-right").addClass("fa-angle-down");

		$(".mn-has-sub:not(.mn-active-link)").click(function(){
			return activate_classic_menu_item(this);
		});

		$(".mn-has-sub.mn-active-link").find('i').click(function(){
			return activate_classic_menu_item(this);
		});

        mnThisLi = mnHasSub.parent("li");
        mnThisLi.hover(function(){

            if (!($(".main-nav").hasClass("mobile-on"))) {

                $(this).find(".mn-sub:first").stop(true, true).fadeIn("fast");
            }

        }, function(){

            if (!($(".main-nav").hasClass("mobile-on"))) {

                $(this).find(".mn-sub:first").stop(true, true).delay(100).fadeOut("fast");
            }

        });
    }
    $('.nav-logo-wrap').imagesLoaded(function(){
        init_classic_menu();
    });

	function activate_classic_menu_item(item) {

		var mnThisLi;

		if ($(".main-nav").hasClass("mobile-on")) {
			mnThisLi = $(item).closest("li");

			if (mnThisLi.hasClass("js-opened")) {
				mnThisLi.find(".mn-sub:first").slideUp(function(){
					mnThisLi.removeClass("js-opened");
					mnThisLi.find(".mn-has-sub").find(".mn-angle-icon").removeClass("fa-angle-up").addClass("fa-angle-down");
				});
			}
			else {
				$(item).find(".mn-angle-icon").removeClass("fa-angle-down").addClass("fa-angle-up");
				mnThisLi.addClass("js-opened");
				mnThisLi.find(".mn-sub:first").slideDown();
			}

			return false;
		}
		return false;
	}

    /* ---------------------------------------------
     Scroll navigation
     --------------------------------------------- */

    function init_scroll_navigate(){

        $(".local-scroll").localScroll({
            target: "body",
            duration: 1500,
            offset: 0,
            easing: "easeInOutExpo"
        });

        var sections = $(".content-section");
        var menu_links = $(".scroll-nav li a");

        $(window).scroll(function(){

			sections.filter(":in-viewport:first").each(function(){
				var active_section = $(this);
				var active_link = $('.scroll-nav li a[href="#' + active_section.attr("id") + '"]');
                menu_links.removeClass("active");
                active_link.addClass("active");
            });
        });

    }



    /* ---------------------------------------------
     Lightboxes
     --------------------------------------------- */

    function init_lightbox(){

		if (typeof $.fn.magnificPopup == 'function') {

			// Works Item Lightbox
			$(".work-lightbox-link").magnificPopup({
				gallery: {
					enabled: true
				},
				mainClass: "mfp-fade"
			});

			// Works Item Lightbox
			$(".lightbox-gallery-1").magnificPopup({
				gallery: {
					enabled: true
				}
			});

			// Other Custom Lightbox
			$(".lightbox-gallery-2").magnificPopup({
				gallery: {
					enabled: true
				}
			});
			$(".lightbox-gallery-3").off('click'); // removing prettyphoto
			$(".lightbox-gallery-3").magnificPopup({
				gallery: {
					enabled: true
				}
			});
			$(".lightbox").magnificPopup();

			$('.popup-video-box').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,

				fixedContentPos: false
			});


			$('.video-popup-modal').magnificPopup({
				type: 'inline',
				preloader: false,
//				focus: '#username',
//				modal: true
			});

			$(document).on('click', '.popup-modal-dismiss', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
			});
		}

    }



    /* -------------------------------------------
     Parallax
     --------------------------------------------- */

    function init_parallax(){

        // Parallax
        if (($(window).width() >= 1024) && (mobileTest == false)) {
            $(".parallax-1").parallax("50%", 0.1);
            $(".parallax-2").parallax("50%", 0.2);
            $(".parallax-3").parallax("50%", 0.3);
            $(".parallax-4").parallax("50%", 0.4);
            $(".parallax-5").parallax("50%", 0.5);
            $(".parallax-6").parallax("50%", 0.6);
            $(".parallax-7").parallax("50%", 0.7);
            $(".parallax-8").parallax("50%", 0.5);
            $(".parallax-9").parallax("50%", 0.5);
            $(".parallax-10").parallax("50%", 0.5);
            $(".parallax-11").parallax("50%", 0.05);
        }

    }



    /* ---------------------------------------------
     Shortcodes
     --------------------------------------------- */
    // Tabs minimal
    function init_shortcodes() {

        var tpl_tab_height;
        $(".tpl-minimal-tabs > li > a").click(function(){

            if (!($(this).parent("li").hasClass("active"))) {
                tpl_tab_height = $(".tpl-minimal-tabs-cont > .tab-pane").filter($(this).attr("href")).height();
                $(".tpl-minimal-tabs-cont").animate({
                    height: tpl_tab_height
                }, function(){
                    $(".tpl-minimal-tabs-cont").css("height", "auto");
                });

            }

        });


        // Accordion
        $('.accordion-wrapper').each(function() {

            var $this = $(this),
            $wrap = $this.find('.accordion');

            $wrap.each( function() {

				var $accordion  = $(this),
                $content    = $accordion.find('.accordion-content');

				if ($this.hasClass('toggle-wrapper')) {
					$accordion.on('click', '.accordion-title', function( e ) {
						e.preventDefault();

						console.dir($wrap.find('.accordion-title').attr('class'));

						if ($(this).hasClass('active')) {
							$(this).removeClass('active');
							$(this).closest('.accordion').find('.accordion-content').stop().slideUp('easeInExpo');
						} else {
							$(this).addClass('active');

							$(this).closest('.accordion').find('.accordion-content').stop().slideDown('easeOutExpo');
						}
					});
				} else {
					 $accordion.on('click', '.accordion-title:not(.selected)', function( e ) {
						e.preventDefault();

						$wrap.find('.accordion-title').removeClass('active');
						$(this).addClass('active');

						$this.find('.accordion-content:visible').stop().slideUp('easeInExpo');
						$content.stop().slideDown('easeOutExpo');

					});
				}
            });
        });

		// FAQ
        var allPanels = $(".faq-wrapper .accordion > div.dd").hide();
        allPanels.first().slideDown("easeOutExpo");
        $(".faq-wrapper .accordion > div.dt > a").first().addClass("active");

        $(".faq-wrapper .accordion > div.dt > a").click(function(){

            var current = $(this).parent().next("div.dd");
            $(".accordion > div.dt > a").removeClass("active");
            $(this).addClass("active");
            allPanels.not(current).slideUp("easeInExpo");
            $(this).parent().next().slideDown("easeOutExpo");

            return false;

        });

        // Toggle
        $('.toggle').each(function() {

            var $this     = $(this),
            $content  = $this.find('.toggle-content');

            $this.on('click', '.toggle-title', function( e ) {
                e.preventDefault();
                $content.slideToggle('easeInOutExpo');
                $(this).toggleClass('active');
            });
        });

        // Responsive video
		if (typeof $.fn.fitVids == 'function') {
			$(".video, .resp-media, .blog-media").fitVids();
			$(".work-full-media").fitVids();
		}

    }



    /* ---------------------------------------------
     Tooltips (bootstrap plugin activated)
     --------------------------------------------- */

    function init_tooltips(){

        $(".tooltip-bot, .tooltip-bot a, .nav-social-links a").tooltip({
            placement: "bottom"
        });

        $(".tooltip-top, .tooltip-top a").tooltip({
            placement: "top"
        });

    }



    /* ---------------------------------------------
     Some facts section
     --------------------------------------------- */

     function init_counters(){

		if (typeof $.fn.appear == 'function') {
			$(".count-number").appear(function(){
				var count = $(this);
				count.countTo({
					from: 0,
					to: count.html(),
					speed: 1300,
					refreshInterval: 60,
				});

			});
		}
    }




    /* ---------------------------------------------
     Team
     --------------------------------------------- */

    function init_team(){

        // Hover
        $(".team-item").click(function(){
            if ($("html").hasClass("mobile")) {
                $(this).toggleClass("js-active");
            }
        });

    }

	/* ---------------------------------------------
     Comment form validation
     --------------------------------------------- */
	function init_comment_form_validation() {

		if ($('#comment-form').length > 0) {
			$('#comment-form').validator();
		}
	}


	/* ---------------------------------------------
     Fullscreen menu
     --------------------------------------------- */

    var fm_menu_wrap = $("#fullscreen-menu");
    var fm_menu_button = $(".fm-button");

    function init_fullscreen_menu(){

        fm_menu_button.click(function(){

            if ($(this).hasClass("animation-process")){
                return false;
            }
            else{
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active").css("z-index", "2001").addClass("animation-process");;

                    fm_menu_wrap.find(".fm-wrapper-sub").fadeOut("fast", function(){
                        fm_menu_wrap.fadeOut(function(){
                            fm_menu_wrap.find(".fm-wrapper-sub").removeClass("js-active").show();
                            fm_menu_button.css("z-index", "1030").removeClass("animation-process");

                        });
                    });

                    if ($(".owl-carousel").lenth) {
                        $(".owl-carousel").data("owlCarousel").play();
                    }

                }
                else {
                    if ($(".owl-carousel").lenth) {
                        $(".owl-carousel").data("owlCarousel").stop();
                    }
                    $(this).addClass("active").css("z-index", "2001").addClass("animation-process");

                    fm_menu_wrap.fadeIn(function(){
                        fm_menu_wrap.find(".fm-wrapper-sub").addClass("js-active");
                        fm_menu_button.removeClass("animation-process");
                    });
                }

                return false;
            }

        });

        $("#fullscreen-menu").find("a:not(.fm-has-sub)").click(function(){

            if (fm_menu_button.hasClass("animation-process")){
                return false;
            }
            else {
                fm_menu_button.removeClass("active").css("z-index", "2001").addClass("animation-process");;

                fm_menu_wrap.find(".fm-wrapper-sub").fadeOut("fast", function(){
                    fm_menu_wrap.fadeOut(function(){
                        fm_menu_wrap.find(".fm-wrapper-sub").removeClass("js-active").show();
                        fm_menu_button.css("z-index", "1030").removeClass("animation-process");

                    });
                });

                if ($(".owl-carousel").lenth) {
                    $(".owl-carousel").data("owlCarousel").play();
                }
            }
        });

        // Sub menu
        $(".fm-has-sub:not(.fm-active-link)").click(function(){
			return activate_fullscreen_menu_item(this);
		});

		$(".fm-has-sub.fm-active-link").find('i').click(function(){
			return activate_fullscreen_menu_item(this);
		});
    }

	function activate_fullscreen_menu_item(item) {

		var fmThisLi = $(item).closest("li");
		if (fmThisLi.hasClass("js-opened")) {
			fmThisLi.find(".fm-sub:first").slideUp(function(){
				fmThisLi.removeClass("js-opened");
				fmThisLi.find(".fm-has-sub").find(".mn-angle-icon").removeClass("fa-angle-up").addClass("fa-angle-down");
			});
		}
		else {
			$(item).find(".mn-angle-icon").removeClass("fa-angle-down").addClass("fa-angle-up");
			fmThisLi.addClass("js-opened");
			fmThisLi.find(".fm-sub:first").slideDown();
		}

		return false;
	}

	/* ---------------------------------------------
     Side panel
   --------------------------------------------- */

    var side_panel = $(".side-panel");
    var sp_button = $(".sp-button");
    var sp_close_button = $(".sp-close-button");
    var sp_overlay = $(".sp-overlay");

    function sp_panel_close(){
        side_panel.animate({
            opacity: 0,
            left: -270
        }, 500, "easeOutExpo");
        sp_overlay.fadeOut();


        if ($(".owl-carousel").lenth) {
            $(".owl-carousel").data("owlCarousel").play();
        }
    }

    function init_side_panel(){
        (function($){
            "use strict";

            sp_button.click(function(){

                side_panel.animate({
                    opacity: 1,
                    left: 0
                }, 500, "easeOutExpo");

                setTimeout(function(){
                    sp_overlay.fadeIn();
                }, 100);

                if ($(".owl-carousel").lenth) {
                    $(".owl-carousel").data("owlCarousel").stop();
                }

                return false;

            });

            sp_close_button.click(function(){
                sp_panel_close();
                return false;
            });
            sp_overlay.click(function(){
                sp_panel_close();
                return false;
            });

            $("#side-panel-menu").find("a:not(.sp-has-sub)").click(function(){
                if (!($(window).width() >= 1199)) {
                    sp_panel_close();
                }
            });


            // Sub menu
			$(".sp-has-sub:not(.sp-active-link)").click(function(){
				return activate_side_menu_item(this);
			});

			$(".sp-has-sub.sp-active-link").find('i').click(function(){
				return activate_side_menu_item(this);
			});

        })(jQuery);
    }

	function activate_side_menu_item(item) {

		var spThisLi = $(item).closest("li");

		if (spThisLi.hasClass("js-opened")) {
			spThisLi.find(".sp-sub:first").slideUp(function(){
				spThisLi.removeClass("js-opened");
				spThisLi.find(".sp-has-sub").find(".sp-angle-icon").removeClass("fa-angle-up").addClass("fa-angle-down");
			});
		}
		else {
			$(item).find(".sp-angle-icon").removeClass("fa-angle-down").addClass("fa-angle-up");
			spThisLi.addClass("js-opened");
			spThisLi.find(".sp-sub:first").slideDown();
		}

		return false;
	}

    function init_side_panel_resize(){
        (function($){
            "use strict";

            if ( ! $(".side-panel").length  ) {
                return
            }
            if ($(window).width() >= 1199){
               side_panel.css({
                    opacity: 1,
                    left: 0
               });
               $(".side-panel-is-left").css("margin-left", "270px");
               sp_button.css("display", "none");
               sp_close_button.css("display", "none");
            } else {
                side_panel.css({
                    opacity: 0,
                    left: -270
                });
                $(".side-panel-is-left").css("margin-left", "0");
                sp_button.css("display", "block");
                sp_close_button.css("display", "block");
            }

        })(jQuery);
    }
})(jQuery); // End of use strict


/* ---------------------------------------------
     Sliders
   --------------------------------------------- */
function initPageSliders(){
    (function($){
        "use strict";

		function syncPosition(el){
          var current = this.currentItem;
          $(".fullwidth-slideshow-pager").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
          if ($(".fullwidth-slideshow-pager").data("owlCarousel") !== undefined) {
              center(current)
          }
      }

	function center(number){
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for (var i in sync2visible) {
			if (num === sync2visible[i]) {
				var found = true;
			}
		}
		if (found === false) {
			if (num > sync2visible[sync2visible.length - 1]) {
				sync2.trigger("owl.goTo", num - sync2visible.length + 2)
			}
			else {
				if (num - 1 === -1) {
					num = 0;
				}
				sync2.trigger("owl.goTo", num);
			}
		}
		else
			if (num === sync2visible[sync2visible.length - 1]) {
				sync2.trigger("owl.goTo", sync2visible[1])
			}
			else
				if (num === sync2visible[0]) {
					sync2.trigger("owl.goTo", num - 1)
				}
	}

		if (typeof $.fn.owlCarousel == 'function') {

			// Fullwidth slider
			var _full_width_slider_selc     = $(".fullwidth-slider");

			if ( _full_width_slider_selc.length ) {

				_full_width_slider_selc.each(function() {

					var $this = $(this),
						_full_width_slider_speed = (typeof $this.attr('data-speed') !== typeof undefined || $this.attr('data-speed') !== null ) ? parseInt($this.attr('data-speed'), 10) : 3500,
						_full_width_slider_autoplay = ($this.attr('data-autoplay') == 'true') ? true : false;

					$this.owlCarousel({
						slideSpeed: _full_width_slider_speed,
						singleItem: true,
						autoHeight: true,
						navigation: true,
						autoPlay: _full_width_slider_autoplay,
						navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
					});

				});

			}

			// Fullwidth slider Fade
			var _full_width_fade_selc = $(".fullwidth-slider-fade");

			if ( _full_width_fade_selc.length ) {

				_full_width_fade_selc.each(function() {
					var $this = $(this),
						_full_width_fade_speed    = (typeof $this.attr('data-speed') !== typeof undefined || $this.attr('data-speed') !== null ) ? parseInt($this.attr('data-speed'), 10):3500,
						_full_width_fade_autoplay = ($this.attr('data-autoplay') == 'true') ? true : false;

					$this.owlCarousel({
						transitionStyle: "fadeUp",
						slideSpeed: _full_width_fade_speed,
						singleItem: true,
						autoHeight: true,
						navigation: true,
						autoPlay:_full_width_fade_autoplay,
						navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
					});

				});

			}

      // Fullwidth gallery
      var _full_width_gallery_selc = $(".fullwidth-gallery");

			if ( _full_width_gallery_selc.length ) {

				_full_width_gallery_selc.each(function() {

					var $this = $(this),
						_full_width_gallery_speed    = (typeof $this.attr('data-speed') !== typeof undefined || $this.attr('data-speed') !== null ) ? parseInt($this.attr('data-speed'), 10):7000,
						_full_width_gallery_autoplay = ($this.attr('data-autoplay') == 'true') ? true : 5000;

					$(".fullwidth-gallery").owlCarousel({
						transitionStyle: "fade",
						autoPlay: _full_width_gallery_autoplay,
						slideSpeed: _full_width_gallery_speed,
						singleItem: true,
						autoHeight: true,
						navigation: false,
						pagination: false
					});

				})

			}


			// Item carousel
			$(".item-carousel").owlCarousel({
				autoPlay: 2500,
				//stopOnHover: true,
				items: 3,
				itemsDesktop: [1199, 3],
				itemsTabletSmall: [768, 3],
				itemsMobile: [480, 1],
				navigation: false,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

			// Item carousel
			$(".small-item-carousel").owlCarousel({
				autoPlay: 2500,
				stopOnHover: true,
				items: 6,
				itemsDesktop: [1199, 4],
				itemsTabletSmall: [768, 3],
				itemsMobile: [480, 2],
				pagination: false,
				navigation: false,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

         // Item carousel
         $(".small-item-carousel-items-4").owlCarousel({
             autoPlay: 2500,
             stopOnHover: true,
             items: 4,
             itemsDesktop: [1199, 4],
             itemsTabletSmall: [768, 3],
             itemsMobile: [480, 2],
             pagination: false,
             navigation: false
         });

			// Single carousel
			$(".single-carousel").owlCarousel({
				//transitionStyle: "backSlide",
				singleItem: true,
				autoHeight: true,
				navigation: true,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

			// Content Slider
			$(".content-slider").owlCarousel({
				slideSpeed: 350,
				singleItem: true,
				autoHeight: true,
				navigation: true,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

			// Photo slider
			$(".photo-slider").owlCarousel({
				//transitionStyle: "backSlide",
				slideSpeed: 350,
				items: 4,
				itemsDesktop: [1199, 4],
				itemsTabletSmall: [768, 2],
				itemsMobile: [480, 1],
				autoHeight: true,
				navigation: true,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

			// Fullwidth slider
			var _work_full_slider_selc = $(".work-full-slider");

			if ( _work_full_slider_selc.length ) {

				_work_full_slider_selc.each(function() {

					var $this = $(this),
						_work_full_slider_speed    = (typeof $this.attr('data-speed') !== typeof undefined || $this.attr('data-speed') !== null ) ? parseInt($this.attr('data-speed'), 10):3500,
						_work_full_slider_autoplay = ($this.attr('data-autoplay') == 'true') ? true : false;

					// Work slider
					$(".work-full-slider").owlCarousel({
						slideSpeed : _work_full_slider_speed,
						autoPlay:_work_full_slider_autoplay,
						singleItem: true,
						autoHeight: true,
						navigation: true,
						navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
					});

				})

			}

			// Blog posts carousel
			$(".blog-posts-carousel").owlCarousel({
				autoPlay: 5000,
				stopOnHover: true,
				items: 3,
				itemsDesktop: [1199, 3],
				itemsTabletSmall: [768, 2],
				itemsMobile: [480, 1],
				pagination: false,
				navigation: true,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

			// Blog posts carousel alt
			$(".blog-posts-carousel-alt").owlCarousel({
				autoPlay: 3500,
				stopOnHover: true,
				slideSpeed: 350,
				singleItem: true,
				autoHeight: true,
				pagination: false,
				navigation: true,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			});

      // Image carousel
      $(".image-carousel").owlCarousel({
          autoPlay: 5000,
          stopOnHover: true,
          items: 4,
          itemsDesktop: [1199, 3],
          itemsTabletSmall: [768, 2],
          itemsMobile: [480, 1],
          navigation: true,
          navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
      });

      // Image carousel
      $(".image-carousel-items-5").owlCarousel({
          autoPlay: 5000,
          stopOnHover: true,
          items: 5,
          itemsDesktop: [1199, 4],
          itemsTabletSmall: [768, 2],
          itemsMobile: [480, 1],
          pagination: false,
          navigation: true,
          navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
      });

      // Fullwidth slideshow

        var sync1 = $(".fullwidth-slideshow");
        var sync2 = $(".fullwidth-slideshow-pager");

      $(".fullwidth-slideshow").owlCarousel({
          autoPlay: 5000,
          stopOnHover: true,
          transitionStyle: "fade",
          slideSpeed: 350,
          singleItem: true,
          autoHeight: true,
          pagination: false,
          navigation: true,
          navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
          afterAction : syncPosition,
          responsiveRefreshRate : 200
      });
      $(".fullwidth-slideshow-pager").owlCarousel({
          autoPlay: 5000,
          stopOnHover: true,
          items: 8,
          itemsDesktop: [1199,8],
          itemsDesktopSmall: [979,7],
          itemsTablet: [768,6],
          itemsMobile: [480,4],
          autoHeight: true,
          pagination: false,
          navigation: false,
          responsiveRefreshRate : 100,
          afterInit : function(el){
            el.find(".owl-item").eq(0).addClass("synced");
          }
      });

      $(".fullwidth-slideshow-pager").on("click", ".owl-item", function(e){
          e.preventDefault();
          var number = $(this).data("owlItem");
          sync1.trigger("owl.goTo", number);
      });

	  var owl = $(".fullwidth-slideshow").data("owlCarousel");

      $(document.documentElement).keyup(function(event){
          // handle cursor keys
          if (event.keyCode == 37) {
              owl.prev();
          }
          else
              if (event.keyCode == 39) {
                  owl.next();
              }
      });

			if ($(".owl-carousel").length) {
				var owl = $(".owl-carousel").data('owlCarousel');
				owl.reinit();
			}
		}

    })(jQuery);
};



/* ---------------------------------------------
 Portfolio section
 --------------------------------------------- */

// Projects filtering
var fselector = 0;
var work_grid = jQuery("#work-grid, #isotope");

function initWorkFilter(){

	if (typeof jQuery.fn.isotope == 'function') {

		"use strict";
		var isotope_mode;
		if (work_grid.hasClass("masonry")){
			isotope_mode = "masonry";
		} else{
			isotope_mode = "packery"
		}

		work_grid.imagesLoaded(function(){
			work_grid.isotope({
				itemSelector: '.mix',
				layoutMode: isotope_mode,
			 	filter: fselector
			});
		});

		jQuery(".filter").click(function(){
			jQuery(".filter").removeClass("active");
			jQuery(this).addClass("active");
			fselector = jQuery(this).attr('data-filter');

			work_grid.isotope({
				filter: fselector
			});
			return false;
		});
		jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			work_grid.isotope('layout')
		})
	}
}


/* ---------------------------------------------
 Height 100%
 --------------------------------------------- */
function js_height_init(){
    (function($){
        $(".js-height-full").height($(window).height());
        $(".js-height-parent").each(function(){
            $(this).height($(this).parent().first().height());
        });
    })(jQuery);
}




/* ---------------------------------------------
 Gmap3 map
 --------------------------------------------- */

var gmMapDiv = jQuery(".map-canvas");

function init_map(){
    (function($){

        $('.map-section').click(function(){
            $(this).toggleClass("js-active");
            $(this).find(".mt-open").toggle();
            $(this).find(".mt-close").toggle();
        });

        gmMapDiv.each(function() {

            var _this = $(this);

    		if (typeof $.fn.gmap3 == 'function') {

    			if (_this.length) {

    				var gmCenterAddress = _this.attr("data-address");
    				var gmMarkerAddress = _this.attr("data-address");
    				var gmMarker        = _this.attr("data-marker");
    				var gmLatitude      = _this.attr("data-lat");
    				var gmLongitude     = _this.attr("data-long");
    				var gmZ             =  parseInt(_this.attr("data-zoom"));
                    var gmGreyscale     = _this.attr("data-greyscale");
                    var gmStyles        = ( gmGreyscale ==  'true') ? [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]:false;

    				_this.gmap3({
    					mapTypeId : google.maps.MapTypeId.ROADMAP,
    					mapTypeControl: false,
    					scrollwheel: false,
    					streetViewControl: false,
    					scaleControl: false,
    					address: gmCenterAddress,
    					center:[gmLatitude, gmLongitude],
    					zoom: gmZ,
    					})
    					.styledmaptype( "style1", gmStyles, {name: "Style 1"})
    					.marker([
	    					{position:[gmLatitude, gmLongitude]},
    						{ address: gmMarkerAddress, icon: gmMarker || get.siteurl + "/images/map-marker.png" }
    					]);
    			}
    		}
        });
    })(jQuery);
}

/* ---------------------------------------------
 WOW animations
 --------------------------------------------- */

function init_wow(){
    (function($){

        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 90,
            mobile: false,
            live: true
        });

        if ($("body").hasClass("appear-animate")){
           wow.init();
        }

    })(jQuery);
}


/* ---------------------------------------------
 Masonry
 --------------------------------------------- */

function init_masonry(){
    (function($){

		if (typeof $.fn.masonry == 'function') {

			$(".masonry").imagesLoaded(function(){
				$(".masonry").masonry();
			});

		}

    })(jQuery);
}

/* ---------------------------------------------
 Video BG
 --------------------------------------------- */
function init_video_bg() {
    (function($){

        if (typeof $.fn.vide == 'function') {


            $('.bg-video-wrapper').each(function() {

                $this = $(this);

                $this.vide({
                    mp4: $this.data('mp4'),
                    webm: $this.data('webm'),
                    ogv: $this.data('ogv'),
                    poster: $this.data('poster')
                    }, {
                        volume: 0,
                        playbackRate: 1,
                        muted: $this.data('muted'),
                        loop: true,
                        autoplay: $this.data('autoplay'),
                        position: '50% 50%', // Similar to the CSS `background-position` property.
                        posterType: $this.data('poster-type'), // Poster image type. "detect" — auto-detection; "none" — no poster; "jpg", "png", "gif",... - extensions.
                        resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
                });
            });
        }

    })(jQuery);
}

/* ---------------------------------------------
 Sticky Sidebar
 --------------------------------------------- */

function stickySidebar() {
    (function($){
        var $stickySidebar   = $(".sidebar-fixed").children('.sidebar-inner'),
            $window    = $(window),
            topPadding = 100,
            parentSection = $('.main-section.page-section'),
            parentSectionOffset = parentSection.offset(),
            parentSectionPadding = parseInt(parentSection.css('padding-top'));

        $stickySidebar.imagesLoaded(function(){
            var height = $stickySidebar.height(),
                offset     = $stickySidebar.offset(),
                footerHeight = parseInt($('.footer').last().outerHeight(true), 10),
                mainSectionPB = parseInt($('.main-section.page-section').css('padding-bottom'), 10),
                topSpace,
                bottomSpace;

            $stickySidebar.parent().css('height', '');
            $stickySidebar.parent().height(height);

            if ($('.sticky-wrapper').length) {
                topSpace = 85;
            } else {
                topSpace = 0;
            };

            if ($('.footer').length) {
                bottomSpace = footerHeight + mainSectionPB ;
            } else {
                bottomSpace = mainSectionPB ;
            };

            $stickySidebar.sticky({
                topSpacing: topSpace,
                bottomSpacing: bottomSpace
            });
        });
    })(jQuery);

}

/* ---------------------------------------------
 Split section
 --------------------------------------------- */

function split_height_init(){
    (function($){

        $(".ssh-table, .split-section-content").css("height", "auto");

        if ($(window).width() > 992) {
            $(".split-section").each(function(){
                var split_section_height = $(this).find(".split-section-content").innerHeight();
                $(this).find(".ssh-table").height(split_section_height);
            });
        }

    })(jQuery);
}

/* ---------------------------------------------
 match height
 --------------------------------------------- */

 function enableMatchHeight() {

    var mhEl = jQuery('.matchHeight-element');

    if ( ! mhEl.length || typeof jQuery.fn.matchHeight != 'function' ) {
        return
    };

    mhEl.imagesLoaded(function(){
        mhEl.matchHeight();
        jQuery.fn.matchHeight._afterUpdate = function(event, groups) {
            mhEl.addClass('matchHeight-applied');
        }
    });
 }
