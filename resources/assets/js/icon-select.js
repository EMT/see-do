$(function() {

	$('.js-icon-select').each(function() {
		var icons = [];

		$(this).find('option').each(function() {
			icons.push({
				id: $(this).attr('value'),
				icon: $(this).text()
			});
		});

		var icSelect = new iconSelect({
			icons: icons,
			defaultText: $(this).data('defaultText')
		});

		// Create dropdown
		var $dropdown = icSelect.build();

		// Update hidden input on select
		$dropdown.on('click', '.cs-icon-select-option', function(e) {
			e.preventDefault();
			var iconId = $(this).data('iconId');
			$hiddenInput.val(iconId).trigger('change');
			$dropdown.removeClass('open');
		});

		$(this).before($dropdown);

		var $elem = $('<div class="cs-icon-select-input"></div>');

		// Create fake input
		var $fakeInput = icSelect.buildIcon(icons[0], 'cs-icon-fake-input');

		// Open select UI when fake input is clicked/tapped/focussed
		// TODO: open on focus
		$fakeInput.on('click', function(e) {
			e.preventDefault();
			$dropdown.addClass('open');
		});

		$elem.append($fakeInput);

		// Create hidden input
		var $hiddenInput = $('<input type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).val() + '">');

		// Update fake input when hidden input changes
		$hiddenInput.on('change', function(e) {
			var icon = findInArrayByKey(icons, 'id', $(this).val());
			var $newFakeInput = icSelect.buildIcon(icon);
			$fakeInput.html($newFakeInput.html());
		});

		$elem.append($hiddenInput);

		// Fire change event now in case the field has a value on page load
		$hiddenInput.trigger('change');

		$(this).replaceWith($elem);
	});

});


var iconSelect = function(options) {

	var self = this;
	self.options = options;
	self.optionWidth = null;

	self.build = function() {
		var icons = self.options.icons;
		var $elem = $('<div class="cs-icon-select"></div>');

		for (var i = 0, len = icons.length; i < len; i ++) {
			$elem.append(self.buildOption(icons[i]));
		}

		return $elem;
	};

	self.buildOption = function(icon) {
		return self.buildIcon(icon);
	};

	self.buildIcon = function(icon, cls) {
		cls = (cls) ? cls : 'cs-icon-select-option';
		var $elem = $('<div class="' + cls + '"></div>').data('iconId', icon.id);

		if (icon.id == 0) {
			$elem.addClass('cs-icon-select-default').html(self.options.defaultText);
		}
		else {
			$elem.append(icon.icon);
		}

		return $elem;
	};

	self.buildDefault = function() {
		return $('<div class="cs-icon-select-default">' + self.options.defaultText + '</div>').data('iconId', 0);
	};

	self.getOptionWidth = function($option) {
		var w = $option.css({
			position: 'absolute',
			left: '-999em'
		})
		.appendTo($('body'))
		.outerWidth(true);

		$option.remove();
		return w;
	}
}

