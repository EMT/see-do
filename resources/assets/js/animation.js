$(document).ready(function(){

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

	var $body = $('body');

    // ======= Click Handlers =======

	var $eventListing = $('.event'),
		$eventInfoClose = $('.js-close-sidebar'),
		$filterBtn = $('.filter');

	$eventInfoClose.on('click', function(){
		closeSidebar();
	});

	$eventListing.on('click', function(e){
		e.preventDefault(); // Temp!
		if (!sidebarIsOpen()) {
			openSidebar();
		} else {
			closeSidebar();
		}
	});

	$filterBtn.on('click', function(e){
		e.preventDefault();
		//Move sidebar out of the way, the background from the sidebar clashes with the color background.
		if(sidebarIsOpen()) {
			closeSidebar();
			setTimeout(function(){
				showFilters(e);
			},(300 * globalAnimSpeed)); // This is based on the time it takes for the sidebar to slideout - could do with a callback instead or make the timing a global variable.
		} else {
			showFilters(e);
		}
	});

	$('.filter-overlay-nav').on('click', function(e){
		hideFilters();
	});

    // ======= Filters Animations =======

	var $filterBg = $('.filter-overlay-bg'),
		$filterNav = $('.filter-overlay-nav'),
		$filterList = $('.filter-overlay-nav ul li'),
		$navNum = $('.nav-num'),
		$navNumInner = $('.nav-num-inner'),
		$navOpenBracket = $('.nav-open-bracket'),
		$navCloseBracket = $('.nav-close-bracket'),
		diameterValue = (Math.sqrt( Math.pow($(window).height(), 2) + Math.pow($(window).width(), 2)));


	// Initial Setup

	$filterBg.css({'width': diameterValue, 'height': diameterValue});

	$(window).smartresize(function(){
		newDiameterValue = (Math.sqrt( Math.pow($(window).height(), 2) + Math.pow($(window).width(), 2)));
		if ( diameterValue < newDiameterValue) {
			diameterValue = newDiameterValue;
		}
		$filterBg.css({'width': diameterValue, 'height': diameterValue});
	});

	// Reveal Animation

	function showFilters(e) {
		// Figure out and apply the diameterValue information before hand, then just apply the position.x/position.y information on click (Might stop some of the lag at the start)
		// This also needs to be updated on resize.

		var	positionX = e.pageX - diameterValue / 2,
			positionY = e.pageY - diameterValue / 2,
			timing = 300;

		$filterBg.css({'left': positionX, 'top': positionY});

		$navNumInner.each(function(){
	      $(this).data('count', parseInt($(this).html(), 10));
	      $(this).html('000');
		});


		var revealFiltersAnim = [
			{ elements: $filterBg, properties: { translateZ: 0, scaleX: [2,0], scaleY: [2,0]}, options: {duration: 650, easing: [0.250, 0.460, 0.450, 0.940], complete: function () {
                {
                	$filterNav.addClass('active');
      			}
            }}},
			{ elements: $filterList, properties: 'custom.slideUpIn', options: {duration: 300, stagger: 40, drag: true}},
			{ elements: $filterNav, properties: {opacity: 1, display:'block'}, options: {sequenceQueue: false}},
			{ elements: $navOpenBracket, properties: { translateZ: 0, translateX: [0]}, options: {easing: [0.075, 0.82, 0.165, 1], duration: 200}},
			{ elements: $navCloseBracket, properties: { translateZ: 0, translateX: [0,-15]}, options: {easing: [0.075, 0.82, 0.165, 1], sequenceQueue: false, duration: 200}},
			{ elements: $navNumInner, properties: { opacity: 1}, options: {complete: function(){
				{
					$navNumInner.each(function(){
						count($(this));
					});
				}
			}}}
		]

		$.Velocity.RunSequence(revealFiltersAnim);
	}

	// Hide Animation

	function hideFilters(e) {
		var hideAndResetFiltersAnim = [
			{ elements: $filterList.get().reverse(), properties: 'custom.slideDownOut', options: {duration: 300, stagger: 40, drag: true}},
			{ elements: $filterBg, properties: {opacity:0, complete: function () {
				{
                	$filterNav.removeClass('active');
				}
			}}},
			{ elements: $filterBg, properties: {scaleX: [0,2], scaleY: [0,2], opacity: 1}, options: {duration: 0}},
			{ elements: $navOpenBracket, properties: { translateZ: 0, translateX: [15]}, options: {duration: 0}},
			{ elements: $navCloseBracket, properties: { translateZ: 0, translateX: [-15]}, options: {duration: 0}},
			{ elements: $navNumInner, properties: { opacity: 0}, options: {duration:0, complete: function(){
				{
					$navNumInner.each(function(){
						$(this).html($(this).data('count'));
					});
				}
			}}}
		]

		$.Velocity.RunSequence(hideAndResetFiltersAnim);
	}

	// ======= Sidebar Animations =======

	// Open Animation

	function openSidebar() {
		$body.addClass('sidebar-active');

		var timing = 300;

		var $eventInfoPane = $('.event-info'),
		    $leftAlignWrapper = $('.left-align-wrapper'),
			$eventInfoPaneChildren = $('.event-info').children();

		var openSidebarAnim = [
			{ elements: $leftAlignWrapper, properties: { width: "62.5%" }, options: {easing: [0.075, 0.82, 0.165, 1]}},
			{ elements: $eventInfoPane, properties: { translateX: ["0%","100%"] }, options: { sequenceQueue: false, easing: [0.075, 0.82, 0.165, 1]}},
			{ elements: $eventInfoPaneChildren, properties: 'custom.slideUpIn', options: { duration: timing, stagger: 120, drag: true}},
		];

		$.Velocity.RunSequence(openSidebarAnim);
	}

	// Close Animation

	function closeSidebar() {
		$body.removeClass('sidebar-active');

		var timing = 0;

		var $eventInfoPane = $('.event-info'),
		    $leftAlignWrapper = $('.left-align-wrapper'),
			$eventInfoPaneChildren = $('.event-info > *');

		var closeSidebarAnim = [
			{ elements: $leftAlignWrapper, properties: { width: "90%" }, options: {easing: [0.075, 0.82, 0.165, 1]} },
			{ elements: $eventInfoPane, properties: { translateX: ["100%"] }, options: { sequenceQueue: false, easing: [0.075, 0.82, 0.165, 1] } },
			{ elements: $eventInfoPaneChildren, properties: 'fadeOut', options: { duration: timing, display: false}},

		];

		$.Velocity.RunSequence(closeSidebarAnim);
	}

	// Helper function, lets us know if the sidebar is open.

	function sidebarIsOpen() {
		if ( $body.hasClass('sidebar-active') ) {
			return true;
		} else {
			return false;
		}
	}


	// ======= Misc Functions =======


 	// Register fadeIn/fadeOut Transition helper function by: Tommie Hnasen - http://codepen.io/tommiehansen/

	if(typeof String.prototype.endsWith != 'function') { String.prototype.endsWith = function (str) { return this.slice(-str.length) == str; }; }

	function registerTransition(name,fx){
	  var ease, dur;
	  if(name.endsWith('In')) {
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

	// Visual Count function by: Adam Merrifield - http://stackoverflow.com/a/14144475

	function count($this){
        var current = parseInt($this.html(), 10);
        $this.html('00' + (++current));
        if(current !== $this.data('count')){
            setTimeout(function(){count($this)}, 100);
        }
    }

});

