$(function() {
	FastClick.attach(document.body);

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


	var $eventListing = $('.event'),
		$eventInfoClose = $('.js-close-sidebar'),
		$filterBtn = $('.filter');

	$eventInfoClose.on('click touch', function(){
		closeSidebar();
	});

	$eventListing.on('click touch', function(e){
		e.preventDefault(); // Temp!

		var eventUrl = $(this).children('a').attr('href');
		var eventJsonUrl = eventUrl + '.json';


		if (!sidebarIsOpen()) {
			openSidebar();
			setEventDetails(eventJsonUrl);
		} else {
			closeSidebar();
			setEventDetails(eventJsonUrl);
			openSidebar();
		}
	});

	$filterBtn.on('click touch', function(e){
		e.preventDefault();
		//Move sidebar out of the way, the background from the sidebar clashes with the color background.
		if(sidebarIsOpen()) {
			closeSidebar();
			setTimeout(function(){
				showFilters(e);
			},(300 * globalAnimSpeed)); // This is based on thew time it takes for the sidebar to slideout - could do with a callback instead or make the timing a global variable.
		} else {
			showFilters(e);
		}
	});

	$('.filter-overlay-nav').on('click touch', function(e){
		hideFilters();
	});


});


function setEventDetails(url) {
	$.getJSON( url, function( response ) {
		$('.event-info--title').html(response.title);

		// Metadata
		$('.event-info--date').html(moment(response.time_start).format('D.M.YY'));
		$('.event-info--time').html(moment(response.time_start).format('h.mma') + ' - ' + moment(response.time_end).format('h.mma'));
		$('.event-info--location').html(response.venue);

		$('.event-info .body-copy').html('<p>' + response.content + '</p>');
	});
}


