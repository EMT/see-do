$(function() {
	FastClick.attach(document.body);
	Filters.init();

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


	var $eventItems = $('.event'),
		$eventInfoClose = $('.js-close-sidebar'),
		$filterBtn = $('.filter');

	$eventInfoClose.on('click touch', function(e) {
		e.preventDefault(); 
		Sidebar.animClose();
	});

	$eventItems.on('click touch', function(e) {
		e.preventDefault(); // Temp!

		if (Sidebar.isOpen()) {
			Sidebar.animClose($(this));
		}

		var $prevItem = $($eventItems[$eventItems.index(this) - 1]);
		var $nextItem = $($eventItems[$eventItems.index(this) + 1]);
		var $eventPrevNext = $('.js-event-next-prev');
		$eventPrevNext.html('');

		if ($prevItem.length) { 
			$eventPrev = $('<a href="" class="nav-arrows--arrow"><img src="/assets/img/arrow-left.svg" alt="Previous"></a>');
			$eventPrevNext.append($eventPrev);
			$eventPrev.on('click touch', function(e) {
				e.preventDefault();
				$prevItem.trigger('click');
			});
		}

		if ($nextItem.length) { 
			$eventNext = $('<a href="#" class="nav-arrows--arrow"><img src="/assets/img/arrow-right.svg" alt="Next"></a>');
        	$eventPrevNext.append($eventNext);
        	$eventNext.on('click touch', function(e) {
				e.preventDefault();
				$nextItem.trigger('click');
			});
		}

		var eventUrl = $(this).children('a').attr('href');
		var eventJsonUrl = eventUrl + '.json';

		setEventDetails(eventJsonUrl);

		$('.event--active').removeClass('event--active');
		$(this).addClass('event--active');
	});

	$('.js-event-next-prev').on('click touch', function(e) {
		e.preventDefault();

	});


	$filterBtn.on('click touch', function(e){
		e.preventDefault();
		//Move sidebar out of the way, the background from the sidebar clashes with the color background.
		if(Sidebar.isOpen()) {
			Sidebar.animClose();
			setTimeout(function(){
				Filters.animShow(e);
			},(300 * globalAnimSpeed)); // This is based on thew time it takes for the sidebar to slideout - could do with a callback instead or make the timing a global variable.
		} else {
			Filters.animShow(e);
		}
	});

	$('.filter-overlay-nav').on('click touch', 'a', function(e) {
		e.preventDefault();
		Filters.animHide();
		window.location = $(this).attr('href');
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
		$('<style id="js-event-color-scheme" type="text/css">'+ styles +'</style>').appendTo('head');

		Sidebar.animOpen();

	});
}


