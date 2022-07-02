;(function($) {
	var away;
	var callback = {};
	var seconds = 1;
	setInterval(function() {
		if (callback[seconds]) {
			for (var i = 0; i < callback[seconds].length; ++i) {
				callback[seconds][i]();
			}
		}
		++seconds;
	}, 1000);
	$(document).on("DOMMouseScroll keydown mousedown mousemove mousewheel touchstart", function() {
		seconds = 0;
	});
	$.idle = function(n, fn) {
		if (arguments.length === 2) {
			if (!callback[n]) {
				callback[n] = [];
			}
			return callback[n].push(fn);
		} else if (arguments.length == 1) {
			return callback[n] || [];
		} else {
			return seconds;
		}
	};
	$.away = function(message) {
		if (message) {
			away = message;
		} else {
			away = null;
		}
	};
	$.isAway = function() {
		return !!away;
	};

})(jQuery);