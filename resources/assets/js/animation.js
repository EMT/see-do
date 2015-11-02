
	// ======= Global Settings and Variables =======

	// Tweek this to slowdown/speed up all of the animation on the page.
	// Could probably bump this down to 0.9/0.85 on release to make it feel a bit more snappy.
	var globalAnimSpeed = 1;
	$.Velocity.mock = globalAnimSpeed;

	registerTransition('custom.slideUpIn', { translateY: [0,10] });
	registerTransition('custom.slideDownOut', { translateY: [10,0] });

	// Register some default timings/easing.
	var aniDuration = 550,
    	aniEase = [0.075, 0.82, 0.165, 1],
    	aniEaseOut = [0.6, 0.04, 0.98, 0.335];

    // ======= Filters Animations =======


	$(window).smartresize(function(){
		Filters.resizeBackground();
	});


    var Filters = (function () {
		var $filterBg = $('.filter-overlay-bg'),
			$filterNav = $('.filter-overlay-nav'),
			$filterList = $filterNav.find('li'),
			$navNum = $('.nav-num'),
			$navNumInner = $navNum.children('.nav-num-inner'),
			$navOpenBracket = $navNum.children('.nav-open-bracket'),
			$navCloseBracket = $navNum.children('.nav-close-bracket'),
			diameterValue = (Math.sqrt( Math.pow($(window).height(), 2) + Math.pow($(window).width(), 2)));

		var init = function() {
			$filterBg.css({'width': diameterValue, 'height': diameterValue});
		}

		var resizeBackground = function() {
			newDiameterValue = (Math.sqrt( Math.pow($(window).height(), 2) + Math.pow($(window).width(), 2)));
			if ( diameterValue < newDiameterValue) {
				diameterValue = newDiameterValue;
			}
			$filterBg.css({'width': diameterValue, 'height': diameterValue});
		}

		var animShow = function(e) {

			var	positionX = e.pageX - diameterValue / 2,
				positionY = e.pageY - diameterValue / 2,
				timing = 300;

			$filterBg.css({'left': positionX, 'top': positionY});

			$navNumInner.each(function(){
		      $(this).data('count', parseInt($(this).html(), 10));
		      $(this).html('000');
			});

			var revealFiltersAnim = [
				{
					elements: $filterBg,
					properties: {
						translateZ: 0,
						scaleX: [2,0],
						scaleY: [2,0]
					},
					options: {
						duration: 650,
						easing: [0.250, 0.460, 0.450, 0.940],
						complete: function () {
	                	$filterNav.addClass('active');
	            		}
	            	}
	            },
				{
					elements: $filterList,
					properties: 'custom.slideUpIn',
					options: {
						duration: 300,
						stagger: 40,
						drag: true
					}
				},
				{
					elements: $filterNav,
					properties: {
						opacity: 1,
						display:'block'
					},
					options: {
						sequenceQueue: false
					}
				},
				{
					elements: $navOpenBracket,
					properties: {
						translateZ: 0,
						translateX: [0]
					},
					options: {
						easing: [0.075, 0.82, 0.165, 1],
						duration: 200
					}
				},
				{
					elements: $navCloseBracket,
					properties: {
						translateZ: 0,
						translateX: [0,-15]
					},
					options: {
						easing: [0.075, 0.82, 0.165, 1],
						sequenceQueue: false,
						duration: 200
					}
				},
				{
					elements: $navNumInner,
					properties: {
						opacity: 1
					},
					options: {
						complete: function(){
							$navNumInner.each(function(){
								zeroPadCount($(this));
							});
						}
					}
				}
			]

			$.Velocity.RunSequence(revealFiltersAnim);
		}

		var animHide = function(e) {
			var hideAndResetFiltersAnim = [
				{
					elements: $filterList.get().reverse(),
					properties: 'custom.slideDownOut',
					options: {
						duration: 300,
						stagger: 40,
						drag: true
					}
				},
				{
					elements: $filterBg,
					properties: {
						opacity:0,
						complete: function () {
	                		$filterNav.removeClass('active');
						}
					}
				},
				{
					elements: $filterBg,
					properties: {
						scaleX: [0,2],
						scaleY: [0,2],
						opacity: 1
					},
					options: {
						duration: 0
					}
				},
				{
					elements: $navOpenBracket,
					properties: {
						translateZ: 0,
						translateX: [15]
					},
					options: {
						duration: 0
					}
				},
				{
					elements: $navCloseBracket,
					properties: {
						translateZ: 0,
						translateX: [-15]
					},
					options: {
						duration: 0
					}
				},
				{
					elements: $navNumInner,
					properties: {
						opacity: 0
					},
					options: {
						duration:0,
						complete: function(){
							$navNumInner.each(function(){
								$(this).html($(this).data('count'));
							});
						}
					}
				}
			]

			$.Velocity.RunSequence(hideAndResetFiltersAnim);
		}

		// Visual Count function modified from original by: Adam Merrifield - http://stackoverflow.com/a/14144475

		var zeroPadCount = function($this){
	        var current = parseInt($this.html(), 10);
	        if ($this.data('count') !== 0) {
		        $this.html(zeroPad(++current,3));
		        if(current !== $this.data('count')){
		            setTimeout(function(){zeroPadCount($this)}, 100);
		        }
		    }
	    }

	    var zeroPad = function(num,count){
			var numZeropad = num.toString();
			while(numZeropad.length < count) {
				numZeropad = "0" + numZeropad;
			}
			return numZeropad;
		}

		return {
			init: init,
			resizeBackground: resizeBackground,
			animShow: animShow,
			animHide: animHide
		}

    })();


	// ======= Sidebar Animations =======

	var Sidebar = (function() {
		var $infoPane = $('.event-info'),
			$leftAlignWrapper = $('.left-align-wrapper'),
			$infoPaneChildren = $infoPane.children(),
			timing = 300;

		var activeWrapperWidth,
			inactiveWrapperWidth;

		console.log($(window).width());

		if ($(window).width() <= 900) {
			activeWrapperWidth = "45%";
			inactiveWrapperWidth = "100%";
		} else {
			activeWrapperWidth = "62.5%";
			inactiveWrapperWidth = "90%";
		}

		var animOpen = function() {

			var openSidebarAnim = [
				{
					elements: $infoPaneChildren,
					properties: {
						opacity: 0
					},
					options: {
						duration: 0
					}
				},
				{
					elements: $leftAlignWrapper,
					properties: {
						width: activeWrapperWidth
					},
					options: {
						easing: [0.075, 0.82, 0.165, 1]
					}
				},
				{
					elements: $infoPane,
					properties: {
						translateX: ["0%","100%"]
					},
					options: {
						sequenceQueue: false,
						easing: [0.075, 0.82, 0.165, 1]
					}
				},
				{
					elements: $infoPaneChildren,
					properties: 'custom.slideUpIn',
					options: {
						duration: timing,
						stagger: 120,
						drag: true,
						complete: function(){
							$infoPane.addClass('event-info--open');
							$leftAlignWrapper.addClass('event-info--open');
						}
					}
				}
			];

			$.Velocity.RunSequence(openSidebarAnim);
		}

		var animClose = function($openItem) {

			// If width <= BREAKPOINT then run different animation to fully reset.
			var closeSidebarAnim = [
				{
					elements: $leftAlignWrapper,
					properties: {
						width: inactiveWrapperWidth
					},
					options: {
						easing: [0.075, 0.82, 0.165, 1]
					}
				},
				{
					elements: $infoPane,
					properties: {
						translateX: ["100%"]
					},
					options: {
						sequenceQueue: false,
						easing: [0.075, 0.82, 0.165, 1],
						complete: function() {
							$infoPane.removeClass('event-info--open').scrollTop(0);
							$('.event--active').removeClass('event--active');

							if ($openItem) {
								$openItem.addClass('event--active');
							}
						}
					}
				}
			];

			$.Velocity.RunSequence(closeSidebarAnim);
		}

		var isOpen = function() {
			if ( $infoPane.hasClass('event-info--open') ) {
				return true;
			} else {
				return false;
			}
		}

		return {
	        animOpen: animOpen,
	        animClose: animClose,
	        isOpen: isOpen
	    };
	})();



	// ======= Misc Functions =======


 	// Register fadeIn/fadeOut Transition helper function by: Tommie Hnasen - http://codepen.io/tommiehansen/


	function registerTransition(name,fx){
	  var ease, dur;
	  // Fix this so it only checks the end of the string.
	  if(name.indexOf("In") >= 0) {
	    ease = aniEase;
	    dur = aniDuration;
	    fx.opacity = [1,0]; // forcefeed opacity
	  }
	  else {
	    dur = aniDuration/1.66;
	    ease = aniEaseOut; // aniEase/Out set elsewhere
	    fx.opacity = 0;
	  }

	  $.Velocity.RegisterUI(name, {
	    defaultDuration: dur,
	    calls: [[ fx, aniDuration/1000, { easing: ease } ]]
	  });

	}

