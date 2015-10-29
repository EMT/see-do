$(function() {

    var endInput = new DateTimeInput($('#time_end'), {showEnd: false});
    var startInput = new DateTimeInput($('#time_start'), {sendEndTo: endInput});

});


var DateTimeInput = function($elem, options) {
    var defaults = {
        blankStateMsg: 'Type a date and type in any format',
        showEnd: true,
        use: 'start',
        sendStartTo: false,
        sendEndTo: false,
        userFormat: 'DD MMM YYYY, h:mma',
        hiddenFormat: 'YYYY-MM-DD HH:mm:ss'
    };

    var self = this;
    self.options = $.extend({}, defaults, options);
    self.cronoResult = null;
    self.$tooltip = $('<div class="input-tooltip"></div>');
    self.$hiddenInput = $elem.clone()
        .attr('id', '')
        .attr('type', 'hidden');

    self.crono = function(val) {
        var v = $elem.val();

        if (val) {
            v = val;
        }

        var dt = chrono.parse(v);
        self.cronoResult = (dt && dt[0]) ? dt[0] : null;
        self.updateHiddenField();
        self.refreshTooltip();
        self.sendTo();

        if (val) {
            self.refreshUserInput();
        }
    }

    self.getDateTime = function(use) {
        use = use || self.options.use;

        if (self.cronoResult[use]) {
            return moment(self.cronoResult[use].date()).format(self.options.hiddenFormat);
        }

        return null;
    }

    self.updateHiddenField = function() {
        if (self.cronoResult && self.getDateTime()) {
            self.$hiddenInput.val(self.getDateTime());
        }
    }

    self.sendTo = function() {
        if (self.cronoResult) {
            if (self.options.sendStartTo && self.cronoResult.start) {
                self.options.sendStartTo.crono(self.getDateTime('start'));
            }

            if (self.options.sendEndTo && self.cronoResult.end) {
                self.options.sendEndTo.crono(self.getDateTime('end'));
            }
        }
    }

    self.refreshUserInput = function() {
        if (self.$hiddenInput.val()) {
            $elem.val(moment(self.$hiddenInput.val()).format(self.options.userFormat));
        }
    }

    self.refreshTooltip = function() {
        var text = (self.cronoResult) ? parseCronoResult(self.cronoResult, self.options.showEnd) : self.options.blankStateMsg;
        self.$tooltip.text(text);
    }

    self.$hiddenInput.insertAfter($elem);
    $elem.parent().append(self.$tooltip);
    self.crono();
    self.refreshUserInput();

    $elem.on('focus', function(e) {
        if (self.$tooltip.css('display') === 'none') {
            self.$tooltip.fadeIn(100);
        }
    });

    $elem.on('blur', function(e) {
        self.refreshUserInput();

        if (self.$tooltip.css('display') === 'block') {
            self.$tooltip.fadeOut(100);
        }
    });

    $elem.on('keyup', function(e) {
        self.crono();
    });
};


/**
 * Parses the result into a string for use in the tooltip
 */ 
var parseCronoResult = function(result, showEnd) {
    var vals = {
        start: result.start.impliedValues,
        end: (result.end) ? result.end.impliedValues : null
    };

    for (var key in result.start.knownValues) {
        vals.start[key] = result.start.knownValues[key]; 
    }

    if (vals.end) {
        for (var key in result.end.knownValues) {
            vals.end[key] = result.end.knownValues[key]; 
        }
    }

    var dtString = moment(result.start.date()).format('ddd DD MMM YYYY, h:mma');

    if (vals.end && showEnd) {
        var dtEndString = moment(result.end.date()).format('h:mma');

        if (vals.end.month !== vals.start.month || vals.end.day !== vals.start.day) {
            var endDateString = moment(result.end.date()).format('ddd DD MMM');

            if (vals.end.year !== vals.start.year) {
                endDateString += ' YYYY';
            }

            dtEndString = endDateString += ', ' + dtEndString;
        }

        dtString += ' — ' + dtEndString;
    }

    return dtString;
}
