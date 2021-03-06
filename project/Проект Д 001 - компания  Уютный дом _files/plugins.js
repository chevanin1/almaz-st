// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

$(window).load(function(){

	// --------------------------------------- //
	// FANCYBOX //
	// --------------------------------------- //
	
	$('.fancybox').fancybox({
		helpers: {
			overlay: {
				locked: false
			}
		},
        padding: 2
	});

    // --------------------------------------- //
    // SLIDER //
    // --------------------------------------- //

    $('#slider').carouFredSel({
        auto: 8000,
        items: 1,
        next: {
            button: '#sliderNext'
        },
        prev: {
            button: '#sliderPrev'
        },
        pagination: '#sliderPagination',
        scroll: {
            fx: 'crossfade'
        }
    });

});