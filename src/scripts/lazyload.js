(function($) {
	const config = {
		rootMargin: '50px 0px',
		threshold: 0.01
	};

	if (!('IntersectionObserver' in window)) {
		$('.card-img-top').each( function() {
			preloadImage( $(this)[0] );
		});
	} else {
		var observer = new IntersectionObserver(onIntersection, config);
		
		$('.card-img-top').each( function() {
			observer.observe( $(this)[0] );
		});
	}

	function onIntersection( entries ) {
		entries.forEach( function( e ) {
			if (e.intersectionRatio > 0) {
				observer.unobserve(e.target);
				preloadImage(e.target);
			}
		});
	}

	function preloadImage( e ) {
		e.setAttribute('src', e.getAttribute('data-src'));
	}
})( jQuery );