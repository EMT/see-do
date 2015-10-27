$(document).ready(function() {

	$('.js-color-scheme-select').each(function() {
		var schemes = [];

		$(this).find('option').each(function() {
			schemes.push({
				id: $(this).attr('value'),
				colors: $(this).text().split('/')
			});
		});

		// Create and append dropdown
		var $dropdown = colorSchemeSelect.build(schemes);

		// Update hidden input on select
		$dropdown.on('click', '.cs-color-scheme-select-option', function(e) {
			e.preventDefault();
			var colorSchemeId = $(this).data('colorSchemeId');
			$hiddenInput.val(colorSchemeId).trigger('change');
			$dropdown.removeClass('open');
		});

		$('[for=' + $(this).attr('id') + ']').before($dropdown);
		
		var $elem = $('<div class="cs-color-scheme-select-input"></div>');
		 
		// Create fake input
		var $fakeInput = colorSchemeSelect.buildScheme(schemes[0]);
		
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
	

	console.log(schemes);
	console.log($(this).val());
	console.log(scheme);
			var $newFakeInput = colorSchemeSelect.buildScheme(scheme);
			$fakeInput.html($newFakeInput.html());
		});

		$elem.append($hiddenInput);

		$(this).replaceWith($elem);
	});

});


var colorSchemeSelect = {

	build: function(schemes) {
		var $elem = $('<div class="cs-color-scheme-select"></div>');

		for (var i = 0, len = schemes.length; i < len; i ++) {
			$elem.append(colorSchemeSelect.buildOption(schemes[i]));
		}

		return $elem;
	},

	buildOption: function(scheme) {
		return colorSchemeSelect.buildScheme(scheme, 'cs-color-scheme-select-option');
	},

	buildScheme: function(scheme, cls) {
		var $elem = $('<div class="' + cls + '"></div>').data('colorSchemeId', scheme.id);

		for (var i = 0, len = scheme.colors.length; i < len; i ++) {
			$elem.append(colorSchemeSelect.buildColor(scheme.colors[i]));
		}

		return $elem;
	},

	buildColor: function(color) {
		return $('<div class="cs-color-scheme-select-option-color" style="background-color: ' + color + '">' + color + '</div>');
	}
}

function findInArrayByKey(arr, key, val) {
	var result = $.grep(arr, function(item) { return item[key] == val; });
	return (result.length) ? result[0] : null;
}
