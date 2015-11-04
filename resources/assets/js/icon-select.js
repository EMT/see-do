$(function() {

	$('.js-icon-select').each(function() {

		var icSelect = new iconSelect({$elem: $(this)});

	});

});


var iconSelect = function(options) {

	var self = this;
	self.$elem = options.$elem;
	self.options = options;
	self.optionWidth = null;
	self.icons = [];
	self.selectedIcons = [];
	self.$newElem = $('<div class="cs-icon-select-input"></div>');
	self.$hiddenInput = $('<input type="hidden" name="' + self.$elem.attr('name') + '" value="' + self.$elem.val() + '">');

	self.$elem.find('option').each(function() {
		self.icons.push({
			id: $(this).attr('value'),
			title: $(this).text(),
			svg: $(this).data('iconSvg')
		});
	});

	self.setup = function() {
		self.$dropdown = self.buildDropdown();

		self.$dropdown.on('click', '.cs-icon-select-option', function(e) {
			e.preventDefault();
			self.addToSelectedIcons($(this).data('iconId'));
			self.$dropdown.removeClass('open');
		});

		self.$elem.before(self.$dropdown);

		self.$fakeInput = self.buildFakeInput();

		// Open select UI when + btn is clicked/tapped/focussed
		// TODO: open on focus
		self.$fakeInput.on('click', '.cs-add-btn', function(e) {
			e.preventDefault();
			self.$dropdown.addClass('open');
		});

		// Remove icon when clicked
		self.$fakeInput.on('click', '.cs-selected-icon', function(e) {
			e.preventDefault();
			self.removeFromSelectedIcons($('.cs-selected-icon').index($(this)));
		});

		self.$newElem.append(self.$fakeInput);
		self.$newElem.append(self.$hiddenInput);

		var iconIds = self.$elem.data('iconIds').split(',');

		for (var i = 0, len = iconIds.length; i < len; i ++) {
			self.addToSelectedIcons(iconIds[i]);
		}

		self.$elem.replaceWith(self.$newElem);
	}

	self.addToSelectedIcons = function(iconId) {
		self.selectedIcons.push(self.findInArrayByKey(self.icons, 'id', iconId)[0]);
		self.updateSelectedIcons();
	};

	self.removeFromSelectedIcons = function(iconIndex) {
		self.selectedIcons.splice(iconIndex, 1);
		self.updateSelectedIcons();
	};

	self.updateSelectedIcons = function() {
		self.$fakeInput.html(self.buildFakeInput().html());
		self.$hiddenInput.val(self.getSelectedIds().join(','));
	};

	self.getSelectedIds = function() {
		var selected = [];

		for (var i = 0, len = self.selectedIcons.length; i < len; i ++) {
			selected.push(self.selectedIcons[i].id);
		}

		return selected;
	};

	self.buildDropdown = function() {
		var icons = self.icons;
		var $elem = $('<div class="cs-icon-select"></div>');

		for (var i = 0, len = icons.length; i < len; i ++) {
			$elem.append(self.buildIcon(icons[i]));
		}

		return $elem;
	};

	self.buildIcon = function(icon, cls) {
		cls = (cls) ? cls : 'cs-icon-select-option';
		var $elem = $('<div class="' + cls + '"></div>').data('iconId', icon.id);

		if (icon.id == 0) {
			$elem.addClass('cs-icon-select-default').html(self.options.defaultText);
		}
		else {
			$elem.append(icon.svg);
		}

		return $elem;
	};

	self.buildFakeInput = function() {
		var $elem = $('<div class="cs-icon-fake-input"></div>');

		if (self.selectedIcons.length) {
			for (var i = 0, len = self.selectedIcons.length; i < len; i ++) {
				$elem.append('<a href="#" class="cs-selected-icon">' + self.selectedIcons[i].svg + '</a>');
			}
		}

		$elem.append('<a class="cs-add-btn" href="#">+</a>');

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

	self.findInArrayByKey = function(arr, key, vals) {
		vals = vals.split(',');
		var result = [];

		for (var i = 0, len = vals.length; i < len; i ++) {
			var r = $.grep(arr, function(item) { 
				return item[key] == vals[i]; 
			});

			if (r.length) {
				result.push(r[0]);
			}
		}

		return result;
	}

	self.setup();
}


var decodeEntities = (function() {
	// this prevents any overhead from creating the object each time
	var element = document.createElement('div');

	function decodeHTMLEntities (str) {
		if(str && typeof str === 'string') {
			// strip script/html tags
			str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
			str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
			element.innerHTML = str;
			str = element.textContent;
			element.textContent = '';
		}

		return str;
	}

	return decodeHTMLEntities;
})();

