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
			setEventDetails(eventJsonUrl);
		} 
		else {
			closeSidebar();
			setEventDetails(eventJsonUrl);
		}

		$('.event').removeClass('event--active');
		$(this).addClass('event--active');
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
		$('.js-event-info-date').html(moment(response.time_start).format('D.M.YY'));
		$('.js-event-info-time').html(moment(response.time_start).format('h.mma') + ' - ' + moment(response.time_end).format('h.mma'));
		$('.js-event-info-venue').html(response.venue);

		$('.event-info .body-copy').html('<p>' + response.content + '</p>');

		var styles;
		styles = '.event-background-color { background: ' + response.color_scheme.color_1 + '; fill: ' + response.color_scheme.color_1 + ';}',
		styles += '.event-primary-color { color: ' + response.color_scheme.color_2 + '; fill: ' + response.color_scheme.color_2 + ';}',
		styles += '.event-secondary-color { color: ' + response.color_scheme.color_3 + '; fill: ' + response.color_scheme.color_3 + ';}'

		$('#js-event-color-scheme').remove();
		$('<style id="#js-event-color-scheme" type="text/css">'+ styles +'</style>').appendTo('head');

		openSidebar();

	});
}


