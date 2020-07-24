$(document).ready(function() {
	
	var $window = $(window);
	$window.scroll(function() 
	{
		if ($window.scrollTop() > 100)
		{
			$('#to-top').fadeIn('fast');
		} else {
			$('#to-top').fadeOut('fast');
		}
	});
	
	// SCROLL
	function filterPath(string) {
		return string
		.replace(/^\//,'')
			.replace(/(index|default).[a-zA-Z]{3,4}$/,'')
			.replace(/\/$/,'');
	}
	var locationPath = filterPath(location.pathname);
	var scrollElem = scrollableElement('html', 'body');
	
	$hash = $('a[href^="#"]');
	
	if ($hash.length) {
		$hash.each(function() {
			if ($(this.hash).length != 0) {
				var thisPath = filterPath(this.pathname) || locationPath;
				if (  locationPath == thisPath
					&& (location.hostname == this.hostname || !this.hostname)
					&& this.hash.replace(/#/,'') ) 
				{
					var $target = $(this.hash), target = this.hash;
					if (target) {
						var targetOffset = $target.offset().top;
						$(this).click(function(event) {
							event.preventDefault();
							$(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
								location.hash = target;
							});
						});
					}
				}
			}
		});
	}

	// use the first element that is "scrollable"
	function scrollableElement(els) {
		for (var i = 0, argLength = arguments.length; i <argLength; i++) {
			var el = arguments[i],
			$scrollElement = $(el);
			if ($scrollElement.scrollTop()> 0) {
				return el;
			} else {
				$scrollElement.scrollTop(1);
				var isScrollable = $scrollElement.scrollTop()> 0;
				$scrollElement.scrollTop(0);
				if (isScrollable) {
					return el;
				}
			}
		}
		return [];
	}
});