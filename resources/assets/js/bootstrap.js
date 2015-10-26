$(document).ready(function(){

	// === Dev ===
	// Reducing markup a tad.
	var list = $('.month-range').first().find('ul').clone();
	list.appendTo($('.month-range.hidden'))
	// ===========

	$('.month--title').on('click', function(){
		var parent = $(this).parent();
		parent.addClass('active');
		parent.removeClass('hidden');

		parent.siblings().each(function(){
			var self = $(this);
			self.addClass('hidden');
			self.removeClass('active');
		});
	});

	// === Velocity.js animation Testing ===

	registerTransition('custom.slideUpIn', { translateY: [0,10] });



	var $eventListing = $('.event'),
		$eventInfoClose = $('.js-close-sidebar');

	$eventInfoClose.on('click', function(){
		closeSidebar();
	});

	$eventListing.on('click', function(){
		if (!sidebarIsOpen()) {
			openSidebar();
		} else {
			closeSidebar();
		}
	});




	function openSidebar() {
		$('body').addClass('sidebar-active');

		var timing = 300;

		var $eventInfoPane = $('.event-info'),
		    $leftAlignWrapper = $('.left-align-wrapper'),
			$eventInfoPaneChildren = $('.event-info > *');

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

	var aniDuration = 550,
    aniEase = [0.075, 0.82, 0.165, 1];
    aniEaseOut = [0.6, 0.04, 0.98, 0.335];

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