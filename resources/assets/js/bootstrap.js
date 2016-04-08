$(function() {

	FastClick.attach(document.body);
	Filters.init();

	// $('.month--title').on('click', function(){
	// 	var parent = $(this).parent();
	// 	parent.addClass('active');
	// 	parent.removeClass('hidden');

	// 	parent.siblings().each(function(){
	// 		var self = $(this);
	// 		self.addClass('hidden');
	// 		self.removeClass('active');
	// 	});
	// });

	siteTitleFun($('.js-site-title'));

	var $eventItems = $('.event'),
		$eventInfoClose = $('.js-close-sidebar'),
		$filterBtn = $('.filter');

	// If event is active on page load, trigger animated info panel
	if ($('.event.event--active').length) {
		changeEventInfo($('.event.event--active'), $eventItems);
	}

	$eventInfoClose.on('click touch', function(e) {
		e.preventDefault();

		stateHandler.push({
			url: '/',
			title: 'See&Do',
			eventId: null
		});

		Sidebar.animClose();
	});

	$eventItems.on('click touch', function(e) {
		e.preventDefault();
		changeEventInfo($(this), $eventItems);
	});

	$(window).keydown(function(e) {
		$eventItem = $('.event.event--active').length ? $('.event.event--active') : $('.event:first');
		eventItemIndex = $eventItems.index($eventItem);

    	if (e.which === 40) {
    		var nextItemIndex = (eventItemIndex < $eventItems.length - 1) ? eventItemIndex + 1 : 0;
    		changeEventInfo($($eventItems[nextItemIndex]), $eventItems);
    	}
    	else if (e.which === 38) {
    		var nextItemIndex = (eventItemIndex > 0) ? eventItemIndex - 1 : $eventItems.length - 1;
    		changeEventInfo($($eventItems[nextItemIndex]), $eventItems);
    	}
    });

	$(window).on('popstate', function(e) {
		if (e.originalEvent.state && e.originalEvent.state.eventId) {
			changeEventInfo($('#' + e.originalEvent.state.eventId), $eventItems, true);
		}
		else {
			Sidebar.animClose();
		}
	});


	$filterBtn.on('click touch', function(e){
		e.preventDefault();
		//Move sidebar out of the way, the background from the sidebar clashes with the color background.
		if(Sidebar.isOpen()) {
			Sidebar.animClose();
			setTimeout(function(){
				Filters.animShow(e);
			},(300 * globalAnimSpeed)); // This is based on thew time it takes for the sidebar to slideout - could do with a callback instead.
		} else {
			Filters.animShow(e);
		}
	});

	$('.js-filter-overlay-nav').on('click touch', 'li a', function(e) {
		e.preventDefault();
		window.location = $(this).attr('href');
	});

	$('.js-filter-overlay-bg').on('click touch', function(e) {
		e.preventDefault();
		Filters.animHide();
	});

	$('.js-filter-nav-close').on('click touch', function(e) {
		e.preventDefault();
		Filters.animHide();
	});


});


function changeEventInfo($eventItem, $eventItems, noStatePush) {
	if (!Sidebar.isAnimating()) {

		if (!stateHandler.supported()) {
			window.location = $eventItem.children('a').attr('href');
			return;
		}

		if (Sidebar.isOpen()) {
			Sidebar.animClose($eventItem);
		}



		var $prevItem = $($eventItems[$eventItems.index($eventItem) - 1]);
		var $nextItem = $($eventItems[$eventItems.index($eventItem) + 1]);
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

		var eventUrl = $eventItem.children('a').attr('href');

		setEventDetails(eventUrl + '.json', function(response) {
			if (!noStatePush) {
				stateHandler.push({
					url: eventUrl,
					title: response.title + ' – See&Do',
					eventId: $eventItem.attr('id')
				});
			}
		});

		$('.event--active').removeClass('event--active');
		$eventItem.addClass('event--active');

	};
}


function setEventDetails(url, callback) {
	$.getJSON( url, function( response ) {
		$('.event-info--title').html(response.title);

		// Metadata
		$('.js-event-info-date').html(response.longDates);
		$('.js-event-info-time').html(response.times);
		$('.js-event-info-venue').html(response.venue);
		$('.js-event-info-user').html('<a href="/users/'+response.user.slug+'">'+response.user.username+'</a>');
		$('.js-event-info-fb').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURI(response.url));
		$('.js-event-info-twitter').attr('href', 'https://twitter.com/home?status=' + encodeURI(response.title + ' ' + response.url));
		$('.js-edit-event').attr('href', encodeURI(response.url + '/edit'));

		if (response.more_info != null) {
			$('.js-event-info-wrapper').html('<a href="'+response.more_info+'" target="_blank">More Info</a>');
		} else {
			$('.js-event-info-wrapper').html('');
		}

		$('.event-info .body-copy').html('<p>' + response.parsedContent + '</p>');

		var styles;
		styles = '.event-background-color { background: ' + response.color_scheme.color_1 + '; fill: ' + response.color_scheme.color_1 + ';}',
		styles += '.event-primary-color { color: ' + response.color_scheme.color_2 + '; fill: ' + response.color_scheme.color_2 + ';}',
		styles += '.event-secondary-color { color: ' + response.color_scheme.color_3 + '; fill: ' + response.color_scheme.color_3 + ';}',
		styles += '.event-info .body-copy a, .event-info .meta-data a { color: ' + response.color_scheme.color_3 + ';}',
		styles += '.event-info .js-event-info-wrapper a { color: ' + response.color_scheme.color_3 + ';}',
		styles += '.event-info .event-info--share a:hover { color: ' + response.color_scheme.color_3 + ';}';

		$('#js-event-color-scheme').remove();
		$('<style id="js-event-color-scheme" type="text/css">'+ styles +'</style>').appendTo('head');

		Sidebar.animOpen();

		if (callback) {
			callback(response);
		}
	});
}


function siteTitleFun($elem) {
	var self = this;
	self.$elem = $elem;
	self._currentText = $elem.text();
	self._finalText = $elem.text();
	self._randomChars = 'See+Do_-)(=#*/<>1964tpm';

	self.addChar = function() {
		self._currentText = self.randomize();
		self.$elem.text(self._currentText);

		if (self._currentText !== self._finalText) {
			setTimeout(function() {
				self.addChar();
			}, 30);
		}
	}

	self.randomize = function(noStop) {
		var currentCharsArray = self._currentText.split('');
		var finalCharsArray = self._finalText.split('');
		var newString = '';

		for (var i = 0, len = currentCharsArray.length; i < len; i ++) {
			if (currentCharsArray[i] !== finalCharsArray[i] || noStop) {
				newString += self._randomChars.charAt(Math.floor(Math.random() * self._randomChars.length));
			}
			else {
				newString += finalCharsArray[i];
			}
		}

		self._currentText = newString;
		return self._currentText;
	}

	self._currentText = self.randomize(true);
	$elem.text('&nbsp;');

	self.addChar();
};



