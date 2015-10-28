$(document).ready(function(){
	FastClick.attach(document.body);

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

});