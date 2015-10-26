$(document).ready(function(){

	// Tweek this to slowdown/speed up all of the animation on the page.
	$.Velocity.mock = 1;


	var aniDuration = 550,
    	aniEase = [0.075, 0.82, 0.165, 1];
    	aniEaseOut = [0.6, 0.04, 0.98, 0.335];

	registerTransition('custom.slideUpIn', { translateY: [0,10] });

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

		// Move sidebar out of the way, the background from the sidebar clashes with the color background.
		// if(sidebarIsOpen) {
		// 	closeSidebar();
		// 	setTimeout(function(){
		// 		showFilters(e);
		// 	},300); // This is based on the time it takes for the sidebar to slideout - could do with a callback instead or make the timing a global variable.
		// } else {
			showFilters(e);
		// }



	});



	function showFilters(e) {
		// Figure out and apply the diameterValue information before hand, then just apply the position.x/position.y information on click (Might stop some of the lag at the start)

		var diameterValue = (Math.sqrt( Math.pow($(window).height(), 2) + Math.pow($(window).width(), 2))),
			positionX = e.pageX - diameterValue / 2,
			positionY = e.pageY - diameterValue / 2,
			timing = 300;

		var $filterBg = $('.filter-overlay-bg'),
			$filterList = $('.filter-overlay-nav ul').children();

			$filterBg.css({'left': positionX, 'top': positionY, 'width': diameterValue, 'height': diameterValue});

		var mySequence = [
			{ elements: $filterBg, properties: { translateZ: 0, scaleX: [2,0], scaleY: [2,0]}, options: {duration: 650, easing: [0.250, 0.460, 0.450, 0.940]}},
			{ elements: $filterList, properties: 'custom.slideUpIn', options: {duration: timing, stagger: 120, drag: true}},
			{ elements: $('.filter-overlay-nav'), properties: {opacity: 1, display:'block'}, options: {sequenceQueue: false}}
		]

		$.Velocity.RunSequence(mySequence);
	}



	function openSidebar() {
		$('body').addClass('sidebar-active');

		var timing = 300;

		var $eventInfoPane = $('.event-info'),
		    $leftAlignWrapper = $('.left-align-wrapper'),
			$eventInfoPaneChildren = $('.event-info').children();

		var mySequence = [
			{ elements: $leftAlignWrapper, properties: { width: "62.5%" }, options: {easing: [0.075, 0.82, 0.165, 1]}},
			{ elements: $eventInfoPane, properties: { translateX: ["0%","100%"] }, options: { sequenceQueue: false, easing: [0.075, 0.82, 0.165, 1]} },
			{ elements: $eventInfoPaneChildren, properties: 'custom.slideUpIn', options: { duration: timing, stagger: 120, drag: true}},
		];

		$.Velocity.RunSequence(mySequence);
	}

	function closeSidebar() {
		$('body').removeClass('sidebar-active');

		var timing = 0;

		var $eventInfoPane = $('.event-info'),
		    $leftAlignWrapper = $('.left-align-wrapper'),
			$eventInfoPaneChildren = $('.event-info > *');

		var mySequence = [
			{ elements: $leftAlignWrapper, properties: { width: "90%" }, options: {easing: [0.075, 0.82, 0.165, 1]} },
			{ elements: $eventInfoPane, properties: { translateX: ["100%"] }, options: { sequenceQueue: false, easing: [0.075, 0.82, 0.165, 1] } },
			{ elements: $eventInfoPaneChildren, properties: 'fadeOut', options: { duration: timing, display: false}},

		];

		$.Velocity.RunSequence(mySequence);
	}

	function sidebarIsOpen() {
		var $body = $('body');
		if ( $body.hasClass('sidebar-active') ) {
			return true;
		} else {
			return false;
		}
	}


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

});