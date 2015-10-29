$(function() {

	$('.js-color-scheme-select').each(function() {
		var schemes = [];

		$(this).find('option').each(function() {
			schemes.push({
				id: $(this).attr('value'),
				colors: $(this).text().split('/')
			});
		});

		var schemeSelect = new colorSchemeSelect({
			schemes: schemes,
			defaultText: $(this).data('defaultText')
		});

		// Create dropdown
		var $dropdown = schemeSelect.build();

		// Update hidden input on select
		$dropdown.on('click', '.cs-color-scheme-select-option', function(e) {
			e.preventDefault();
			var colorSchemeId = $(this).data('colorSchemeId');
			$hiddenInput.val(colorSchemeId).trigger('change');
			$dropdown.removeClass('open');
		});

		$(this).before($dropdown);

		var $elem = $('<div class="cs-color-scheme-select-input"></div>');

		// Create fake input
		var $fakeInput = schemeSelect.buildScheme(schemes[0], 'cs-color-scheme-fake-input');

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
			var scheme = findInArrayByKey(schemes, 'id', $(this).val());
			var $newFakeInput = schemeSelect.buildScheme(scheme);
			$fakeInput.html($newFakeInput.html());
		});

		$elem.append($hiddenInput);

		$(this).replaceWith($elem);
	});

});


var colorSchemeSelect = function(options) {

	var self = this;
	self.options = options;
	self.optionWidth = null;

	self.build = function() {
		var schemes = self.options.schemes;
		var $elem = $('<div class="cs-color-scheme-select"></div>');

		for (var i = 0, len = schemes.length; i < len; i ++) {
			$elem.append(self.buildOption(schemes[i]));
		}

		return $elem;
	};

	self.buildOption = function(scheme) {
		return self.buildScheme(scheme);
	};

	self.buildScheme = function(scheme, cls) {
		cls = (cls) ? cls : 'cs-color-scheme-select-option';
		var $elem = $('<div class="' + cls + '"></div>').data('colorSchemeId', scheme.id);

		if (scheme.id == 0) {
			$elem.addClass('cs-color-scheme-select-default').html(self.options.defaultText);
		}
		else {
			for (var i = 0, len = scheme.colors.length; i < len; i ++) {
				$elem.append(self.buildColor(scheme.colors[i]));
			}
		}

		return $elem;
	};

	self.buildColor = function(color) {
		return $('<div class="cs-color-scheme-select-option-color" style="background-color: ' + color + '">' + color + '</div>');
	};

	self.buildDefault = function() {
		return $('<div class="cs-color-scheme-select-default">' + self.options.defaultText + '</div>').data('colorSchemeId', 0);
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

function findInArrayByKey(arr, key, val) {
	var result = $.grep(arr, function(item) { return item[key] == val; });
	return (result.length) ? result[0] : null;
}
